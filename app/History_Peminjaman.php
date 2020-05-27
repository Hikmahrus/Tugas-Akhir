<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History_Peminjaman extends Model
{
  protected $table = "history__peminjamen";
  protected $guarded = [''];
  public $timestamps = false;
}
