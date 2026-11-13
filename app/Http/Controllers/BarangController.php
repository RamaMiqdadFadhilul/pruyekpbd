<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    // READ: Menampilkan daftar barang dari VIEW
    public function index()
    {
        $barangs = DB::select('SELECT * FROM v_master_barang');

        return view('barang.index', compact('barangs'));
    }

    // CREATE: Menampilkan form tambah barang
    public function create()
    {
        $satuans = DB::table('satuan')
            ->where('status', 1)
            ->orderBy('nama_satuan')
            ->get();

        return view('barang.create', compact('satuans'));
    }

  

    // STORE: Menyimpan barang baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:E,A',
            'nama' => 'required|string|max:100',
            'idsatuan' => 'required|exists:satuan,idsatuan',
            'harga' => 'required|integer|min:0',
        ]);

        DB::insert('insert into barang(jenis, nama, idsatuan, harga) VALUES (?,?,?,?)',[
            $validated -> jenis,
            $validated -> nama,
            $validated -> idsatuan,
            $validated -> harga,
        ]);
    
        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    // EDIT: Menampilkan form edit barang
    public function edit($id)
    {
        $barang = DB::table('barang')
            ->where('idbarang', $id)
            ->first();

        if (!$barang) {
            abort(404);
        }

        $satuans = DB::table('satuan')
            ->where('status', 1)
            ->orderBy('nama_satuan')
            ->get();

        return view('barang.edit', compact('barang', 'satuans'));
    }

    // UPDATE: Memperbarui data barang

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis' => 'required|in:E,A',
            'nama' => 'required|string|max:100',
            'idsatuan' => 'required|exists:satuan,idsatuan',
            'harga' => 'required|integer|min:0',
        ]);

        $updated = DB::table('barang')
            ->where('idbarang', $id)
            ->update($validated);

        if (!$updated) {
            $exists = DB::table('barang')
                ->where('idbarang', $id)
                ->exists();

            if (!$exists) {
                abort(404);
            }
        }

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    // DESTROY: Menonaktifkan barang
    public function destroy($id)
    {
        $barang = DB::table('barang')
            ->where('idbarang', $id)
            ->first();

        if (!$barang) {
            abort(404);
        }

        DB::table('barang')
            ->where('idbarang', $id)
            ->update([
                'status' => 0
            ]);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil dinonaktifkan.');
    }
}
