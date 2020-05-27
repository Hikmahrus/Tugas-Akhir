@extends('layouts.app')

@section('content')
  <div class="container">

    <form action="{{ route('update.ebook',$data) }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>Nama eBook</label>
            <input type="text" name="name" class="form-control square" value="{{ $data->name}}">
          </div>

          <div class="form-group">
            <label>Kode eBook</label>
            <input type="text" name="kode" class="form-control square" value="{{ $data->kode }}">
          </div>

          <div class="form-group">
            <label>Penulis eBook</label>
            <input type="text" name="penulis" class="form-control square" value="{{ $data->penulis}}">
          </div>

          <div class="form-group">
            <label>Penerbit eBook</label>
            <input type="text" name="penerbit" class="form-control square" value="{{ $data->penerbit}}">
          </div>

          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" min="1901" max="2019" name="thn_terbit" class="form-control square" value="{{ $data->thn_terbit }}">
          </div>

          <div class="row">
            <div class="col">
              <label>Kategori</label>
            </div>
          </div>
          <div class="row no-gutters">
            <div class="col">
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
        <div class="col">

          <div class="form-group">
            <label>Desc</label>
            <textarea name="desc" rows="8" cols="80" class="form-control square">{{ $data->desc }}</textarea>
          </div>

          <div class="row no-gutters">
            <div class="col-2">
              <img src="{{ asset('img/'.$data->img) }}" class="img-thumbnail" style="width:80px;height:80px;">
              <input type="hidden" name="oldImg" value="{{ $data->img }}">
            </div>

            <div class="col-4">
              <div class="form-group">
                <label>Gambar eBook</label><br>
                <input type="file" name="newImg">
              </div>
            </div>
          </div><br>

              <div class="form-group">
                <label>File eBook</label><br>
                <input type="file" name="newPdf">
              </div>
              <input type="hidden" name="oldPdf" value="{{ $data->pdf }}">



        </div>

      </div><br>
      <button type="submit" class="btn btn-primary square" name="button">Save</button>

    </form>

  </div>
@stop
