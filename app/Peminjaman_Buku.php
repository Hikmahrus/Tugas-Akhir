<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman_Buku extends Model
{
    protected $fillable = ['user_id','kode_buku','buku_id','tgl_kembali','max_kembali'];
    protected $dates = ['tgl_pinjam','max_kembali'];
    public $timestamps = false;

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function buku()
    {
      return $this->belongsTo('App\Buku');
    }
}
