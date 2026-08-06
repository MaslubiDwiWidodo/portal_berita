<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // =========================
    // Cek Role Admin
    // =========================
    private function checkAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki hak akses.');
        }
    }

    // =========================
    // Daftar Pengguna
    // =========================
    public function index()
    {
        $this->checkAdmin();

        $users = User::latest()->get();

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

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'role'     => ['required', Rule::in(['admin', 'editor', 'penulis'])],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users')->with('success', 'Pengguna berhasil ditambahkan.');
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

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role'  => ['required', Rule::in(['admin', 'editor', 'penulis'])],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // =========================
    // Hapus Pengguna
    // =========================
    public function destroy($id)
    {
        $this->checkAdmin();

        if (auth()->id() == $id) {
            return redirect()->route('users')->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'Pengguna berhasil dihapus.');
    }
}