
@extends('layouts.app')

@section('content')
    <h1>Pengadaan Barang</h1>

    <a href="{{ route('pengadaan.create') }}">Tambah Pengadaan</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID Pengadaan</th>
                <th>Tanggal</th>
                <th>Vendor</th>
                <th>User</th>
                <th>Status</th>
                <th>Subtotal</th>
                <th>PPN</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pengadaans as $index => $pengadaan)
                <tr>
                    <td>{{ $pengadaan->idpengadaan }}</td>
                    <td>{{ $pengadaan->timestamp }}</td>
                    <td>{{ $pengadaan->nama_vendor }}</td>
                    <td>{{ $pengadaan->username }}</td>
                    <td>{{ $pengadaan->status }}</td>
                    <td>Rp {{ number_format($pengadaan->subtotal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($pengadaan->ppn, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($pengadaan->total_nilai, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('pengadaan.show', $pengadaan->idpengadaan) }}">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">Belum ada data pengadaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
