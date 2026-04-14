@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md border border-gray-200">
        <h1 class="text-2xl font-bold tracking-tight text-gray-800 mb-6">Buat Data Baru</h1>

        <form action="{{ route('agendas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Tulis judul"
                        class="mt-1 block w-full p-2 border rounded-md shadow-sm @error('title') border-red-500 @else border-gray-300 @enderror focus:ring-blue-500 focus:border-blue-500" />
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="date" value="{{ old('date') }}"
                        class="mt-1 block w-full p-2 border rounded-md shadow-sm @error('date') border-red-500 @else border-gray-300 @enderror focus:ring-blue-500 focus:border-blue-500" />
                    @error('date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                        class="mt-1 block w-full p-2 border rounded-md shadow-sm @error('status') border-red-500 @else border-gray-300 @enderror focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih status</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="sedang berlangsung" {{ old('status') == 'sedang berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibbatalkan</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Masukkan deskripsi"
                        class="mt-1 block w-full p-2 border rounded-md shadow-sm @error('description') border-red-500 @else border-gray-300 @enderror focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="image"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex items-center gap-3">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-200">
                    Kirim
                </button>
                <button type="button" onclick="history.back()"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-6 rounded-md transition duration-200">
                    Kembali
                </button>
            </div>
        </form>
    </div>
@endsection
