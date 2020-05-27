<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman_eBook extends Model
{
  protected $fillable = ['user_id','kode_ebook','ebook_id','tgl_kembali','max_kembali'];
  public $timestamps = false;

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function ebook()
  {
    return $this->belongsTo('App\eBook');
  }
}
