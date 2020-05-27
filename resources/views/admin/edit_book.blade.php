@extends('layouts.app')

@section('content')
  <div class="container">

    <form action="{{ route('update.book',$data) }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>Nama Buku</label>
            <input type="text" name="name" class="form-control square" value="{{ $data->name}}">
            <strong class="text-danger">{{ $errors->first('name') }}</strong>
          </div>

          <div class="form-group">
            <label>Kode Buku</label>
            <input type="text" name="kode" class="form-control square" value="{{ $data->kode}}">
            <strong class="text-danger">{{ $errors->first('kode') }}</strong>
          </div>

          <div class="form-group">
            <label>Penulis Buku</label>
            <input type="text" name="penulis" class="form-control square" value="{{ $data->penulis}}">
            <strong class="text-danger">{{ $errors->first('penulis') }}</strong>
          </div>

          <div class="form-group">
            <label>Penerbit Buku</label>
            <input type="text" name="penerbit" class="form-control square" value="{{ $data->penerbit}}">
            <strong class="text-danger">{{ $errors->first('penerbit') }}</strong>
          </div>

          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" min="1901" max="2019" name="thn_terbit" class="form-control square" value="{{ $data->thn_terbit}}">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <div class="row">
              <div class="col">
                <label>Kategori</label>
              </div>
            </div>
            <div class="row no-gutters">
              <div class="col-10">
                <select class="form-control square" name="kategori_id">
                  <option value="{{ $data->kategori_id }}">{{ $data->kategori->nama }}</option>
                  <option disabled>──────────</option>
                  @foreach( $kategori as $kat )
                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-2">
                <a href="{{ route('view.kategori') }}" class="btn btn-outline-info square">+Kategori</a>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label>Desc</label>
            <textarea name="desc" rows="8" cols="80" class="form-control square">{{ $data->desc }}</textarea>
            <strong class="text-danger">{{ $errors->first('desc') }}</strong>
          </div>

          <div class=" form-group row no-gutters">
            <div class="col-2">
              <img src="{{ asset('img/'.$data->img) }}" style="width:80px;height:80px;">
              <input type="hidden" name="oldImg" value="{{ $data->img }}">
            </div>

            <div class="col-4">
              <label>Gambar Buku</label><br>
              <input type="file" name="newImg">
              <strong class="text-danger">{{ $errors->first('newImg') }}</strong>
            </div>
          </div>

        </div>
      </div>
      <button type="submit" class="btn btn-primary square" name="button">Save</button>

    </form>

  </div>
@stop
