
@extends('layouts.app')

@section('content')
    <h1>Tambah Margin Penjualan</h1>

    <form action="{{ route('margin-penjualan.store') }}" method="POST">
        @csrf

        <div>
            <label>Persentase Margin (%)</label>

            <input
                type="number"
                name="persen"
                step="0.01"
                min="0"
                max="9999.99"
                value="{{ old('persen') }}"
                placeholder="Contoh: 10.00"
                required
            >

            @error('persen')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Dikelola Oleh</label>

            <select name="iduser" required>
                <option value="">-- Pilih User --</option>

                @foreach ($users as $user)
                    <option
                        value="{{ $user->iduser }}"
                        {{ old('iduser') == $user->iduser ? 'selected' : '' }}
                    >
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>

            @error('iduser')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Simpan</button>

        <a href="{{ route('margin-penjualan.index') }}">
            Kembali
        </a>
    </form>
@endsection
