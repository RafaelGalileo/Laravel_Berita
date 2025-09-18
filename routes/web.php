<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\mediaSosialController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [FrontEndController::class, 'index'])->name('index');

Auth::routes();

// Home
Route::get('/berita/{slug}', [FrontEndController::class, 'tabBerita'])->name('tabBerita');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Admin Lupa Password
Route::get('/admin/forgetPassword', [AdminLoginController::class, 'forgetPassword'])->name('forgetPassword');

Route::prefix('/admin')->group(function () {
  // Login Admin
  Route::match(['get', 'post'], '/login', [AdminLoginController::class, 'adminLogin'])->name('adminLogin');
  Route::group(['middleware' => 'admin'], function () {
    // Dasbor Admin
    Route::get('/dashboard', [AdminLoginController::class, 'adminDashboard'])->name('adminDashboard');
    // Profil Admin
    Route::get('/profil', [AdminLoginController::class, 'profil'])->name('profil');
    // Profil Update
    Route::post('/profil/update/{id}', [AdminLoginController::class, 'updateprofil'])->name('updateprofil');
    // Ganti Password
    Route::get('/profil/ganti_password', [AdminLoginController::class, 'gantiPassword'])->name('gantiPassword');
    // Cek Password Saat ini
    Route::post('/profil/cek_password', [AdminLoginController::class, 'cekPassword'])->name('cekPassword');
    // Update Password
    Route::post('/profil/update_password/{id}', [AdminLoginController::class,  'updatePassword'])->name('updatePassword');


    // Kategori
    Route::get('/kategori/index', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/tambah', [KategoriController::class, 'tambah'])->name('kategori.tambah');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('hapus-kategori/{id}', [KategoriController::class, 'delete'])->name('hapus.kategori');

    // Berita
    Route::get('/berita/index', [BeritaController::class, 'index'])->name('index.berita');
    Route::get('/berita/tambah', [BeritaController::class, 'tambah'])->name('tambah.berita');
    Route::post('/berita/store', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/edit/{id}', [BeritaController::class, 'edit'])->name('edit.berita');
    Route::post('/berita/update/{id}', [BeritaController::class, 'update'])->name('update_berita');
    Route::get('hapus-berita/{id}', [BeritaController::class, 'delete'])->name('hapus.berita');


    Route::post('ckeditor', 'CkeditorFileUploadController@store')->name('ckeditor.upload');

    // media sosial
    Route::get('/pengaturan/medsos', [mediaSosialController::class, 'medsos'])->name('medsos');
    Route::post('/pengaturan/medsos/{id}', [mediaSosialController::class, 'medsosUpdate'])->name('medsosUpdate');


    // Kelola Tema
    Route::get('/theme', [ThemeController::class, 'theme'])->name('theme');
    Route::post('/theme/update/{id}', [ThemeController::class, 'themeUpdate'])->name('themeUpdate');
  });
  // Logout admin
  Route::get('/admin/logout', [AdminLoginController::class, 'adminLogout'])->name('adminLogout');
});
