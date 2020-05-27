@extends('layouts.app')
@section('content')
  <div class="container">

    <div class="row">

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h4>{{$buku}}</h4>
            <h5>Total Buku</h5>
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h4>{{$ebook}}</h4>
            <h5>Total eBook</h5>
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h4>{{$petugas}}</h4>
            <h5>Petugas</h5>
          </div>
        </div>
      </div>

    </div><br>

    <div class="row">

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h4>{{$user}}</h4>
            <h5>User</h5>
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h4>{{$month}}</h4>
            <h5>Peminjaman Bulan Ini</h5>
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <h4>Rp.{{$denda}}</h4>
            <h5>Total Denda Bulan Ini</h5>
          </div>
        </div>
      </div>

    </div>

  </div>
@stop
