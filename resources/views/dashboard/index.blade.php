@extends('layouts.app')

@section('content')
    <div>
        <h1 class="text-2xl font-bold">Selamat datang {{ auth()->user()->name }} di Dashboard!</h1>
        <p>Ini adalah isi konten yang muncul di dalam layout utama.</p>
    </div>
@endsection
