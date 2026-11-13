<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    // Menampilkan daftar role
    public function index(Request $request)
    {
        $search = $request->input('search');

        $roles = DB::table('role')
            ->when($search, function ($query, $search) {
                $query->where('idrole', 'like', "%{$search}%")
                      ->orWhere('nama_role', 'like', "%{$search}%");
            })
            ->orderBy('nama_role')
            ->paginate(10)
            ->withQueryString();

        return view('role.index', compact('roles', 'search'));
    }

    // Form tambah role
    public function create()
    {
        return view('role.create');
    }

    // Simpan role
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_role' => 'required|string|max:100|unique:role,nama_role',
        ]);

        DB::table('role')->insert([
            'nama_role' => $validated['nama_role'],
        ]);

        return redirect()
            ->route('role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    // Form edit role
    public function edit($id)
    {
        $role = DB::table('role')
            ->where('idrole', $id)
            ->first();

        if (!$role) {
            abort(404);
        }

        return view('role.edit', compact('role'));
    }

    // Update role
    public function update(Request $request, $id)
    {
        $role = DB::table('role')
            ->where('idrole', $id)
            ->first();

        if (!$role) {
            abort(404);
        }

        $validated = $request->validate([
            'nama_role' => 'required|string|max:100|unique:role,nama_role,' . $id . ',idrole',
        ]);

        DB::table('role')
            ->where('idrole', $id)
            ->update([
                'nama_role' => $validated['nama_role'],
            ]);

        return redirect()
            ->route('role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }
}
