@extends('layouts.app')

@section('content')
  @if(count($book))
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
      <tbody>
        @foreach($book as $Key => $book)
        <tr>
          <td>{{ $Key+1 }}</td>
          <td>{{ $book->kode }}</td>
          <td>{{ $book->name }}</td>
          <td>{{ $book->penulis }}</td>
          <td>{{ $book->penerbit }}</td>
          <td>{{ str_limit($book->desc, $limit = 100, $end = '...') }}</td>
          <td>{{ $book->kategori->nama }}</td>
          <td>
            <form action="{{ route('delete.book',$book) }}" method="post">
              <a href="{{ route('same.book',$book) }}" class="btn btn-sm btn-success">+Jumlah Buku</a>
              <a href="{{ route('edit.book',$book) }}" class="btn btn-sm btn-warning">Edit Buku</a>
              @csrf
              @method('DELETE')
              <input type="hidden" name="img" value="{{ $book->img }}">
              <button type="submit" name="button" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">DELETE</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  @else
    <div class="container">
        <div class="alert alert-danger">Not Found !!!</div>
    </div>
  @endif
@stop
