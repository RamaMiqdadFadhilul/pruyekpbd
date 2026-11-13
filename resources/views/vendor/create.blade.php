
@extends('layouts.app')

@section('content')
    <h1>Tambah Vendor</h1>

    <form action="{{ route('vendor.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Vendor</label>
            <input
                type="text"
                name="nama_vendor"
                value="{{ old('nama_vendor') }}"
                required
            >
            @error('nama_vendor')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Bentuk Badan Hukum</label>
            <select name="badan_hukum">
                <option value="">-- Pilih Bentuk Badan Hukum --</option>
                <option value="P" {{ old('badan_hukum') == 'P' ? 'selected' : '' }}>
                    Perseroan Terbatas (PT)
                </option>
            </select>

            @error('badan_hukum')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('vendor.index') }}">Kembali</a>
    </form>
@endsection
