<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
        $users = DB::select('SELECT * FROM v_master_user');

        return view('user.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        $roles = DB::table('role')->orderBy('nama_role')->get();

        return view('user.create', compact('roles'));
    }

    // Simpan user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:45|unique:user,username',
            'password' => 'required|string|min:8|confirmed',
            'idrole' => 'required|exists:role,idrole',
        ]);

        DB::table('user')->insert([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'idrole' => $validated['idrole'],
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // Form edit user
    public function edit($id)
    {
        $user = DB::table('user')
            ->where('iduser', $id)
            ->first();

        if (!$user) {
            abort(404);
        }

        $roles = DB::table('role')->orderBy('nama_role')->get();

        return view('user.edit', compact('user', 'roles'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = DB::table('user')
            ->where('iduser', $id)
            ->first();

        if (!$user) {
            abort(404);
        }

        $validated = $request->validate([
            'username' => 'required|string|max:45|unique:user,username,' . $id . ',iduser',
            'idrole' => 'required|exists:role,idrole',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'username' => $validated['username'],
            'idrole' => $validated['idrole'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        DB::table('user')
            ->where('iduser', $id)
            ->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }
}
