<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BeritaController extends Controller
{
  // Index Berita (Admin)
  public function index()
  {
    $berita = Berita::with('kategori', 'admin')->orderBy('id', 'DESC')->get();
    return \view('admin.berita.index', compact('berita'));
  }

  // Tambah Berita (Form)
  public function tambah()
  {
    Session::put('admin_page', 'berita');

    // Kategori dan sub-kategori aktif
    $kategoris = Kategori::where(['parent_id' => 0])->where('status', 1)->get();

    $kategoris_dropdown = " Pilih Kategori ..... ";
    foreach ($kategoris as $kat) {
      $kategoris_dropdown .= "<option value='" . $kat->id . "'>" . $kat->nama_kategori . "</option>";
      $sub_kategoris = Kategori::where(['parent_id' => $kat->id])->get();
      foreach ($sub_kategoris as $sub_kat) {
        $kategoris_dropdown .= "<option value='" . $sub_kat->id . "'> ---- " . $sub_kat->nama_kategori . " </option>";
      }
    }

    return \view('admin.berita.tambah', compact('kategoris', 'kategoris_dropdown'));
  }

  // Simpan Berita
  public function store(Request $request)
  {
    $data = $request->all();

    $validasiData = $request->validate([
      'judul_berita'   => 'required|max:255',
      'id_kategori'    => 'required',
      'konten_berita'  => 'required',
      'gambar'         => 'required|image',
    ]);

    $berita = new Berita();
    $berita->judul_berita  = $data['judul_berita'];
    $berita->slug          = Str::slug($data['judul_berita']);
    $berita->id_kategori   = $data['id_kategori'];
    $berita->konten_berita = $data['konten_berita'];

    $current_user = Auth::guard('admin')->user();
    $berita->id_admin = $current_user ? $current_user->id : null;

    $berita->seo_title     = $data['seo_title']     ?? null;
    $berita->seo_subtitle  = $data['seo_subtitle']  ?? null;
    $berita->seo_keywords  = $data['seo_keywords']  ?? null;
    $berita->seo_deskripsi = $data['seo_deskripsi'] ?? null;

    $berita->status = !empty($data['status']) ? 1 : 0;

    // path upload absolut
    $slug   = Str::slug($data['judul_berita']);
    $random = rand(1, 999999);

    $uploadDir = public_path('uploads/berita');
    if (!File::exists($uploadDir)) {
      File::makeDirectory($uploadDir, 0755, true);
    }
    if (!is_writable($uploadDir)) {
      @chmod($uploadDir, 0755);
    }

    if ($request->hasFile('gambar')) {
      $image_tmp = $request->file('gambar');
      if ($image_tmp->isValid()) {
        $extension = $image_tmp->getClientOriginalExtension();
        $filename  = $slug . '-' . $random . '.' . $extension;
        $fullPath  = $uploadDir . DIRECTORY_SEPARATOR . $filename;

        Image::make($image_tmp)->save($fullPath);
        $berita->gambar = $filename;
      }
    }

    $berita->save();

    Session::flash('pesan_sukses', 'Berita telah ditambahkan');
    return redirect()->back();
  }

  // Edit Berita (Form)
  public function edit($id)
  {
    Session::put('admin_page', 'berita');

    $berita = Berita::findOrFail($id);

    $kategoris = Kategori::where(['parent_id' => 0])->where('status', 1)->get();
    $kategoris_dropdown = " Pilih Kategori ..... ";
    foreach ($kategoris as $kat) {
      $selected = ($kat->id == $berita->id_kategori) ? "selected" : "";
      $kategoris_dropdown .= "<option value='" . $kat->id . "' " . $selected . ">" . $kat->nama_kategori . "</option>";

      $sub_kategoris = Kategori::where(['parent_id' => $kat->id])->get();
      foreach ($sub_kategoris as $sub_kat) {
        $selected = ($sub_kat->id == $berita->id_kategori) ? "selected" : "";
        $kategoris_dropdown .= "<option value='" . $sub_kat->id . "' " . $selected . "> ---- " . $sub_kat->nama_kategori . " </option>";
      }
    }

    return \view('admin.berita.edit', compact('berita', 'kategoris_dropdown'));
  }

  // Update Berita
  public function update(Request $request, $id)
  {
    $data = $request->all();

    $validasiData = $request->validate([
      'judul_berita'   => 'required|max:255',
      'id_kategori'    => 'required',
      'konten_berita'  => 'required',
      // gambar tidak wajib saat update
    ]);

    $berita = Berita::findOrFail($id);

    $berita->judul_berita  = $data['judul_berita'];
    $berita->slug          = Str::slug($data['judul_berita']);
    $berita->id_kategori   = $data['id_kategori'];
    $berita->konten_berita = $data['konten_berita'];

    $current_user = Auth::guard('admin')->user();
    $berita->id_admin = $current_user ? $current_user->id : $berita->id_admin;

    $berita->seo_title     = $data['seo_title']     ?? null;
    $berita->seo_subtitle  = $data['seo_subtitle']  ?? null;
    $berita->seo_keywords  = $data['seo_keywords']  ?? null;
    $berita->seo_deskripsi = $data['seo_deskripsi'] ?? null;

    $berita->status = !empty($data['status']) ? 1 : 0;

    $slug   = Str::slug($data['judul_berita']);
    $random = rand(1, 999999);

    $uploadDir = public_path('uploads/berita');
    if (!File::exists($uploadDir)) {
      File::makeDirectory($uploadDir, 0755, true);
    }
    if (!is_writable($uploadDir)) {
      @chmod($uploadDir, 0755);
    }

    if ($request->hasFile('gambar')) {
      $image_tmp = $request->file('gambar');
      if ($image_tmp->isValid()) {
        $extension = $image_tmp->getClientOriginalExtension();
        $filename  = $slug . '-' . $random . '.' . $extension;
        $fullPath  = $uploadDir . DIRECTORY_SEPARATOR . $filename;

        Image::make($image_tmp)->save($fullPath);

        // Hapus file lama jika ada
        if (!empty($data['current_image'])) {
          $oldPath = $uploadDir . DIRECTORY_SEPARATOR . $data['current_image'];
          if (File::exists($oldPath)) {
            @unlink($oldPath);
          }
        }

        $berita->gambar = $filename;
      }
    }

    $berita->save();

    Session::flash('pesan_sukses', 'Berita Berhasil Diubah');
    return redirect()->back();
  }

  // Hapus Berita
  public function delete($id)
  {
    $berita = Berita::findOrFail($id);

    // Hapus file gambar jika ada
    $uploadDir = public_path('uploads/berita');
    if (!empty($berita->gambar)) {
      $filePath = $uploadDir . DIRECTORY_SEPARATOR . $berita->gambar;
      if (File::exists($filePath)) {
        @unlink($filePath);
      }
    }

    $berita->delete();

    Session::flash('pesan_sukses', 'Berita Berhasil Dihapus');
    return redirect()->back();
  }
}
