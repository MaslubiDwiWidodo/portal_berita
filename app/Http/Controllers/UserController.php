<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =========================
    // Cek Role Admin
    // =========================
    private function checkAdmin()
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki hak akses.');
        }
    }

    // =========================
    // Daftar Pengguna
    // =========================
    public function index()
    {
        $this->checkAdmin();

        $users = User::all();

        return view('users.index', compact('users'));
    }

    // =========================
    // Form Tambah Pengguna
    // =========================
    public function create()
    {
        $this->checkAdmin();

        return view('users.create');
    }

    // =========================
    // Simpan Pengguna
    // =========================
    public function store(Request $request)
    {
        $this->checkAdmin();

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users');
    }

    // =========================
    // Form Edit Pengguna
    // =========================
    public function edit($id)
    {
        $this->checkAdmin();

        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    // =========================
    // Update Pengguna
    // =========================
    public function update(Request $request, $id)
    {
        $this->checkAdmin();

        $user = User::findOrFail($id);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('users');
    }

    // =========================
    // Hapus Pengguna
    // =========================
    public function destroy($id)
    {
        $this->checkAdmin();

        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users');
    }
}