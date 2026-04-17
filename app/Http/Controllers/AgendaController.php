<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AgendaRequest;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $agendas = Auth::user()->agendas()->with('tags')->get();
            return view('users.agendas.index', compact("agendas"));
        }
    }

    public function create()
    {
        $tags = Auth::user()->tags;
        return view("users.agendas.create", compact("tags"));
    }

    public function store(AgendaRequest $request)
    {
        $data = $request->only(['title', 'description', 'date', 'status']);

        // Tambahkan user_id secara manual sebelum insert
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('agenda', $filename);
            $data['image'] = $filename;
        }

        $agenda = Agenda::create($data);

        // tambah data tag_ids di pivot table
        if ($request->tag_ids) {
            $agenda->tags()->attach($request->tag_ids);
        }

        return redirect()->route('users.agendas.index')->with('success', 'agenda berhasil dibuat');
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $agenda = Agenda::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $tags = Auth::user()->tags;
        return view('users.agendas.edit', compact('agenda', 'tags'));
    }

    public function update(AgendaRequest $request, $id)
    {

        $data = $request->all();

        $agenda = Agenda::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('image')) {
            if ($agenda->image && File::exists(public_path('agenda/' . $agenda->image))) {
                File::delete(public_path('agenda/' . $agenda->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('agenda/', $filename);
            $data['image'] = $filename;
        }

        $agenda->update($data);
        $agenda->tags()->sync($request->tag_ids ?? []);

        return redirect()->route('users.agendas.index')->with('success', 'berhasil mengedit data agenda');
    }

    public function destroy($id)
    {
        $agenda = Agenda::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($agenda->image && File::exists(public_path('agenda', $agenda->image))) {
            File::delete(public_path('agenda/' . $agenda->image));
        }

        $agenda->delete();
        return redirect()->route('users.agendas.index')->with('success', 'berhasil hapus data agenda');
    }
}
