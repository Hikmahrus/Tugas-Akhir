<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Peminjaman_Buku;
use App\User;
use App\Buku;

class BatasPengambilan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $peminjaman;
    public $user;
    public $buku;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id_peminjaman,$user,$id_buku)
    {
        $this->peminjaman = $id_peminjaman;
        $this->user = $user;
        $this->buku = $id_buku;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $batas_pengambilan = Peminjaman_Buku::where('id','=',$this->peminjaman)->first();
      if ($batas_pengambilan->status == 0) {
        User::where('id','=',$this->user)->increment('borrow_limit',1);
        $status = Buku::find($this->buku);
        $status['status'] = 1;
        $status->save();
        $batas_pengambilan->delete();
      } else {

      }
    }
}
