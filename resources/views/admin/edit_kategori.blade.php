@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('update.kategori',$data) }}" method="post">
      @csrf

      <div class="form-group">
        <label>Kategori</label>
        <input type="text" name="nama" class="form-control" value="{{ $data->nama }}">
      </div>

      <button type="submit" class="btn btn-primary" name="button">Save</button>
</div>
@endsection
