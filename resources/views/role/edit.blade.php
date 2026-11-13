
@extends('layouts.app')

@section('content')
    <h1>Edit Role</h1>

    <form action="{{ route('role.update', $role->idrole) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>ID Role</label>
            <input
                type="text"
                value="{{ $role->idrole }}"
                readonly
            >
        </div>

        <div>
            <label>Nama Role</label>
            <input
                type="text"
                name="nama_role"
                value="{{ old('nama_role', $role->nama_role) }}"
                required
            >

            @error('nama_role')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('role.index') }}">Kembali</a>
    </form>
@endsection
