
@extends('layouts.app')

@section('title', 'Tambah Satuan - Teknora')

@section('content')

    <h2>Tambah Satuan</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('satuan.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Satuan</label><br>
            <input
                type="text"
                name="nama_satuan"
                maxlength="45"
                value="{{ old('nama_satuan') }}"
                required
            >
        </div>

        <br>

        <button type="submit">Simpan</button>
        <a href="{{ route('satuan.index') }}">Kembali</a>
    </form>

@endsection
