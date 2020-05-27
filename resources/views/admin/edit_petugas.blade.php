@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('update.petugas',$data) }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label>Nama Petugas</label>
        <input type="text" name="nama" class="form-control" value="{{ $data->nama }}">
      </div>

      <div class="form-group">
        <label>No Telp Petugas</label>
        <input type="number" name="noTelp" class="form-control" value="{{ $data->noTelp }}">
      </div>

      <div class="form-group">
        <label>NIP</label>
        <input type="number" name="NIP" class="form-control" value="{{ $data->NIP }}">
      </div>

      <div class="form-group">
        <label>Alamat Petugas</label>
        <input type="text" name="alamat" class="form-control" value="{{ $data->alamat }}">
      </div>

      <button type="submit" class="btn btn-primary" name="button">Save</button>

    </form><br>
  </div>
@endsection
