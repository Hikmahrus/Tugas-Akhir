@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('bayar.denda',$denda) }}" method="post" enctype="multipart/form-data">
      @csrf

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="nama" class="form-control" value="{{ $denda->name }}" disabled>
        </div>

        <div class="form-group">
          <label>Denda</label>
          <input type="text" name="denda" class="form-control" value="{{ $denda->denda }}" disabled>
        </div>

        <div class="form-group">
          <label>Pembayaran</label>
          <input type="number" name="bayar_denda" class="form-control" min="0">
        </div>
      <button type="submit" class="btn btn-primary square" name="button">Save</button>

    </form><br>
  </div>
@stop
