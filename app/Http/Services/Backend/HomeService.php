<?php

namespace App\Http\Services\Backend;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeService
{
    // Statistik Owner
    public function getOwnerStatistics()
    {
        $totalArticles = Article::count();
        $pendingArticles = Article::where('published', 0)->count();
        $categories = Category::withCount('articles')->get();

        return [
            'totalArticles' => $totalArticles,
            'pendingArticles' => $pendingArticles,
            'categories' => $categories
        ];
    }

    // Statistik untuk Penulis
    public function getUserStatistics()
    {
        $userArticles = Article::where('user_id', Auth::id())->count();
        $userPendingArticles = Article::where('user_id', Auth::id())->where('published', 0)->count();

        return [
            'userArticles' => $userArticles,
            'userPendingArticles' => $userPendingArticles
        ];
    }

    // Statistik Artikel per Bulan
    public function getArticleStatistics()
    {
        return Article::selectRaw('MONTH(created_at) as month, COUNT(*) as total_articles, SUM(CASE WHEN published = 0 THEN 1 ELSE 0 END) as pending_articles')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($stat) {
                return [
                    'month' => date('F', mktime(0, 0, 0, $stat->month, 1)), // Mengubah angka bulan menjadi nama bulan
                    'total_articles' => $stat->total_articles,
                    'pending_articles' => $stat->pending_articles,
                ];
            });
    }

    // Ambil kategori yang dimiliki oleh penulis
    // HomeService.php atau Controller yang relevan
    public function getUserCategories()
    {
        return Category::withCount(['articles' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->get();
    }
}
