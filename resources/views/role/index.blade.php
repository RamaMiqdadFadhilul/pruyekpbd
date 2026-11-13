
@extends('layouts.app')

@section('content')
    <h1>Master Role</h1>

    <a href="{{ route('role.create') }}">Tambah Role</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('role.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari ID atau nama role..."
            value="{{ request('search') }}"
        >

        <button type="submit">Cari</button>
        <a href="{{ route('role.index') }}">Reset</a>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Role</th>
                <th>Nama Role</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($roles as $index => $role)
                <tr>
                    <td>{{ $roles->firstItem() + $index }}</td>
                    <td>{{ $role->idrole }}</td>
                    <td>{{ $role->nama_role }}</td>
                    <td>
                        <a href="{{ route('role.edit', $role->idrole) }}">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Data role tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $roles->links() }}
@endsection
