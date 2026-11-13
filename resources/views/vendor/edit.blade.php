
@extends('layouts.app')

@section('content')
    <h1>Edit Vendor</h1>

    <form action="{{ route('vendor.update', $vendor->idvendor) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>ID Vendor</label>
            <input
                type="text"
                value="{{ $vendor->idvendor }}"
                readonly
            >
        </div>

        <div>
            <label>Nama Vendor</label>
            <input
                type="text"
                name="nama_vendor"
                value="{{ old('nama_vendor', $vendor->nama_vendor) }}"
                required
            >

            @error('nama_vendor')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Bentuk Badan Hukum</label>
            <select name="badan_hukum">
                <option value="">-- Tidak Ditentukan --</option>
                <option value="P"
                    {{ old('badan_hukum', $vendor->badan_hukum) == 'P' ? 'selected' : '' }}>
                    Perseroan Terbatas (PT)
                </option>
            </select>

            @error('badan_hukum')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('vendor.index') }}">Kembali</a>
    </form>
@endsection
