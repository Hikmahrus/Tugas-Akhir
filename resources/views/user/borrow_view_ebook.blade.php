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
            <h4 class="card-title font-weight-bold"></h4>
            <p>oleh <b>{{ $data->penulis }}</b></p>
            <p>di terbitkan oleh <b>{{ $data->penerbit }}</b></p>
            <p>Kategori : <b>{{ $data->kategori->nama }}</b></p>
            <p>{{ $data->desc }}</p>
          </div>
        </div><br>

      </div>
    </div>
  </div>
@stop
