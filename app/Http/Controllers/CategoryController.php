<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // =========================
    // Cek Role Admin & Editor
    // =========================
    private function checkAccess()
    {
        if (!in_array(auth()->user()->role, ['admin', 'editor'])) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }
    }

    // =========================
    // Daftar Kategori
    // =========================
    public function index()
    {
        $this->checkAccess();

        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    // =========================
    // Tambah Kategori
    // =========================
    public function store(Request $request)
    {
        $this->checkAccess();

        $request->validate([
            'category_name' => 'required|max:100'
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    // =========================
    // Hapus Kategori
    // =========================
    public function destroy($id)
    {
        $this->checkAccess();

        Category::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}