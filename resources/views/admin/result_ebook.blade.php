@extends('layouts.app')
@section('content')

  @if(count($ebook))
      <div class="table-responsive">
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Desc</th>
            <th>Kategori</th>
            <th>Action</th>
          </tr>
        </thead>
          @foreach($ebook as $Key => $ebook)
        <tbody>
          <tr>
            <td>{{ $Key+1 }}</td>
            <td>{{ $ebook->kode }}</td>
            <td>{{ $ebook->name }}</td>
            <td>{{ $ebook->penulis }}</td>
            <td>{{ $ebook->penerbit }}</td>
            <td>{{ $ebook->desc }}</td>
            <td>{{ $ebook->kategori->nama }}</td>
            <td>
              <form action="{{ route('delete.ebook',$ebook) }}" method="post">
                <a href="{{ route('edit.ebook',$ebook) }}" class="btn btn-sm btn-warning">Edit</a>
                @csrf
                @method('DELETE')
                <input type="hidden" name="img" value="{{ $ebook->img }}">
                <input type="hidden" name="pdf" value="{{ $ebook->pdf }}">
                <button type="submit" name="button" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">DELETE</button>
              </form>
            </td>
          </tr>
        </tbody>
        @endforeach
    </div>
  @else
  <div class="container">
      <div class="alert alert-danger">Not Found !!!</div>
  </div>
  @endif

@stop
