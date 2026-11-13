
@extends('layouts.app')

@section('content')
    <h1>Master Satuan</h1>

    <a href="{{ route('satuan.create') }}">Tambah Satuan</a>

    <form action="{{ route('satuan.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari ID atau nama satuan..."
            value="{{ request('search') }}"
        >

        <select name="status">
            <option value="">Semua Status</option>
            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>
                Aktif
            </option>
            <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>
                Nonaktif
            </option>
        </select>

        <button type="submit">Cari</button>
        <a href="{{ route('satuan.index') }}">Reset</a>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Satuan</th>
                <th>Nama Satuan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($satuans as $index => $satuan)
                <tr>
                    <td>{{ $satuan->{'ID Satuan'} }}</td>
                    <td>{{ $satuan->{'Nama Satuan'} }}</td>
                    <td>{{ $satuan->{'Status Satuan'} }}</td>
                    <td>
                        <a href="{{ route('satuan.edit', $satuan->{'ID Satuan'}) }}">
                            Edit
                        </a>

                        @if ($satuan->{'Status Satuan'} == 'Aktif')
                            <form
                                action="{{ route('satuan.destroy', $satuan->{'ID Satuan'}) }}"
                                method="POST"
                                style="display:inline"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin ingin menonaktifkan satuan ini?')"
                                >
                                    Nonaktifkan
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Data satuan tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
