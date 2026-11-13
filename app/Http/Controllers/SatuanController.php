<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    // READ: Menampilkan daftar satuan
    public function index()
    {
        $satuans = DB::select('SELECT * FROM v_master_satuan');

        return view('satuan.index', compact('satuans'));
    }

    // CREATE: Menampilkan form tambah
    public function create()
    {
        return view('satuan.create');
    }

    // STORE: Menyimpan satuan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_satuan' => 'required|string|max:45|unique:satuan,nama_satuan',
        ]);

        DB::table('satuan')->insert([
            'nama_satuan' => $validated['nama_satuan'],
        ]);

        return redirect()
            ->route('satuan.index')
            ->with('success', 'Satuan berhasil ditambahkan.');
    }

    // EDIT: Menampilkan form edit
    public function edit($id)
    {
        $satuan = DB::table('satuan')
            ->where('idsatuan', $id)
            ->first();

        if (!$satuan) {
            abort(404);
        }

        return view('satuan.edit', compact('satuan'));
    }

    // UPDATE: Memperbarui satuan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_satuan' => 'required|string|max:45|unique:satuan,nama_satuan,' . $id . ',idsatuan',
        ]);

        $satuan = DB::table('satuan')
            ->where('idsatuan', $id)
            ->first();

        if (!$satuan) {
            abort(404);
        }

        DB::table('satuan')
            ->where('idsatuan', $id)
            ->update([
                'nama_satuan' => $validated['nama_satuan'],
            ]);

        return redirect()
            ->route('satuan.index')
            ->with('success', 'Satuan berhasil diperbarui.');
    }

    // DESTROY: Menonaktifkan satuan
    public function destroy($id)
    {
        $satuan = DB::table('satuan')
            ->where('idsatuan', $id)
            ->first();

        if (!$satuan) {
            abort(404);
        }

        DB::table('satuan')
            ->where('idsatuan', $id)
            ->update([
                'status' => 0,
            ]);

        return redirect()
            ->route('satuan.index')
            ->with('success', 'Satuan berhasil dinonaktifkan.');
    }
}