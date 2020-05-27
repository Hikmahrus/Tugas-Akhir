<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = "bukus";
    protected $fillable = ['name','kode','img','penulis','penerbit','desc','kategori_id','thn_terbit'];

    public function kategori()
    {
      return $this->belongsTo('App\Kategori');
    }
}
