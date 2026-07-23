<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalBerita = Article::count();
        $totalDraft = Article::where('status', 'draft')->count();
        $totalPublished = Article::where('status', 'published')->count();
        $totalKategori = Category::count();
        $totalUser = User::count();

        // Berita terbaru
        $latestArticles = Article::latest()
            ->take(5)
            ->get();

        // Grafik berdasarkan kategori
        $categories = Category::withCount('articles')->get();

        $chartLabels = $categories->pluck('category_name');

        $chartData = $categories->pluck('articles_count');

        return view('dashboard', compact(
            'totalBerita',
            'totalDraft',
            'totalPublished',
            'totalKategori',
            'totalUser',
            'latestArticles',
            'chartLabels',
            'chartData'
        ));
    }
}