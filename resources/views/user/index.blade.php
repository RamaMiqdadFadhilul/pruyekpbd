
@extends('layouts.app')

@section('content')
    <h1>Master User</h1>

    <a href="{{ route('user.create') }}">Tambah User</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('user.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari ID atau username..."
            value="{{ request('search') }}"
        >

        <select name="role">
            <option value="">Semua Hak Akses</option>
            <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>
                Admin
            </option>
            <option value="Pegawai" {{ request('role') == 'Pegawai' ? 'selected' : '' }}>
                Pegawai
            </option>
            <option value="Manajer" {{ request('role') == 'Manajer' ? 'selected' : '' }}>
                Manajer
            </option>
        </select>

        <button type="submit">Cari</button>
        <a href="{{ route('user.index') }}">Reset</a>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>ID User</th>
                <th>Username</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $user->{'ID User'} }}</td>
                    <td>{{ $user->{'Username'} }}</td>
                    <td>{{ $user->{'Hak Akses'} }}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->{'ID User'}) }}">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Data user tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
