@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold tracking-tight">Buat Data Baru</h1>
    <div class="mt-6">
        <form action="{{ route('agendas.store') }}" method="POST">
            @csrf
            <div>
                <input type="text" name="title" placeholder="Tulis judul" class="p-2 border border-black" /><br /><br />
                <input type="date" name="date" placeholder="Tulis tanggal"
                    class="p-2 border border-black" /><br /><br />
                <select name="status" class="p-2 border border-black">
                    <option value="">Tulis status</option>
                    <option value="pending">pending</option>
                    <option value="done">done</option>
                </select><br /><br />
                <textarea name="description" placeholder="masukkan deskripsi" class="p-2 border border-black"></textarea>
            </div><br />
            <div>
                <button class="bg-blue-500 text-white py-1 px-2 rounded-md" type="submit">Kirim</button>
                <button type="button" onclick="history.back()" class="bg-gray-500 text-white py-1 px-2 rounded-md"
                    type="submit">Kembali</button>
            </div>
        </form>
    </div>
@endsection
