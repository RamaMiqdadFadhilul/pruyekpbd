
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Teknora')</title>
</head>
<body>

    <header>
        <h1>TEKNORA</h1>
        <p>Sistem Informasi Manajemen Toko Elektronik</p>
    </header>

    <hr>

    <nav>
        <h3>Menu Navigasi</h3>

        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ul>

        <h4>Master Data</h4>
        <ul>
            <li>
                <a href="{{ route('barang.index') }}">Barang</a>
            </li>
            <li>
                <a href="{{ route('satuan.index') }}">Satuan</a>
            </li>
            <li>
                <a href="{{ route('vendor.index') }}">Vendor</a>
            </li>
            <li>
                <a href="{{ route('user.index') }}">User</a>
            </li>
            <li>
                <a href="{{ route('role.index') }}">Role</a>
            </li>
            <li>
                <a href="{{ route('margin-penjualan.index') }}">Margin Penjualan</a>
            </li>
        </ul>

        <h4>Transaksi</h4>
        <ul>
            <li>
                <a href="{{ route('pengadaan.index') }}">Pengadaan</a>
            </li>
            <li><a href="#">Penerimaan</a></li>
            <li><a href="#">Penjualan</a></li>
            <li><a href="#">Retur</a></li>
        </ul>

        <h4>Inventaris dan Laporan</h4>
        <li>
            <a href="{{ route('inventaris.index') }}">Inventaris</a>
        </li>
        <ul>
            <li><a href="#">Kartu Stok</a></li>
            <li><a href="#">Laporan</a></li>
        </ul>
    </nav>

    <hr>

    <main>
        @yield('content')
    </main>

    <footer>
        <hr>
        <p>&copy; {{ date('Y') }} Teknora</p>
    </footer>

</body>
</html>
