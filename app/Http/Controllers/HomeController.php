<?php

namespace App\Http\Controllers;

use App\Http\Services\Backend\HomeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        // Pastikan pengguna terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Inisialisasi variabel $data
        $data = [];

        if (Auth::user()->role == 'owner') {
            $data = $this->homeService->getOwnerStatistics();
        } else {
            $data = $this->homeService->getUserStatistics();
            $data['userCategories'] = $this->homeService->getUserCategories(); // Ambil kategori penulis
        }

        $articleStats = $this->homeService->getArticleStatistics();

        // Kirim data ke tampilan
        return view('home', compact('data', 'articleStats'));
    }

}

