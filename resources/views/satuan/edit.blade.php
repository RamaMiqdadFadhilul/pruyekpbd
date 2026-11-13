
@extends('layouts.app')

@section('title', 'Edit Satuan - Teknora')

@section('content')

    <h2>Edit Satuan</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('satuan.update', $satuan->idsatuan) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>ID Satuan</label><br>
            <input type="text" value="{{ $satuan->idsatuan }}" disabled>
        </div>

        <br>

        <div>
            <label>Nama Satuan</label><br>
            <input
                type="text"
                name="nama_satuan"
                maxlength="45"
                value="{{ old('nama_satuan', $satuan->nama_satuan) }}"
                required
            >
        </div>

        <br>

        <button type="submit">Update</button>
        <a href="{{ route('satuan.index') }}">Kembali</a>
    </form>

@endsection
