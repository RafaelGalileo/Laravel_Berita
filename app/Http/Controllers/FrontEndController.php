<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Theme;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    //Halaman Index
    public function index()
    {
        $latest_news = Berita::latest()->where('status', 1)->take(3)->get();
        $news_latest = Berita::latest()->where('status', 1)->paginate(4);
        $theme = Theme::first();
        $kategoris = Kategori::where('status', 1)->where('parent_id', 0)->get();
        $kategori_berita_dilihat = Berita::orderBy('dilihat', 'DESC')->take(5)->get();
        $berita_terpopuler = Berita::where('status', 1)->orderBy('dilihat', 'DESC')->take(4)->get();
        $berita_terkini = Berita::where('status', 1)->latest()->take(4)->get();
        return view('index', compact('latest_news', 'theme', 'news_latest', 'kategoris', 'kategori_berita_dilihat', 'berita_terpopuler', 'berita_terkini'));
    }

    // Halaman tab Berita
    public function tabBerita($slug)
    {
        $theme = Theme::first();
        $detail_berita = Berita::where('slug', $slug)->first();

        $beritaKey = 'berita_' . $detail_berita->id;
        if (!Session::has($beritaKey)) {
            $detail_berita->increment('dilihat');
            Session::put($beritaKey, 1);
        }

        $berita_terkait = Berita::where('id_kategori', '=', $detail_berita->id_kategori)->where('id', '!=', $detail_berita->id)->take(3)->get();

        return view('tabBerita', compact('detail_berita', 'theme', 'berita_terkait'));
    }
}
