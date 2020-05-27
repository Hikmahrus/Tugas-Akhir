<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryPeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history__peminjamen', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama');
          $table->string('buku');
          $table->string('kode_buku');
          $table->string('tgl_peminjaman');
          $table->string('tgl_pengembalian')->default(DB::raw('CURRENT_TIMESTAMP'));;
          $table->integer('denda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history__peminjamen');
    }
}
