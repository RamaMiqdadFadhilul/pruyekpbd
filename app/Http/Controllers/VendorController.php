<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    // Menampilkan daftar vendor
     public function index()
    {
        $vendors = DB::select('SELECT * FROM v_master_vendor');

        return view('vendor.index', compact('vendors'));
    }

    // Menampilkan form tambah vendor
    public function create()
    {
        return view('vendor.create');
    }

    // Menyimpan vendor baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_vendor' => 'required|string|max:100',
            'badan_hukum' => 'nullable|string|max:1',
        ]);

        DB::table('vendor')->insert([
            'nama_vendor' => $validated['nama_vendor'],
            'badan_hukum' => $validated['badan_hukum'] ?? null,
        ]);

        return redirect()
            ->route('vendor.index')
            ->with('success', 'Vendor berhasil ditambahkan.');
    }

    // Menampilkan form edit vendor
    public function edit($id)
    {
        $vendor = DB::table('vendor')
            ->where('idvendor', $id)
            ->first();

        if (!$vendor) {
            abort(404);
        }

        return view('vendor.edit', compact('vendor'));
    }

    // Memperbarui vendor
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_vendor' => 'required|string|max:100',
            'badan_hukum' => 'nullable|string|max:1',
        ]);

        DB::table('vendor')
            ->where('idvendor', $id)
            ->update([
                'nama_vendor' => $validated['nama_vendor'],
                'badan_hukum' => $validated['badan_hukum'] ?? null,
            ]);

        return redirect()
            ->route('vendor.index')
            ->with('success', 'Vendor berhasil diperbarui.');
    }

    // Menonaktifkan vendor
    public function destroy($id)
    {
        DB::table('vendor')
            ->where('idvendor', $id)
            ->update([
                'status' => 'N',
            ]);

        return redirect()
            ->route('vendor.index')
            ->with('success', 'Vendor berhasil dinonaktifkan.');
    }
}
