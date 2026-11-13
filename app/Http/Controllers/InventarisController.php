<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    // Menampilkan daftar inventaris
     public function index()
    {
        $barangs = DB::select('SELECT * FROM v_stok_barang');

        return view('inventaris.index', compact('barangs', 'search'));
    }


    // Menampilkan riwayat kartu stok suatu barang
    public function riwayat($id)
    {
        $barang = DB::table('barang')
            ->where('idbarang', $id)
            ->first();

        if (!$barang) {
            abort(404);
        }

        $riwayat = DB::table('kartu_stok')
            ->where('idbarang', $id)
            ->orderByDesc('created_at')
            ->orderByDesc('idkartu_stok')
            ->paginate(15);

        $stokSekarang = DB::table('v_stok_barang')
            ->where('idbarang', $id)
            ->value('stok_terkini');

        return view('inventaris.riwayat', compact(
            'barang',
            'riwayat',
            'stokSekarang'
        ));
    }
}
