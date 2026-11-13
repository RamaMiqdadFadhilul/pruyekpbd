<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarginPenjualanController extends Controller
{
    // Menampilkan daftar margin
     public function index()
    {
        $margins = DB::select('SELECT * FROM v_master_margin_penjualan');

        return view('margin_penjualan.index', compact(
            'margins'));
    }

    // Form tambah margin
    public function create()
    {
        $users = DB::table('user')->orderBy('username')->get();

        return view('margin_penjualan.create', compact('users'));
    }

    // Simpan margin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'persen' => 'required|numeric|min:0|max:9999.99',
            'iduser' => 'required|exists:user,iduser',
        ]);

        DB::table('margin_penjualan')->insert([
            'persen' => $validated['persen'],
            'iduser' => $validated['iduser'],
        ]);

        return redirect()
            ->route('margin-penjualan.index')
            ->with('success', 'Margin penjualan berhasil ditambahkan.');
    }

    // Form edit margin
    public function edit($id)
    {
        $margin = DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->first();

        if (!$margin) {
            abort(404);
        }

        $users = DB::table('user')->orderBy('username')->get();

        return view('margin_penjualan.edit', compact('margin', 'users'));
    }

    // Update margin
    public function update(Request $request, $id)
    {
        $margin = DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->first();

        if (!$margin) {
            abort(404);
        }

        $validated = $request->validate([
            'persen' => 'required|numeric|min:0|max:9999.99',
            'iduser' => 'required|exists:user,iduser',
        ]);

        DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->update([
                'persen' => $validated['persen'],
                'iduser' => $validated['iduser'],
            ]);

        return redirect()
            ->route('margin-penjualan.index')
            ->with('success', 'Margin penjualan berhasil diperbarui.');
    }

    // Mengubah status margin
    public function toggleStatus($id)
    {
        $margin = DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->first();

        if (!$margin) {
            abort(404);
        }

        DB::table('margin_penjualan')
            ->where('idmargin_penjualan', $id)
            ->update([
                'status' => $margin->status == 1 ? 0 : 1,
            ]);

        return redirect()
            ->route('margin-penjualan.index')
            ->with('success', 'Status margin berhasil diperbarui.');
    }
}
