<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\User;
use App\Buku;
use App\eBook;
use App\History_Peminjaman;
use App\RekapHistory;

class EndMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekap:bulan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menyimpan Rekap Setiap Bulan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      //get current time
      $now = Carbon::now();
      //get current month from current time
      $now_month = Carbon::createFromFormat('Y-m-d H:i:s',$now)->month;
      $now_year = Carbon::createFromFormat('Y-m-d H:i:s',$now)->year;
      $buku = Buku::all()->count();
      $ebook = eBook::all()->count();
      $petugas = User::where('role','=',1)->get()->count();
      $user = User::where('role','=',0)->count();
      $month = History_Peminjaman::whereMonth('tgl_pengembalian','=',$now_month)->count();
      $denda = History_Peminjaman::select('denda')->whereMonth('tgl_pengembalian','=',$now_month)->sum('denda');
      RekapHistory::create([
        'bulan' => $now_month,
        'thn' => $now_year,
        'total_buku' => $buku,
        'total_ebook' => $ebook,
        'total_petugas' => $petugas,
        'total_user' => $user,
        'total_peminjaman' => $month,
        'total_denda' => $denda,
      ]);
    }
}
