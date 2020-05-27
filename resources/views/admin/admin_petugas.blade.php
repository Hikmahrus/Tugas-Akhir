@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('add.petugas') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label>Nama Petugas</label>
        <input type="text" name="name" class="form-control">
      </div>

      <div class="form-group">
        <label>Email Petugas</label>
        <input type="email" name="email" class="form-control">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="pass" class="form-control">
      </div>

      <div class="form-group">
        <label>No Telp Petugas</label>
        <input type="number" name="notelp" class="form-control">
      </div>

      <div class="form-group">
        <label>NIP</label>
        <input type="number" name="nip" class="form-control">
      </div>

      <div class="form-group">
        <label>Alamat Petugas</label>
        <input type="text" name="alamat" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary" name="button">Submit</button>

    </form><br>

    <div class="table-responsive">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>No Telp</th>
          <th>NIP</th>
          <th>Alamat</th>
          <th>Action</th>
        </tr>
      </thead>
        @foreach($petugas as $Key => $data)
      <tbody>
        <tr>
          <td>{{ $Key+1 }}</td>
          <td>{{ $data->name }}</td>
          <td>{{ $data->notelp }}</td>
          <td>{{ $data->nip }}</td>
          <td>{{ $data->alamat }}</td>
          <td>
            <form action="{{ route('delete.petugas',$data) }}" method="post">
              <a href="{{ route('edit.petugas',$data) }}" class="btn btn-sm btn-warning">Edit</a>
              @csrf
              @method('DELETE')
              <button type="submit" name="button" class="btn btn-sm btn-danger">DELETE</button>
            </form>
          </td>
        </tr>
      </tbody>
      @endforeach
  </div>
</div>
@endsection
