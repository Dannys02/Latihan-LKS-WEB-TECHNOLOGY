<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <h1>Daftar Akun Baru</h1>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <div>
                <div>
                    <label>Nama Lengkap:</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Tulis Nama">
                </div>
                @error('name')
                    <small style="color: red;">{{ $message }}</small><br>
                @enderror
            </div><br>

            <div>
                <div>
                    <label>Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Tulis Email">
                </div>
                @error('email')
                    <small style="color: red;">{{ $message }}</small><br>
                @enderror
            </div><br>

            <div>
                <div>
                    <label>Password:</label>
                    <input type="password" name="password" placeholder="Tulis Password">
                </div>
                @error('password')
                    <small style="color: red;">{{ $message }}</small><br>
                @enderror
            </div><br>

            <div>
                <div>
                    <label>Ulangi Password:</label>
                    <input type="password" name="password_confirmation" placeholder="Tulis Password Lagi">
                </div>
                @error('password')
                    <small style="color: red;">{{ $message }}</small><br /><br />
                @enderror
            </div><br />

            <button type="submit">Kirim Data</button>
        </form>
        <p>Sudah ada akun? <a href="/login">Langsung login!</a></p>
    </div>
</body>

</html>
