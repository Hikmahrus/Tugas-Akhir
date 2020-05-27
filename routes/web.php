<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('user.book');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//User View
Route::get('/', 'MasterController@Index_Home');
Route::get('/details/book/{id}', 'ProsesController@Detail_Book')->name('detail.book');
Route::get('/details/ebook/{id}', 'ProsesController@Detail_eBook')->name('detail.ebook');
Route::get('/horor/all','ProsesController@Buku_Horor')->name('all.horor');
Route::get('/novel/all','ProsesController@Buku_Novel')->name('all.novel');
Route::get('/comedy/all','ProsesController@Buku_Comedy')->name('all.comedy');
Route::post('/search', 'ProsesController@Search')->name('cari');
Route::get('/bukti/{id}', 'ProsesController@Bukti_Peminjaman')->name('bukti');
Route::get('/view/bukti/{id}', 'ProsesController@View_Bukti')->name('view.bukti');

//Login Needed
Route::group(['middleware' => ['auth']],function(){
  Route::post('/borrow/book/{id}', 'ProsesController@Peminjaman_Book')->name('borrow.book');
  Route::get('/buku/ambil/{id}', 'ProsesController@Cancel')->name('cancel.book');
  Route::post('/borrow/ebook/{id}', 'ProsesController@Peminjaman_eBook')->name('borrow.ebook');
  Route::any('/read/{id}', 'ProsesController@Read_pdf')->name('read.pdf');
  Route::get('/user/borrow', 'ProsesController@User_Borrow')->name('user.borrow');
  Route::any('/user/return/ebook/{id}', 'ProsesController@Pengembalian_eBook')->name('return.ebook');
});

//Admin dan Petugas View Borrow Status (peminjaman)
Route::group(['middleware' => ['can:both']],function(){
  Route::get('/data/borrow/book', 'ProsesController@Borrow_Book')->name('borrow.status.book');
  Route::any('/data/return/book/{id}','ProsesController@Pengembalian_Buku')->name('return.book');
  Route::get('/data/borrow/ebook', 'ProsesController@Borrow_eBook')->name('borrow.status.ebook');
});

//Admin dan Petugas denda
Route::group(['middleware' => ['can:both']],function(){
  Route::get('/data/denda','ProsesController@Index_Denda')->name('denda');
  Route::get('/data/denda/{id}','ProsesController@Pembayaran_Denda')->name('denda.user');
  Route::post('/denda/bayar/{id}','ProsesController@Penyimpanan_Denda')->name('bayar.denda');
});

//Admin dan Petugas View Index & Kategori
Route::group(['middleware' => ['can:both']],function(){
  Route::get('/data/master/kategori','MasterController@Index_Kategori')->name('view.kategori');
  Route::post('/data/store/kategori','MasterController@Store_Kategori')->name('add.kategori');
  Route::delete('/data/delete/kategori/{id}','MasterController@Delete_Kategori')->name('delete.kategori');
  Route::get('/data/edit/kategori/{id}','MasterController@Edit_Kategori')->name('edit.kategori');
  Route::post('/data/update/kategori/{id}','MasterController@Update_Kategori')->name('update.kategori');
});

//Admin dan Petugas view index & book
Route::group(['middleware' => ['can:both']],function(){
  Route::get('/history', 'MasterController@History_Peminjaman')->name('history');
  Route::post('/search/book', 'ProsesController@Search_Book')->name('cari.buku');
  Route::get('/data/master/book', 'MasterController@Index_Book')->name('view.book');
  Route::post('/data/store/book', 'MasterController@Store_Book')->name('add.book');
  Route::delete('/data/delete/book/{id}', 'MasterController@Delete_Book')->name('delete.book');
  Route::get('/data/edit/book/{id}', 'MasterController@Edit_View')->name('edit.book');
  Route::post('/data/update/book/{id}', 'MasterController@Update_Book')->name('update.book');
  Route::get('/data/duplicate/{id}','MasterController@Same_Book')->name('same.book');
  Route::any('/data/save/duplicate/{id}','MasterController@Same_Save')->name('book.save');
});

//Admin dan Petugas view index & ebook
Route::group(['middleware' => ['can:both']],function(){
  Route::post('/search/ebook', 'ProsesController@Search_eBook')->name('cari.ebook');
  Route::get('/data/master/ebook', 'MasterController@Index_eBook')->name('view.ebook');
  Route::post('/data/store/ebook', 'MasterController@Store_eBook')->name('add.ebook');
  Route::delete('/data/delete/ebook/{id}', 'MasterController@Delete_eBook')->name('delete.ebook');
  Route::get('/data/edit/ebook/{id}', 'MasterController@Edit_eBook')->name('edit.ebook');
  Route::post('/data/update/ebook/{id}', 'MasterController@Update_eBook')->name('update.ebook');
});

//Admin Only index & crud petugas
Route::group(['middleware' => ['can:adminOnly']],function(){
  Route::get('/admin', 'MasterController@Admin_Dashboard');
  Route::get('/admin/petugas','PetugasController@Index_Petugas')->name('view.petugas');;
  Route::post('/admin/petugas/store', 'PetugasController@Store_Petugas')->name('add.petugas');
  Route::get('/admin/edit/{id}', 'PetugasController@Edit_Petugas')->name('edit.petugas');
  Route::post('/admin/update/{id}', 'PetugasController@Update_Petugas')->name('update.petugas');
  Route::delete('/admin/petugas/delete/{id}', 'PetugasController@Delete_Petugas')->name('delete.petugas');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
