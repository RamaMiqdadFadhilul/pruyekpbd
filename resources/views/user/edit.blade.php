
@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    <form action="{{ route('user.update', $user->iduser) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>ID User</label>
            <input
                type="text"
                value="{{ $user->iduser }}"
                readonly
            >
        </div>

        <div>
            <label>Username</label>
            <input
                type="text"
                name="username"
                value="{{ old('username', $user->username) }}"
                required
            >

            @error('username')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Hak Akses</label>
            <select name="idrole" required>
                @foreach ($roles as $role)
                    <option
                        value="{{ $role->idrole }}"
                        {{ old('idrole', $user->idrole) == $role->idrole ? 'selected' : '' }}
                    >
                        {{ $role->nama_role }}
                    </option>
                @endforeach
            </select>

            @error('idrole')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <hr>

        <p>Isi bagian password hanya jika ingin mengganti password.</p>

        <div>
            <label>Password Baru</label>
            <input type="password" name="password">

            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation">
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('user.index') }}">Kembali</a>
    </form>
@endsection
