
@extends('layouts.app')

@section('title', 'Tambah Barang - Teknora')

@section('content')

    <h2>Tambah Barang</h2>

    <p>Masukkan informasi barang baru.</p>

    <hr>

    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <div>
            <label for="jenis">Jenis Barang</label><br>
            <select id="jenis" name="jenis" required>
                <option value="">-- Pilih Jenis --</option>

                <option value="E" {{ old('jenis') == 'E' ? 'selected' : '' }}>
                    Elektronik
                </option>

                <option value="A" {{ old('jenis') == 'A' ? 'selected' : '' }}>
                    Aksesoris
                </option>
            </select>
        </div>

        <br>

        <div>
            <label for="nama">Nama Barang</label><br>
            <input
                type="text"
                id="nama"
                name="nama"
                maxlength="100"
                value="{{ old('nama') }}"
                required
            >
        </div>

        <br>

        <div>
            <label for="idsatuan">Satuan</label><br>
            <select id="idsatuan" name="idsatuan" required>
                <option value="">-- Pilih Satuan --</option>

                @foreach ($satuans as $satuan)
                    <option
                        value="{{ $satuan->idsatuan }}"
                        {{ old('idsatuan') == $satuan->idsatuan ? 'selected' : '' }}
                    >
                        {{ $satuan->nama_satuan }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="harga">Harga</label><br>
            <input
                type="number"
                id="harga"
                name="harga"
                min="0"
                value="{{ old('harga') }}"
                required
            >
        </div>

        <br>

        <button type="submit">Simpan</button>
        <a href="{{ route('barang.index') }}">Kembali</a>
    </form>

@endsection
