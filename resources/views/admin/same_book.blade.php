@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('book.save',$same) }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label>Kode Buku</label>
        <input type="text" name="kode" class="form-control">
      </div>
      <div class="form-group">
        <label>Gambar Buku</label><br>
        <input type="file" name="same_img"><br>
      </div>

      <button type="submit" class="btn btn-primary" name="button">Submit</button>

    </form>
  </div>
@stop
