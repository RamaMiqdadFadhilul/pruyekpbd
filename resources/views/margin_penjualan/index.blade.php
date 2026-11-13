
@extends('layouts.app')

@section('content')
    <h1>Master Margin Penjualan</h1>

    <a href="{{ route('margin-penjualan.create') }}">
        Tambah Margin
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('margin-penjualan.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari ID margin atau username..."
            value="{{ request('search') }}"
        >

        <select name="status">
            <option value="">Semua Status</option>
            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>
                Aktif
            </option>
            <option value="Tidak Aktif" {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>
                Tidak Aktif
            </option>
        </select>

        <button type="submit">Cari</button>
        <a href="{{ route('margin-penjualan.index') }}">Reset</a>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID Margin</th>
                <th>Persentase Margin</th>
                <th>Status</th>
                <th>Dikelola Oleh</th>
                <th>Tanggal Dibuat</th>
                <th>Terakhir Diperbarui</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($margins as $index => $margin)
                <tr>

                    <td>{{ $margin->{'ID Margin Penjualan'} }}</td>

                    <td>
                        {{ number_format((float) $margin->{'Persentase Margin (%)'}, 2, ',', '.') }}%
                    </td>

                    <td>{{ $margin->{'Status Margin'} }}</td>

                    <td>{{ $margin->{'Dikelola Oleh'} ?? '-' }}</td>

                    <td>{{ $margin->{'Tanggal Dibuat'} }}</td>

                    <td>{{ $margin->{'Terakhir Diperbarui'} }}</td>

                    <td>
                        <a href="{{ route('margin-penjualan.edit', $margin->{'ID Margin Penjualan'}) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('margin-penjualan.toggle-status', $margin->{'ID Margin Penjualan'}) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('PATCH')

                            @if ($margin->{'Status Margin'} == 'Aktif')
                                <button
                                    type="submit"
                                    onclick="return confirm('Nonaktifkan margin ini?')"
                                >
                                    Nonaktifkan
                                </button>
                            @else
                                <button
                                    type="submit"
                                    onclick="return confirm('Aktifkan margin ini?')"
                                >
                                    Aktifkan
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Data margin belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
