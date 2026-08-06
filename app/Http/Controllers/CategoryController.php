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
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'editor'])) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }
    }

    // =========================
    // Daftar Kategori
    // =========================
    public function index()
    {
        $this->checkAccess();

        $categories = Category::withCount('articles')->latest()->get();

        return view('categories.index', compact('categories'));
    }

    // =========================
    // Tambah Kategori
    // =========================
    public function store(Request $request)
    {
        $this->checkAccess();

        $request->validate([
            'category_name' => 'required|string|max:100|unique:categories,category_name'
        ], [
            'category_name.unique' => 'Nama kategori sudah ada.'
        ]);

        Category::create([
            'category_name' => trim($request->category_name)
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    // =========================
    // Hapus Kategori
    // =========================
    public function destroy($id)
    {
        $this->checkAccess();

        $category = Category::findOrFail($id);

        if ($category->articles()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki artikel.');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}