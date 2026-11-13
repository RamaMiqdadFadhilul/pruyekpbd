
@extends('layouts.app')

@section('content')
    <h1>Tambah User</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div>
            <label>Username</label>
            <input
                type="text"
                name="username"
                value="{{ old('username') }}"
                required
            >

            @error('username')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Password</label>
            <input
                type="password"
                name="password"
                required
            >

            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
            >
        </div>

        <div>
            <label>Hak Akses</label>
            <select name="idrole" required>
                <option value="">-- Pilih Hak Akses --</option>

                @foreach ($roles as $role)
                    <option
                        value="{{ $role->idrole }}"
                        {{ old('idrole') == $role->idrole ? 'selected' : '' }}
                    >
                        {{ $role->nama_role }}
                    </option>
                @endforeach
            </select>

            @error('idrole')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('user.index') }}">Kembali</a>
    </form>
@endsection
