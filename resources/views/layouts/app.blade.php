<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-md py-4 px-8 flex gap-4">
        <a href="{{ route('dashboard.user') }}" class="hover:text-blue-500 {{ request()->routeIs('dashboard.user') ? 'text-blue-600' : '' }}">Dashboard</a>
        <a href="{{ route('agendas.index') }}" class="hover:text-blue-500 {{ request()->routeIs('agendas.*') ? 'text-blue-600' : '' }}">Data Agenda</a>
        <a href="#" class="hover:text-blue-500">Pengaturan</a>

        <form action="{{ route('logout.user') }}" method="POST" class="ml-auto {{ request()->routeIs('pengaturan.user') ? 'text-blue-600' : '' }}">
            @csrf
            <button type="submit" class="text-red-500 font-bold">Logout</button>
        </form>
    </nav>

    <main class="p-8">
        @yield('content')
    </main>
</body>

</html>
