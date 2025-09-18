<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('beritas', function (Blueprint $table) {
      $table->id();
      $table->string('judul_berita');
      $table->string('slug');
      $table->integer('id_kategori');
      $table->string('gambar');
      $table->longText('konten_berita');
      $table->integer('dilihat')->default(0);
      $table->integer('id_admin');
      $table->string('seo_title')->nullable();
      $table->string('seo_subtitle')->nullable();
      $table->string('seo_keywords')->nullable();
      $table->string('seo_deskripsi')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('beritas');
  }
}
