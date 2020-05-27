@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="table-responsive">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Buku</th>
          <th>Kode Buku</th>
          <th>Tanggal Peminjaman</th>
          <th>Tanggal Pengembalian</th>
          <th>Denda</th>
        </tr>
      </thead>
      <tbody>
        @foreach($history as $Key => $data)
        <tr>
          <td>{{ $Key+1 }}</td>
          <td>{{ $data->nama }}</td>
          <td>{{ $data->buku }}</td>
          <td>{{ $data->kode_buku }}</td>
          <td>{{ $data->tgl_peminjaman }}</td>
          <td>{{ $data->tgl_pengembalian }}</td>
          <td>Rp.{{ $data->denda }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>
@stop
