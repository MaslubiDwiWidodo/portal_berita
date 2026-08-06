<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    // ==========================
    // FORM TULIS BERITA
    // ==========================
    public function index()
    {
        $categories = Category::orderBy('category_name')->get();

        return view('articles.index', compact('categories'));
    }

    // ==========================
    // SIMPAN BERITA
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => ['required', Rule::in(['draft', 'published'])],
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'title'       => $request->title,
            'content'     => $request->content,
            'status'      => $request->status,
            'category_id' => $request->category_id,
            'user_id'     => auth()->id(),
            'image'       => $imageName,
        ]);

        return redirect()->route('articles.list')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    // ==========================
    // LIST BERITA ADMIN
    // ==========================
    public function list()
    {
        $articles = Article::with(['category', 'user'])
            ->latest()
            ->get();

        return view('articles.list', compact('articles'));
    }

    // ==========================
    // FORM EDIT
    // ==========================
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::orderBy('category_name')->get();

        return view('articles.edit', compact('article', 'categories'));
    }

    // ==========================
    // UPDATE BERITA
    // ==========================
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status'      => ['required', Rule::in(['draft', 'published'])],
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imageName = $article->image;

        if ($request->hasFile('image')) {
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $imageName = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'title'       => $request->title,
            'content'     => $request->content,
            'status'      => $request->status,
            'category_id' => $request->category_id,
            'image'       => $imageName,
        ]);

        return redirect()->route('articles.list')
            ->with('success', 'Berita berhasil diupdate.');
    }

    // ==========================
    // HAPUS BERITA
    // ==========================
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('articles.list')
            ->with('success', 'Berita berhasil dihapus.');
    }

    // ==========================
    // WEBSITE PUBLIK
    // ==========================
    public function website(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $categories = Category::orderBy('category_name')->get();

        $articles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('website.index', compact(
            'articles',
            'categories',
            'search',
            'category'
        ));
    }

    // ==========================
    // DETAIL BERITA
    // ==========================
    public function show($id)
    {
        $article = Article::with(['category', 'user'])
            ->findOrFail($id);

        $relatedArticles = Article::with(['category', 'user'])
            ->where('status', 'published')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('website.show', compact(
            'article',
            'relatedArticles'
        ));
    }
}