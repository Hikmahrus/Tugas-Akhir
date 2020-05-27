<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\eBook;
use App\User;
use App\Petugas;
use App\Peminjaman_Buku;
use App\Peminjaman_eBook;
use App\History_Peminjaman;
use Auth;
use Carbon\Carbon;
use App\Jobs\BatasPengambilan;
use PDF;

class ProsesController extends Controller
{
    public function Bukti_Peminjaman($id)
    {
      $data = Peminjaman_Buku::find($id);
      $pdf = PDF::loadview('user.bukti',compact('data'));
      return $pdf->setPaper('a6')->download('bukti');
    }

    public function View_Bukti($id)
    {
      $data = Peminjaman_Buku::find($id);
      return view('user.view_bukti',compact('data'));
    }

    //cari data master buku
    public function Search_Book(Request $request)
    {
      $cari = $request->search;
      $book = Buku::where('name','like','%'.$cari.'%')->orWhere('kode','like','%'.$cari.'%')->get();
      return view('admin.result_buku',compact('book'));
    }

    //cari data master ebook
    public function Search_eBook(Request $request)
    {
      $cari = $request->search;
      $ebook = eBook::where('name','like','%'.$cari.'%')->orWhere('kode','like','%'.$cari.'%')->get();
      return view('admin.result_ebook',compact('ebook'));
    }

    // search data user
    public function Search(Request $request)
    {
      $cari = $request->search;
      $book = Buku::where('name','like','%'.$cari.'%')->get();
      $ebook = eBook::where('name','like','%'.$cari.'%')->get();
      return view('user.result',compact('book','ebook'));
    }

    //buku dan ebook yang dipinjam user
    public function User_Borrow()
    {
      $user = Auth::user()->id;
      $buku = Peminjaman_Buku::where('user_id','=',$user)->get();
      $ebook = Peminjaman_eBook::where('user_id','=',$user)->get();
      return view('user.buku_user',compact('buku','ebook'));
    }

    public function Buku_Horor()
    {
      $data['horor'] = Buku::where('kategori_id','=',1)->groupBy('name')->get();
      return view('user.book_horor',$data);
    }

    public function Buku_Comedy()
    {
      $data['comedy'] = Buku::where('kategori_id','=',2)->groupBy('name')->get();
      return view('user.book_comedy',$data);
    }

    public function Buku_Novel()
    {
      $data['novel'] = Buku::where('kategori_id','=',4)->groupBy('name')->get();
      return view('user.book_novel',$data);
    }

    public function Read_pdf(Request $request,$id)
    {
      // $user = Auth::user()->id;
      // $cek = Peminjaman_eBook::where('user_id','=',$user)->first();
      // if ($cek == null) {
      //   return redirect()->back();
      // } else {
      //   $id_buku = $cek->id;
      //   $privilage = $request->id_buku;
      //   if ($privilage == $id_buku) {
      //     $data['ebook'] = eBook::find($id);
      //     return view('user.ebookread',$data);
      //   } else {
      //     return redirect()->back();
      //   }
      // }
      $data['ebook'] = eBook::find($id);
      return view('user.ebookread',$data);
    }

    public function Detail_Book($id)
    {
      $data = Buku::find($id);
      $name = $data->name;
      $book = Buku::where('name','=',$name)->orderBy('status','DESC')->get();
      return view('user.borrow_view',compact('data','book'));
    }

    public function Detail_eBook($id)
    {
      $data = eBook::find($id);
      return view('user.borrow_view_ebook',compact('data'));
    }

    public function Cancel($id)
    {
      $buku = Peminjaman_Buku::find($id);
      $buku['status'] = 1;
      $buku->save();
      return redirect()->back();
    }

    public function Peminjaman_Book(Request $request,$id)
    {
      $user = Auth::user()->id;
      $buku = Buku::find($id);
      $id_buku = $buku->id;
      $borrow_limit = User::where('id','=',$user)->first();
      //max tgl kembali
      $date = Carbon::now();
      //max tgl Pengembalian = 14 hari / 2 minggu
      $max_date = $date->addDays(14);

      if ($borrow_limit->borrow_limit != 0) {
        if ($buku->status == 1) {
          $id_peminjaman = Peminjaman_Buku::create([
            'kode_buku' => $request->kode,
            'user_id' => $user,
            'buku_id' => $request->id,
            'max_kembali' => $max_date,
          ])->id;
          User::where('id','=',$user)->decrement('borrow_limit',1);

          $status = Buku::find($id);
          $status['status'] = 0;
          $status->save();
          //batas waktu pengambilan --nanti diganti
          $max_pengambilan = (New BatasPengambilan($id_peminjaman,$user,$id_buku))->delay((Carbon::now()->addMinutes(1)));

          $this->dispatch($max_pengambilan);
        } else {
          return redirect()->back()->with(['message' => 'Buku Sedang Dipinjam']);
        }
      }else {
        return redirect()->back()->with(['message' => 'Kuota Peminjaman Anda Telah Habis']);
      }
      return redirect('/user/borrow')->with(['message' => 'Silahkan Ambil Buku di Perpustakaan, Peminjaman Akan Otomatis Dibatalakan Setelah 60 Menit']);
    }

    public function Peminjaman_eBook(Request $request,$id)
    {
      $user = Auth::user()->id;
      $ebook = eBook::where('id','=',$request->id)->first();
      $borrow_limit = User::where('id','=',$user)->first();
      //max tgl kembali
      $date = Carbon::now();
      //max tgl Pengembalian = 14 hari / 2 minggu
      $max_date = $date->addDays(14);

      if ($borrow_limit->ebook_limit != 0) {
        if ($ebook->status == 1) {
          Peminjaman_eBook::create([
            'kode_ebook' => $request->kode,
            'user_id' => $user,
            'ebook_id' => $request->id,
            'max_kembali' => $max_date,
          ]);
          User::where('id','=',$user)->decrement('ebook_limit',1);

          $status = eBook::where('id','=',$request->id)->first();
          $status['status'] = 0;
          $status->save();
        } else {
          return redirect()->back()->with(['message' => 'Buku Sedang Dipinjam']);
        }
      }else {
        return redirect()->back()->with(['message' => 'Kuota Peminjaman Anda Telah Habis']);
      }
      return redirect()->back();
    }

    //view peminjaman Buku
    public function Borrow_Book()
    {
      $data['buku'] = Peminjaman_Buku::paginate(10);
      return view('admin.borrow_book',$data);
    }

    public function Pengembalian_eBook($id)
    {
      $data = Peminjaman_eBook::find($id);
      //id user
      $user = $data->user_id;
      //id buku
      $ebook_id = $data->ebook_id;
      //max tgl Pengembalian
      $max_tgl = $data->max_kembali;
      //count denda
      $denda = 0;
      $tgl_kembali = Carbon::now();
      $hasil = $tgl_kembali->diffInDays($max_tgl);
      // $tgl_kembali > $max_tgl (rumus)
      if ($tgl_kembali > $max_tgl) {
        $denda = $hasil * 2000;
      }
      //data
      $name = $data->user->name;
      $ebook = $data->ebook->name;
      $kode = $data->kode_ebook;
      $tgl = $data->tgl_pinjam;
      $data->delete();

      History_Peminjaman::create([
        'nama' => $name,
        'buku' => $ebook,
        'kode_buku' => $kode,
        'tgl_peminjaman' => $tgl,
        'denda' => $denda,
      ]);
        $limit = User::where('id','=',$user)->increment('ebook_limit',1);
        $user_denda = User::where('id','=',$user)->increment('denda',$denda);

        $status = eBook::where('id','=',$ebook_id)->first();
        $status['status'] = 1;
        $status->save();

        if ($denda == 0) {
          return redirect()->back()->with('message', 'Pengambalian eBook Tepat Waktu');
        } else {
          return redirect()->back()->with('message', "Pengembalian eBook Terlambat denda = Rp.{$denda}");
        }
    }

    public function Pengembalian_Buku($id)
    {
    $data = Peminjaman_Buku::find($id);
    //id user
    $user = $data->user_id;
    //id buku
    $buku = $data->buku_id;
    //max tgl Pengembalian
    $max_tgl = $data->max_kembali;
    //count denda
    $denda = 0;
    $tgl_kembali = Carbon::now();
    $hasil = $tgl_kembali->diffInDays($max_tgl);
    // $tgl_kembali > $max_tgl (rumus)
    if ($tgl_kembali > $max_tgl) {
      $denda = $hasil * 2000;
    }
    //data
    $name = $data->user->name;
    $book = $data->buku->name;
    $kode = $data->kode_buku;
    $tgl = $data->tgl_pinjam;
    $data->delete();

    History_Peminjaman::create([
      'nama' => $name,
      'buku' => $book,
      'kode_buku' => $kode,
      'tgl_peminjaman' => $tgl,
      'denda' => $denda,
    ]);
      $limit = User::where('id','=',$user)->increment('borrow_limit',1);
      $user_denda = User::where('id','=',$user)->increment('denda',$denda);

      $status = Buku::where('id','=',$buku)->first();
      $status['status'] = 1;
      $status->save();

      if ($denda == 0) {
        return redirect()->back()->with('message', 'Pengambalian Buku Tepat Waktu');
      } else {
        return redirect()->back()->with('message', "Pengembalian Buku Terlambat denda = Rp.{$denda}");
      }
    }

    public function Borrow_eBook()
    {
      $data['ebook'] = Peminjaman_eBook::paginate(10);
      return view('admin.borrow_ebook',$data);
    }

    //denda
    public function Index_Denda()
    {
      $data['denda'] = User::where('denda','!=',0)->paginate(10);
      return view('admin.show_denda',$data);
    }

    //view pembayaran denda
    public function Pembayaran_Denda($id)
    {
      $data['denda'] = User::find($id);
      return view('admin.pembayaran_denda',$data);
    }

    public function Penyimpanan_Denda(Request $request,$id)
    {
      $data = User::find($id);
      $denda_bayar = $request->bayar_denda;
      $denda = $data->denda;
      if ($denda >= $denda_bayar) {
        $sisa_denda = $denda - $denda_bayar;
        $data['denda'] = $sisa_denda;
        $data->save();
      } else {
        $sisa_denda = $denda_bayar - $denda;
        $data['denda'] = 0;
        $data->save();
        return redirect('/data/denda')->with('message',"Kembalian = Rp.{$sisa_denda}");
      }
      return redirect('/data/denda');
    }
}
