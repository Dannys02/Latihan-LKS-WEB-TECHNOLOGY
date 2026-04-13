<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'status' => 'required',
        ]);

        // Tambahkan user_id secara manual sebelum insert
        $validated['user_id'] = auth()->id();

        Agenda::create($validated);

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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'status' => 'required',
        ]);

        $agenda = Agenda::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $agenda->update($validated);

        return redirect()->route('agendas.index')->with('success', 'berhasil mengedit data agenda');
    }

    public function destroy($id)
    {
        $agenda = Agenda::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $agenda->delete();
        return redirect()->route('agendas.index')->with('success', 'berhasil hapus data agenda');
    }
}
