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
            $agendas = Auth::user()->agendas;
            return view('agendas.index', compact("agendas"));
        }
    }

    public function create()
    {
        return view("agendas.create");
    }

    public function store(AgendaRequest $request)
    {
        $data = $request->all();

        // Tambahkan user_id secara manual sebelum insert
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('agenda', $filename);
            $data['image'] = $filename;
        }

        Agenda::create($data);

        return redirect()->route('agendas.index')->with('success', 'agenda berhasil dibuat');
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $agenda = Agenda::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('agendas.edit', compact('agenda'));
    }

    public function update(AgendaRequest $request, $id)
    {

        $data = $request->all();

        $agenda = Agenda::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

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

        return redirect()->route('agendas.index')->with('success', 'berhasil mengedit data agenda');
    }

    public function destroy($id)
    {
        $agenda = Agenda::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($agenda->image && File::exists(public_path('agenda', $agenda->image))) {
            File::delete(public_path('agenda/' . $agenda->image));
        }

        $agenda->delete();
        return redirect()->route('agendas.index')->with('success', 'berhasil hapus data agenda');
    }
}
