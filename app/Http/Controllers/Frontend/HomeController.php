<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\TagService;
use App\Http\Services\Frontend\ArticleService;
use App\Http\Services\Frontend\CategoryService;

class HomeController extends Controller
{
    public function __construct(
        private ArticleService $articleService,
        private CategoryService $categoryService,
        private TagService $tagService
    ) {}

    public function index()
    {
        // Mengambil artikel terbaru
        $main_post = Article::with('category:id,name', 'user:id,name')
            ->select('id', 'user_id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->latest()
            ->where('published', true)
            ->where('is_confirm', true)
            ->first();

        // Mengambil artikel terpopuler
        $top_view = Article::with('category:id,name', 'tags:id,name')
            ->select('id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image')
            ->orderBy('views', 'desc')
            ->where('published', true)
            ->where('is_confirm', true)
            ->first();

        // Mengambil artikel terbaru untuk sidebar
        $latest_articles = Article::with('category:id,name')
            ->where('published', true)
            ->where('is_confirm', true)
            ->latest()
            ->limit(5)
            ->get();

        // artikel terbaru semua kategori
        $main_post_all = Article::with('category:id,name')
            ->select('id', 'category_id', 'title', 'slug', 'published', 'is_confirm', 'views', 'image')
            ->latest()
            ->where('published', true)
            ->where('is_confirm', true)
            ->where('id', '!=', $main_post->id)
            ->limit(6)
            ->get();

        // Artikel populer selain main_post
        $popular_articles = Article::with('category:id,name')
            ->select('id', 'category_id', 'title', 'slug', 'published_at', 'views', 'image')
            ->where('published', true)
            ->where('is_confirm', true)
            ->where('id', '!=', $main_post->id)
            ->orderBy('views', 'desc')
            ->limit(4)
            ->get();

        // Mengambil artikel terpopuler di lifestyle
        $top_lifestyle = Article::with('category:id,name', 'tags:id,name')
            ->select('id', 'category_id', 'title', 'slug', 'content', 'published', 'is_confirm', 'views', 'image', 'created_at')
            ->orderBy('views', 'desc')
            ->where('published', true)
            ->where('is_confirm', true)
            ->limit(4) // Batasi jumlah artikel lifestyle
            ->get();




        // Mengambil trending tags menggunakan TagService
        $tags = $this->tagService->randomTag();

        // Mengambil kategori acak
        $categories = $this->categoryService->randomCategory();

        return view('frontend.home.index', [
            'main_post' => $main_post,
            'top_view' => $top_view,
            'latest_articles' => $latest_articles,
            'main_post_all' => $main_post_all,
            'popular_articles' => $popular_articles,
            'top_lifestyle' => $top_lifestyle,
            'tags' => $tags,
            'categories' => $categories
        ]);
    }
}
