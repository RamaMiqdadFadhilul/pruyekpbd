
@extends('layouts.app')

@section('content')
    <h1>Edit Margin Penjualan</h1>

    <form
        action="{{ route('margin-penjualan.update', $margin->idmargin_penjualan) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div>
            <label>ID Margin</label>

            <input
                type="text"
                value="{{ $margin->idmargin_penjualan }}"
                readonly
            >
        </div>

        <div>
            <label>Persentase Margin (%)</label>

            <input
                type="number"
                name="persen"
                step="0.01"
                min="0"
                max="9999.99"
                value="{{ old('persen', $margin->persen) }}"
                required
            >

            @error('persen')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Dikelola Oleh</label>

            <select name="iduser" required>
                @foreach ($users as $user)
                    <option
                        value="{{ $user->iduser }}"
                        {{ old('iduser', $margin->iduser) == $user->iduser ? 'selected' : '' }}
                    >
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>

            @error('iduser')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update</button>

        <a href="{{ route('margin-penjualan.index') }}">
            Kembali
        </a>
    </form>
@endsection
