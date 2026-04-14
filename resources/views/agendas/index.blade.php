@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Agenda Anda</h1>
            <a href="{{ route('agendas.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                + Tambah Agenda
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @forelse ($agendas as $agenda)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                    <div class="h-40 bg-gray-100 overflow-hidden">
                        @if ($agenda->image)
                            <img src="{{ asset('agenda/' . $agenda->image) }}" alt="{{ $agenda->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">Tidak ada
                                gambar</div>
                        @endif
                    </div>

                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span
                                class="text-[10px] uppercase font-bold tracking-widest text-gray-400">{{ \Carbon\Carbon::parse($agenda->date)->format('d M Y') }}</span>
                            <span
                                class="px-2 py-1 rounded-full text-[10px] font-bold uppercase
                                @if ($agenda->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($agenda->status == 'sedang berlangsung')
                                    bg-blue-100 text-blue-700
                                @elseif($agenda->status == 'selesai')
                                    bg-green-100 text-green-700
                                @elseif($agenda->status == 'dibatalkan')
                                    bg-red-100 text-red-700
                                @else
                                    bg-gray-100 text-gray-700 @endif">
                                {{ $agenda->status }}
                            </span>
                        </div>

                        <h2 class="text-lg font-bold text-gray-800 leading-tight mb-1 truncate">{{ $agenda->title }}</h2>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4 h-10">{{ $agenda->description }}</p>

                        <div class="flex gap-2 pt-3 border-t border-gray-100">
                            <a href="{{ route('agendas.edit', $agenda->id) }}"
                                class="flex-1 text-center bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs font-bold py-2 rounded-md transition">
                                Edit
                            </a>
                            <form action="{{ route('agendas.destroy', $agenda->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus agenda ini?')" type="submit"
                                    class="w-full bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold py-2 rounded-md transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 font-medium italic">Nyari apa? Gak ada apa-apa di sini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
