@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('add.ebook') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col">
                <div class="form-group">
                  <label>Nama eBook</label>
                  <input type="text" name="name" class="form-control square" value="{{Request::old('name')}}">
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                </div>

                <div class="form-group">
                  <label>Kode eBook</label>
                  <input type="text" name="kode" class="form-control square" value="{{Request::old('kode')}}">
                  <strong class="text-danger">{{ $errors->first('kode') }}</strong>
                </div>

                <div class="form-group">
                  <label>Penulis eBook</label>
                  <input type="text" name="penulis" class="form-control square" value="{{Request::old('penulis')}}">
                  <strong class="text-danger">{{ $errors->first('penulis') }}</strong>
                </div>

                <div class="form-group">
                  <label>Penerbit eBook</label>
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

                <div class="from-group">
                  <div class="row">
                    <div class="col">
                      <label>Kategori Buku</label>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col">
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
                </div><br>

                <div class="form-group">
                  <label>Desc</label>
                  <textarea name="desc" rows="8" cols="80" class="form-control square">{{Request::old('desc')}}</textarea>
                  <strong class="text-danger">{{ $errors->first('desc') }}</strong>
                </div>

                  <div class="from-group row">
                    <div class="col-5">
                      <div class="form-group">
                        <label>Gambar eBook</label><br>
                        <input type="file" name="img">
                        <strong class="text-danger">{{ $errors->first('img') }}</strong>
                      </div>
                    </div>
                    <div class="col-5">
                      <div class="form-group">
                        <label>File eBook</label><br>
                        <input type="file" name="pdf">
                        <strong class="text-danger">{{ $errors->first('pdf') }}</strong>
                      </div>
                    </div>
                  </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary square" name="button">Submit</button>

    </form><br>

    <form class="form-inline float-right" action="{{ Route('cari.ebook') }}" method="post">
      @csrf
      <input type="text" class="form-control square" name="search" placeholder="Search Here">
      <button type="submit" class="btn square btn-outline-info" name="button">Search</button>
    </form>

    {{ $ebooks->links() }}

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
        @foreach($ebooks as $Key => $ebook)
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
</div>

@endsection
