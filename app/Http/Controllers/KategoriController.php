<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // Daftar Kategori
    public function index()
    {
        Session::put('admin_page', 'kategori');
        $kategoris = Kategori::latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    // Tambah Kategori
    public function tambah()
    {
        Session::put('admin_page', 'kategori');
        $kategoris = Kategori::where('parent_id', 0)->get();
        return view('admin.kategori.tambah', compact('kategoris'));
    }

    // Simpan Kategori
    public function store(Request $request)
    {
        $data = $request->all();
        // validasi data
        $validasiData = $request->validate([
            'nama_kategori' => 'required|max:255',
            'parent_id' => 'required',
            'deskripsi' => 'required',
        ]);
        $kategori = new Kategori();
        $kategori->nama_kategori = $data['nama_kategori'];
        $kategori->slug = Str::slug($data['nama_kategori']);
        $kategori->deskripsi = $data['deskripsi'];
        $kategori->parent_id = $data['parent_id'];
        if (!empty($data['status'])) {
            $kategori->status = 1;
        } else {
            $kategori->status = 0;
        }
        $kategori->save();
        Session::flash('pesan_sukses', 'Kategori telah ditambahkan');
        return redirect()->back();
    }

    // edit kategori
    public function edit($id)
    {
        Session::put('admin_page', 'kategori');
        $kategori = Kategori::findOrFail($id);
        $kategoris = Kategori::where('parent_id', 0)->get();
        return view('admin.kategori.edit', compact('kategori', 'kategoris'));
    }

    // update kategori
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $kategori = Kategori::findOrFail($id);
        // validasi data
        $validasiData = $request->validate([
            'nama_kategori' => 'required|max:255',
            'parent_id' => 'required',
            'deskripsi' => 'required',
        ]);
        $kategori->nama_kategori = $data['nama_kategori'];
        $kategori->slug = Str::slug($data['nama_kategori']);
        $kategori->deskripsi = $data['deskripsi'];
        $kategori->parent_id = $data['parent_id'];
        if (!empty($data['status'])) {
            $kategori->status = 1;
        } else {
            $kategori->status = 0;
        }
        $kategori->save();
        Session::flash('pesan_sukses', 'Kategori berhasil diubah');
        return redirect()->back();
    }

    // Hapus Kategori
    public function delete($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        DB::table('kategoris')->where('parent_id', $id)->delete();
        DB::table('beritas')->where('id_kategori', $id)->delete();
        Session::flash('pesan_sukses', 'Kategori berhasil dihapus');
        return redirect()->back();
    }
}
