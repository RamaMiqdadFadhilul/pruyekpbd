
@extends('layouts.app')

@section('content')
    <h1>Riwayat Kartu Stok</h1>

    <p>ID Barang: {{ $barang->idbarang }}</p>
    <p>Nama Barang: {{ $barang->nama }}</p>

    <h3>Stok Saat Ini: {{ $stokSekarang ?? 0 }}</h3>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Kartu Stok</th>
                <th>Jenis Transaksi</th>
                <th>Barang Masuk</th>
                <th>Barang Keluar</th>
                <th>Stok</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($riwayat as $index => $item)
                <tr>
                    <td>{{ $riwayat->firstItem() + $index }}</td>
                    <td>{{ $item->idkartu_stok }}</td>
                    <td>{{ $item->jenis_transaksi }}</td>
                    <td>{{ $item->masuk }}</td>
                    <td>{{ $item->keluar }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->idtransaksi ?? '-' }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada riwayat pergerakan stok.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $riwayat->links() }}

    <a href="{{ route('inventaris.index') }}">Kembali ke Inventaris</a>
@endsection
