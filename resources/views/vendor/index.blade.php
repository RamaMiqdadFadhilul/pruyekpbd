
@extends('layouts.app')

@section('content')
    <h1>Master Vendor</h1>

    <a href="{{ route('vendor.create') }}">Tambah Vendor</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('vendor.index') }}" method="GET">
        <input
            type="text"
            name="search"
            placeholder="Cari ID atau nama vendor..."
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
        <a href="{{ route('vendor.index') }}">Reset</a>
    </form>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Vendor</th>
                <th>Nama Vendor</th>
                <th>Bentuk Badan Hukum</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($vendors as $index => $vendor)
                <tr>
                    <td>{{ $vendor->{'ID Vendor'} }}</td>
                    <td>{{ $vendor->{'Nama Vendor'} }}</td>
                    <td>{{ $vendor->{'Bentuk Badan Hukum'} ?? '-' }}</td>
                    <td>{{ $vendor->{'Status Vendor'} }}</td>
                    <td>
                        <a href="{{ route('vendor.edit', $vendor->{'ID Vendor'}) }}">
                            Edit
                        </a>

                        @if ($vendor->{'Status Vendor'} == 'Aktif')
                            <form
                                action="{{ route('vendor.destroy', $vendor->{'ID Vendor'}) }}"
                                method="POST"
                                style="display:inline"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin ingin menonaktifkan vendor ini?')"
                                >
                                    Nonaktifkan
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Data vendor tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
