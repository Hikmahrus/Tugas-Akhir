<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama'];

    public function buku()
    {
      return $this->hasMany('App\Buku');
    }

    public function ebook()
    {
      return $this->hasMany('App\eBook');
    }
}
