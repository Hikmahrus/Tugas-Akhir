<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function Index_Petugas()
    {
      $data['petugas'] = User::where('role','=','1')->get();
      return view('admin.admin_petugas',$data);
    }

    public function Store_Petugas(Request $request)
    {

      $this->validate($request,[
        'name' => 'required',
        'notelp' => 'required',
        'nip' => 'required',
        'alamat' => 'required',
        'email' => 'required',
        'pass' => 'required',
      ]);
      $pass = Hash::make($request->pass);
      $data = $request->all();
      $data['role'] = 1;
      $data['password'] = $pass;
      User::create($data);
      return redirect()->back();
    }

    public function Edit_Petugas($id)
    {
      $petugas['data'] = User::find($id);
      return view('admin.edit_petugas', $petugas);
    }

    public function Update_Petugas(Request $request, $id)
    {
      $this->validate($request,[
        'nama' => 'required',
        'noTelp' => 'required',
        'NIP' => 'required',
        'alamat' => 'required',
      ]);
      $data = $request->all();
      $petugas = User::find($id);
      $petugas->fill($data);
      $petugas->save();
      return redirect('/admin/petugas');
    }

    public function Delete_Petugas($id)
    {
      $data = User::find($id);
      $data->delete();
      return redirect()->back();
    }
}
