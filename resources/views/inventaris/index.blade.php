
@extends('layouts.app')

@section('content')
    <h1>Inventaris Barang</h1>

    <form action="{{ route('inventaris.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari ID atau nama barang..."
            value="{{ request('search') }}"
        >

        <button type="submit">Cari</button>
        <a href="{{ route('inventaris.index') }}">Reset</a>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Stok Terkini</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($barangs as $index => $barang)
                <tr>
                    <td>{{ $barangs->firstItem() + $index }}</td>
                    <td>{{ $barang->idbarang }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->stok_terkini }}</td>
                    <td>
                        <a href="{{ route('inventaris.riwayat', $barang->idbarang) }}">
                            Riwayat Stok
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Data inventaris tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $barangs->links() }}
@endsection
