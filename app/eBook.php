<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eBook extends Model
{
    protected $table = "e_books";
    protected $fillable = ['pdf','kode','name','img','penulis','penerbit','desc','kategori_id','thn_terbit'];

    public function kategori()
    {
      return $this->belongsTo('App\Kategori');
    }
}
