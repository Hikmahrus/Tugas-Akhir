<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman__bukus', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('buku_id')->unsigned();
          $table->string('kode_buku');
          $table->boolean('status')->default(0);
          $table->dateTime('tgl_pinjam')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->dateTime('max_kembali')->nullable();

          $table->foreign('user_id')->references('id')->on('users')->ondelete('CASCADE');
          $table->foreign('buku_id')->references('id')->on('bukus')->ondelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman__bukus');
    }
}
