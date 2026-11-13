
@extends('layouts.app')

@section('content')
    <h1>Tambah Role</h1>

    <form action="{{ route('role.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Role</label>
            <input
                type="text"
                name="nama_role"
                value="{{ old('nama_role') }}"
                placeholder="Masukkan nama role"
                required
            >

            @error('nama_role')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('role.index') }}">Kembali</a>
    </form>
@endsection
