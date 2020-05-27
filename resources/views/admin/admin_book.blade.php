@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('add.book') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row">

        <div class="col">

          <div class="form-group">
            <label>Nama Buku</label>
            <input type="text" name="name" class="form-control square" value="{{Request::old('name')}}">
            <strong class="text-danger">{{ $errors->first('name') }}</strong>
          </div>

          <div class="form-group">
            <label>Kode Buku</label>
            <input type="text" name="kode" class="form-control square" value="{{Request::old('kode')}}">
            <strong class="text-danger">{{ $errors->first('kode') }}</strong>
          </div>

          <div class="form-group">
            <label>Penulis Buku</label>
            <input type="text" name="penulis" class="form-control square" value="{{Request::old('penulis')}}">
            <strong class="text-danger">{{ $errors->first('penulis') }}</strong>
          </div>

          <div class="form-group">
            <label>Penerbit Buku</label>
            <input type="text" name="penerbit" class="form-control square" value="{{Request::old('penerbit')}}">
            <strong class="text-danger">{{ $errors->first('penerbit') }}</strong>
          </div>

          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" min="1901" max="2019" name="thn_terbit" class="form-control square" value="{{Request::old('thn_terbit')}}">
            <strong class="text-danger">{{ $errors->first('thn_terbit') }}</strong>
          </div>

        </div>

        <div class="col">
          <div class="form-group">
            <div class="row">
              <div class="col">
                <label>Kategori Buku</label>
              </div>
            </div>
            <div class="row no-gutters">
              <div class="col-md-10">
                <select class="form-control square" name="kategori_id" data-live-search="true">
                  @foreach($kategori as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-2">
                <a href="{{ route('view.kategori') }}" class="btn btn-outline-info square">+Kategori</a>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Desc</label>
            <textarea name="desc" rows="8" cols="80" class="form-control square">{{Request::old('desc')}}</textarea>
            <strong class="text-danger">{{ $errors->first('desc') }}</strong>
          </div>

          <div class="form-group">
            <label>Gambar Buku</label><br>
            <input type="file" name="img"><br>
            <strong class="text-danger">{{ $errors->first('img') }}</strong>
          </div>
        </div>

      </div>
      <button type="submit" class="btn btn-primary square" name="button">Submit</button>

    </form><br>

    <form class="form-inline float-right" action="{{ Route('cari.buku') }}" method="post">
      @csrf
      <input type="text" class="form-control square" name="search" placeholder="Search Here">
      <button type="submit" class="btn square btn-outline-info" name="button">Search</button>
    </form>

{{ $books->links() }}
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
          @foreach($books as $Key => $book)
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

</div>


@endsection
