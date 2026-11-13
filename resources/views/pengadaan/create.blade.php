
@extends('layouts.app')

@section('content')
    <h1>Tambah Pengadaan</h1>

    <form action="{{ route('pengadaan.store') }}" method="POST">
        @csrf

        <div>
            <label>Vendor</label>

            <select name="idvendor" required>
                <option value="">-- Pilih Vendor --</option>

                @foreach ($vendors as $vendor)
                    <option
                        value="{{ $vendor->idvendor }}"
                        {{ old('idvendor') == $vendor->idvendor ? 'selected' : '' }}
                    >
                        {{ $vendor->nama_vendor }}
                    </option>
                @endforeach
            </select>

            @error('idvendor')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>User</label>

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

        <div>
            <label>Tarif PPN (%)</label>

            <input
                type="number"
                name="tarif_ppn"
                step="0.01"
                min="0"
                max="100"
                value="{{ old('tarif_ppn', 11) }}"
                required
            >

            @error('tarif_ppn')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Buat Pengadaan</button>
        <a href="{{ route('pengadaan.index') }}">Kembali</a>
    </form>
@endsection
