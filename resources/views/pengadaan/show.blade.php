
@extends('layouts.app')

@section('content')
    <h1>Detail Pengadaan</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <h3>Informasi Pengadaan</h3>

    <p>ID Pengadaan: {{ $pengadaan->idpengadaan }}</p>
    <p>Vendor: {{ $pengadaan->nama_vendor }}</p>
    <p>User: {{ $pengadaan->username }}</p>
    <p>Status: {{ $pengadaan->status }}</p>

    <h3>Tambah Barang</h3>

    @if ($pengadaan->status == 'P')
        <form
            action="{{ route('pengadaan.detail.store', $pengadaan->idpengadaan) }}"
            method="POST"
        >
            @csrf

            <div>
                <label>Barang</label>

                <select name="idbarang" required>
                    <option value="">-- Pilih Barang --</option>

                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->idbarang }}">
                            {{ $barang->idbarang }} - {{ $barang->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Jumlah</label>
                <input type="number" name="jumlah" min="1" required>
            </div>

            <div>
                <label>Harga Satuan</label>
                <input type="number" name="harga_satuan" min="0" required>
            </div>

            <button type="submit">Tambah Barang</button>
        </form>
    @else
        <p>Pengadaan ini sudah tidak dapat diubah.</p>
    @endif

    <h3>Daftar Detail Barang</h3>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->idbarang }}</td>
                    <td>{{ $detail->nama }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada barang dalam pengadaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>Ringkasan Pembayaran</h3>

    <p>Subtotal: Rp {{ number_format($pengadaan->subtotal, 0, ',', '.') }}</p>
    <p>Tarif PPN: {{ $pengadaan->tarif_ppn }}%</p>
    <p>PPN: Rp {{ number_format($pengadaan->ppn, 0, ',', '.') }}</p>
    <p>
        <strong>
            Total: Rp {{ number_format($pengadaan->total_nilai, 0, ',', '.') }}
        </strong>
    </p>

    <a href="{{ route('pengadaan.index') }}">Kembali ke Daftar Pengadaan</a>
@endsection
