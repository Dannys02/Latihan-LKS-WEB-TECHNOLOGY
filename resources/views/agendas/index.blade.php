@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-2">Data Agenda Anda</h1>
    <div>
        <a href="{{ route('agendas.create') }}" class="text-blue-600 underline">Tambah Data</a>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 mt-6 gap-4">
            @forelse ($agendas as $agenda)
                <div class="border border-black p-4 relative">
                    <h2 class="text-2xl font-bold tracking-tighter">{{ $agenda->title }}</h2>
                    <p>{{ $agenda->date }}</p>
                    <p class="{{ $agenda->status == 'pending' ? 'text-yellow-500' : 'text-blue-500' }}">{{ $agenda->status }}
                    </p>
                    <p>{{ $agenda->description }}</p>

                    <div class="flex gap-2 items-center mt-4">
                        <a href="{{ route('agendas.edit', $agenda->id) }}"
                            class="bg-yellow-600 text-white rounded-md py-2 px-4">Edit</a>
                        <form action="{{ route('agendas.destroy', $agenda->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('yakin hapus data berjudul {{ $agenda->title }}')"
                                type="submit" class="bg-red-500 text-white rounded-md py-2 px-4">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div>
                    Nyari apa? Gak ada apa-apa
                </div>
            @endforelse
        </div>
    </div>
@endsection
