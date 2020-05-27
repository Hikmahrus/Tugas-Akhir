<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->string('name');
            $table->string('img');
            $table->string('pdf');
            $table->string('penulis');
            $table->string('penerbit');
            $table->year('thn_terbit');
            $table->integer('kategori_id')->unsigned();
            $table->text('desc');
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris')->ondelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_books');
    }
}
