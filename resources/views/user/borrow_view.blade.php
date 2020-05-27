@extends('layouts.app')

@section('content')
  <div class="container">
    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div class="card">
      <div class="card-body">
        <div class="row">
          <img class="col-4 image_thumbnail h-50" src="{{ asset('img/'.$data->img) }}" alt="....">
          <div class="col-6">
            <h4 class="card-title font-weight-bold">{{ $data->name }}</h4>
            <p>oleh <b>{{ $data->penulis }}</b></p>
            <p>di terbitkan oleh <b>{{ $data->penerbit }}</b></p>
            <p>Kategori : <b>{{ $data->kategori->nama }}</b></p>
            <p>{{ $data->desc }}</p>
              <div class="row">
                <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th>#</th>
                      <th>Kode</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  @foreach($book as $Key => $book)
                  <tbody>
                    <tr>
                      <td>{{ $Key+1 }}</td>
                      <td>{{ $book->kode }}</td>
                      <td>
                        @if($book->status == 1)
                        <form action="{{ route('borrow.book',$book) }}" method="post">
                          @csrf
                          <input type="hidden" name="kode" value="{{ $book->kode }}">
                          <button type="submit" onclick="return confirm('Are you sure?')" value="{{ $book->id }}" class="btn btn-sm btn-success square">Pinjam</button>
                        </form>
                        @else
                          <button class="btn btn-sm btn-success square" disabled>Dipinjam</button>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
              </div>
              </div>
          </div>
        </div><br>

      </div>
    </div>
  </div>
@stop
