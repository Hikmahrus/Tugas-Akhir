<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;
use App\User;
use App\eBook;
use App\Kategori;
use App\History_Peminjaman;
use File;
use Image;
use DB;
use Carbon\Carbon;

class MasterController extends Controller
{
    public function History_Peminjaman()
    {
      $history = History_Peminjaman::all();
      return view('admin.history_peminjaman',compact('history'));
    }

    public function Admin_Dashboard()
    {
      //get current time
      $now = Carbon::now();
      //get current month from current time
      $now_month = Carbon::createFromFormat('Y-m-d H:i:s',$now)->month;
      $buku = Buku::all()->count();
      $ebook = eBook::all()->count();
      $petugas = User::where('role','=',1)->get()->count();
      $user = User::where('role','=',0)->count();
      $month = History_Peminjaman::whereMonth('tgl_pengembalian','=',$now_month)->count();
      $denda = History_Peminjaman::select('denda')->whereMonth('tgl_pengembalian','=',$now_month)->sum('denda');
      return view('admin.dashboard',compact('buku','ebook','petugas','month','denda','user'));
    }
  //first page & index user (book and ebook)
    public function Index_Home()
    {
      $ebook = eBook::all();
      $random = Buku::inRandomOrder()->groupBy('name')->get()->take(5);
      $horor = Buku::where('kategori_id','=',1)->groupBy('name')->get()->take(5);
      $novel = Buku::where('kategori_id','=',4)->groupBy('name')->get()->take(5);
      return view('user.book',compact('ebook','random','horor','novel'));
    }

  //-------------Create & Index kategori (admin/petugas)------------------------
    public function Index_Kategori()
    {
      $data['kategori'] = Kategori::paginate(10);
      return view('admin.admin_kategori',$data);
    }

    public function Store_Kategori(Request $request)
    {
      $this->validate($request,[
        'nama' => 'required',
      ]);

      Kategori::create($request->all());
      return redirect()->back();
    }

    public function Edit_Kategori($id)
    {
      $kat['data'] = Kategori::find($id);
      return view('admin.edit_kategori', $kat);
    }

    public function Update_Kategori(Request $request,$id)
    {
      $this->validate($request,[
        'nama' => 'required',
      ]);
      $buku = Kategori::find($id);
      $buku->fill($request->all());
      $buku->save();
      return redirect('/data/master/kategori');
    }

    public function Delete_Kategori($id)
    {
      $data = Kategori::find($id);
      $data->delete();
      return redirect()->back();
    }

  //--------------------Create & Index book (admin/petugas)---------------------
    public function Index_Book()
    {
      $books = Buku::paginate(10);
      $kategori = Kategori::all();
      return view('admin.admin_book',compact('books','kategori'));
    }

    public function Store_Book(Request $request)
    {
      $this->validate($request,[
        'name' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'desc' => 'required',
        'img' =>'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        'kode' => 'required',
        'thn_terbit' => 'required',
        'kategori_id' => '',
      ]);

      $image = $request->file('img');
      $imageName = time().'.'.$image->getClientOriginalExtension();

      $image->move(public_path('img'), $imageName);

      $data = $request -> all();
      $data['img'] = $imageName;
      $data['status'] = 1;

      Buku::create($data);

      return redirect()->back();
    }

    public function Same_Book(Request $request,$id)
    {
      $same = Buku::find($id);
      return view('admin.same_book',compact('same'));
    }

    public function Same_Save(Request $request,$id)
    {
      $data = Buku::find($id);
      $name = $data->name;
      $penulis = $data->penulis;
      $penerbit = $data->penerbit;
      $thn_terbit = $data->thn_terbit;
      $kategori = $data->kategori_id;
      $desc = $data->desc;

      $image = $request->file('same_img');
      $imageName = time().'.'.$image->getClientOriginalExtension();

      $image->move(public_path('img'), $imageName);

      Buku::create([
        'kode' => $request->kode,
        'name' => $name,
        'img' => $imageName,
        'penulis' => $penulis,
        'penerbit' => $penerbit,
        'thn_terbit' => $thn_terbit,
        'kategori_id' => $kategori,
        'desc' => $desc,
      ]);

      return redirect('/data/master/book');
    }

    public function Edit_View($id)
    {
      $kategori = Kategori::all();
      $data = Buku::find($id);
      return view('admin.edit_book', compact('data','kategori'));
    }

    public function Update_Book(Request $request, $id)
    {
      $this->validate($request,[
        'name' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'desc' => 'required',
        'kode' => 'required',
        'thn_terbit' => 'required',
        'newImg' =>'image|mimes:jpeg,png,jpg,svg|max:2048',
        'img' => '',
        'kategori_id' => '',
      ]);

      if ($request->hasFile('newImg')) {
        //hapus gambar lama
        $img_location = "img/".$request->oldImg;
        if (File::exists($img_location)) {
          File::delete(public_path($img_location));
        }

        //ambil data gambar baru
        $imageName = time().'.'.request()->newImg->getClientOriginalExtension();
        request()->newImg->move(public_path('img'), $imageName);

        //store data
        $data = $request->all();
        $data['img'] = $imageName;
        $buku = Buku::find($id);
        $buku->fill($data);
        $buku->save();
        return redirect('/data/master/book');

      }

      $data = $request->all();
      $buku = Buku::find($id);
      $buku->fill($data);
      $buku->save();
      return redirect('/data/master/book');
    }

    public function Delete_Book($id, Request $request)
    {
      $img_location = "img/".$request->img;
      if (File::exists($img_location)) {
        File::delete(public_path($img_location));
      }

      $data = Buku::find($id);
      $data->delete();
      return redirect()->back();
    }

  //-----------------Create & Index ebook (admin/petugas)-----------------------
  public function Index_eBook()
  {
    $ebooks = eBook::paginate(10);
    $kategori = Kategori::all();
    return view('admin.admin_ebook',compact('ebooks','kategori'));
  }
  public function Store_eBook(Request $request)
  {
    $this->validate($request,[
      'name' => 'required',
      'kode' => 'required',
      'penulis' => 'required',
      'penerbit' => 'required',
      'desc' => 'required',
      'thn_terbit' => 'required',
      'img' =>'required|image|mimes:jpeg,png,jpg,svg|max:2048',
      'pdf' => 'required|mimes:pdf|max:5000',

    ]);
    ///upload pdf
    $ebook = time().'.'.request()->pdf->getClientOriginalExtension();
    request()->pdf->move(public_path('pdf'), $ebook);

    //uploda img
    $imageName = time().'.'.request()->img->getClientOriginalExtension();
    request()->img->move(public_path('img'), $imageName);

    $data = $request -> all();
    $data['img'] = $imageName;
    $data['pdf'] = $ebook;


    eBook::create($data);
    return redirect()->back();
  }

  public function Edit_eBook($id)
  {
    $data = eBook::find($id);
    $kategori = Kategori::all();
    return view('admin.edit_ebook', compact('data','kategori'));

  }

  public function Update_eBook(Request $request,$id)
  {
    $this->validate($request,[
      'name' => 'required',
      'penulis' => 'required',
      'penerbit' => 'required',
      'desc' => 'required',
      'newImg' =>'',
      'img' => '',
      'newPdf' => '',
    ]);

    if ($request->hasFile('newPdf')) {
      //hapus pdf lama
      $pdf_location = "pdf/".$request->oldPdf;
      if (File::exists($pdf_location)) {
        File::delete(public_path($pdf_location));
      }

      //ambil data pdf baru
      $pdfName = time().'.'.request()->newPdf->getClientOriginalExtension();
      request()->newPdf->move(public_path('pdf'), $pdfName);

      //store data
      $data = $request->all();
      $data['pdf'] = $pdfName;

      if ($request->hasFile('newImg')) {
        //hapus gambar lama
        $img_location = "img/".$request->oldImg;
        if (File::exists($img_location)) {
          File::delete(public_path($img_location));
        }

        //ambil data gambar baru
        $imageName = time().'.'.request()->newImg->getClientOriginalExtension();
        request()->newImg->move(public_path('img'), $imageName);

        //store data
        $data = $request->all();
        $data['img'] = $imageName;
        $data['pdf'] = $pdfName;
        $ebook = eBook::find($id);
        $ebook->fill($data);
        $ebook->save();
        return redirect('/data/master/ebook');

      }

      $ebook = eBook::find($id);
      $ebook->fill($data);
      $ebook->save();
      return redirect('/data/master/ebook');

    }

    $data = $request->all();
    $ebook = eBook::find($id);
    $ebook->fill($data);
    $ebook->save();
    return redirect('/data/master/ebook');
  }

  public function Delete_eBook(Request $request,$id)
  {
    $img_location = "img/".$request->img;
    if (File::exists($img_location)) {
      File::delete(public_path($img_location));
    }

    $pdf_location = "pdf/".$request->pdf;
    if (File::exists($pdf_location)) {
      File::delete(public_path($pdf_location));
    }

    $data = eBook::find($id);
    $data->delete();
    return redirect()->back();
  }

}
