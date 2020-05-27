<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanEBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_e_books', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('ebook_id')->unsigned();
          $table->string('kode_ebook');
          $table->dateTime('tgl_pinjam')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->dateTime('max_kembali')->nullable();

          $table->foreign('user_id')->references('id')->on('users')->ondelete('CASCADE');
          $table->foreign('ebook_id')->references('id')->on('e_books')->ondelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_e_books');
    }
}
