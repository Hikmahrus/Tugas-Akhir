<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekapHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bulan');
            $table->year('thn');
            $table->integer('total_buku');
            $table->integer('total_ebook');
            $table->integer('total_petugas');
            $table->integer('total_user');
            $table->integer('total_peminjaman');
            $table->integer('total_denda');
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
        Schema::dropIfExists('rekap_histories');
    }
}
