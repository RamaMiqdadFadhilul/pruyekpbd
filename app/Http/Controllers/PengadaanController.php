<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    // Daftar pengadaan
    public function index()
    {
        $pengadaans = DB::select('SELECT * FROM v_laporan_pengadaan');

        return view('pengadaan.index', compact('pengadaans'));
    }

    // Form membuat pengadaan
    public function create()
    {
        $vendors = DB::table('vendor')
            ->where('status', 'A')
            ->orderBy('nama_vendor')
            ->get();

        $users = DB::table('user')
            ->orderBy('username')
            ->get();

        return view('pengadaan.create', compact('vendors', 'users'));
    }

    // Simpan header menggunakan Stored Procedure
    public function store(Request $request)
    {
        $validated = $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'idvendor' => 'required|exists:vendor,idvendor',
            'tarif_ppn' => 'required|numeric|min:0|max:100',
        ]);

        DB::statement('SET @idpengadaan = NULL');

        DB::statement(
            'CALL sp_tambah_pengadaan(?, ?, ?, @idpengadaan)',
            [
                $validated['iduser'],
                $validated['idvendor'],
                $validated['tarif_ppn'],
            ]
        );

        $result = DB::select('SELECT @idpengadaan AS idpengadaan');

        $idpengadaan = $result[0]->idpengadaan ?? null;

        if (!$idpengadaan) {
            throw new \RuntimeException('ID Pengadaan gagal diperoleh.');
        }

        return redirect()
            ->route('pengadaan.show', $idpengadaan)
            ->with('success', 'Pengadaan berhasil dibuat.');
    }

    // Detail pengadaan
    public function show($id)
    {
        $pengadaan = DB::table('v_laporan_pengadaan')
            ->where('idpengadaan', $id)
            ->first();

        if (!$pengadaan) {
            abort(404);
        }

        $details = DB::table('detail_pengadaan as d')
            ->join('barang as b', 'b.idbarang', '=', 'd.idbarang')
            ->where('d.idpengadaan', $id)
            ->select(
                'd.iddetail_pengadaan',
                'd.idbarang',
                'b.nama',
                'd.jumlah',
                'd.harga_satuan',
                'd.sub_total'
            )
            ->get();

        $barangs = DB::table('barang')
            ->where('status', 1)
            ->orderBy('nama')
            ->get();

        return view('pengadaan.show', compact(
            'pengadaan',
            'details',
            'barangs'
        ));
    }

    // Tambahkan detail menggunakan Stored Procedure
    public function tambahDetail(Request $request, $id)
    {
        $validated = $request->validate([
            'idbarang' => 'required|exists:barang,idbarang',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|integer|min:0',
        ]);

        $pengadaan = DB::table('pengadaan')
            ->where('idpengadaan', $id)
            ->first();

        if (!$pengadaan) {
            abort(404);
        }

        if ($pengadaan->status !== 'P') {
            return back()->withErrors([
                'pengadaan' => 'Pengadaan tidak lagi dapat diubah.',
            ]);
        }

        DB::statement(
            'CALL sp_tambah_detail_pengadaan(?, ?, ?, ?)',
            [
                $id,
                $validated['idbarang'],
                $validated['jumlah'],
                $validated['harga_satuan'],
            ]
        );

        return redirect()
            ->route('pengadaan.show', $id)
            ->with('success', 'Detail barang berhasil ditambahkan.');
    }
}
