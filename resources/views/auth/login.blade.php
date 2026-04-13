<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>

    <h1>Login Bang</h1>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" placeholder="Tulis Email" value="{{ old('email') }}"
                autocomplete="off"><br />
            @error('email')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>
        <br /><br />

        <div>
            <label for="email">Email :</label>
            <input type="password" name="password" placeholder="Tulis Password" autocomplete="new_password"><br />
            @error('password')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>
        <br /><br />

        <button type="submit">Kirim</button>
    </form>

    <p>Belum ada akun? <a href="/register">Register dulu!</a></p>
</body>

</html>
