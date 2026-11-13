
@extends('layouts.app')

@section('title', 'Edit Barang - Teknora')

@section('content')

    <h2>Edit Barang</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>ID Barang</label><br>
            <input type="text" value="{{ $barang->idbarang }}" disabled>
        </div>

        <br>

        <div>
            <label>Jenis Barang</label><br>
            <select name="jenis" required>
                <option value="E" {{ old('jenis', $barang->jenis) == 'E' ? 'selected' : '' }}>
                    Elektronik
                </option>
                <option value="A" {{ old('jenis', $barang->jenis) == 'A' ? 'selected' : '' }}>
                    Aksesoris
                </option>
            </select>
        </div>

        <br>

        <div>
            <label>Nama Barang</label><br>
            <input
                type="text"
                name="nama"
                value="{{ old('nama', $barang->nama) }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Satuan</label><br>
            <select name="idsatuan" required>
                @foreach ($satuans as $satuan)
                    <option
                        value="{{ $satuan->idsatuan }}"
                        {{ old('idsatuan', $barang->idsatuan) == $satuan->idsatuan ? 'selected' : '' }}
                    >
                        {{ $satuan->nama_satuan }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label>Harga</label><br>
            <input
                type="number"
                name="harga"
                min="0"
                value="{{ old('harga', $barang->harga) }}"
                required
            >
        </div>

        <br>

        <button type="submit">Update Barang</button>
        <a href="{{ route('barang.index') }}">Kembali</a>
    </form>

@endsection
