
@extends('layouts.app')

@section('content')
    <h1>Master Barang</h1>

    <a href="{{ route('barang.create') }}">Tambah Barang</a>

    <form action="{{ route('barang.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari ID atau nama barang..."
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
        <a href="{{ route('barang.index') }}">Reset</a>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Satuan</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($barangs as $index => $barang)
                <tr>
                    <td>{{ $barang->{'ID Barang'} }}</td>
                    <td>{{ $barang->{'Nama Barang'} }}</td>
                    <td>{{ $barang->{'Jenis Barang'} }}</td>
                    <td>{{ $barang->{'Satuan'} }}</td>
                    <td>{{ $barang->{'Status Barang'} }}</td>
                    <td>Rp {{ number_format($barang->{'Harga Barang'}, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $barang->{'ID Barang'}) }}">
                            Edit
                        </a>

                        @if ($barang->{'Status Barang'} == 'Aktif')
                            <form
                                action="{{ route('barang.destroy', $barang->{'ID Barang'}) }}"
                                method="POST"
                                style="display:inline"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin ingin menonaktifkan barang ini?')"
                                >
                                    Nonaktifkan
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Data barang tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
