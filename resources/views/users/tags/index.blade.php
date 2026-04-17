@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tag Anda</h1>

            {{-- FORM --}}
            <form action="{{ isset($editTag) ? route('tags.update', $editTag->id) : route('tags.store') }}" method="POST"
                class="flex items-center gap-4">
                @csrf
                @if (isset($editTag))
                    @method('PUT')
                @endif

                <input type="text" name="name_tag" value="{{ old('name_tag', $editTag->name_tag ?? '') }}"
                    placeholder="Masukkan Tag"
                    class="block p-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />

                <div class="flex items-center gap-2">
                    <button class="bg-blue-500 rounded-md text-white py-1 px-3" type="submit">
                        {{ isset($editTag) ? 'Update' : '+ Tambah' }}
                    </button>
                    @if (isset($editTag))
                        <a href="{{ route('tags.index') }}" class="bg-gray-600 text-white py-1 px-2 rounded-md">Batal</a>
                    @endif
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">No</th>
                    <th class="p-2">Nama Tag</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tags as $tag)
                    <tr class="border-t">
                        <td class="p-2 text-center">{{ $loop->iteration }}</td>
                        <td class="p-2 text-center">{{ $tag->name_tag }}</td>
                        <td class="p-2 flex gap-2 flex justify-center">

                            {{-- EDIT --}}
                            <a href="{{ route('tags.edit', $tag->id) }}" class="text-blue-500">Edit</a>

                            {{-- DELETE --}}
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('yakin hapus tag {{ $tag->name_tag }}')"
                                    class="text-red-500">Hapus</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center p-4">
                            Data Tag Kosong!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
