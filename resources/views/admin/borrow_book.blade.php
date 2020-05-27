@extends('layouts.app')

@section('content')

@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

<div class="table-responsive">
<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th>#</th>
      <th>Peminjam</th>
      <th>Kode Buku</th>
      <th>Nama Buku</th>
      <th>Tgl Pinjam</th>
      <th>Max Pengembalian</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    @foreach($buku as $Key => $data)
    <tr>
      <td>{{ $Key+1 }}</td>
      <td>{{ $data->user->name }}</td>
      <td>{{ $data->kode_buku }}</td>
      <td>{{ $data->buku->name }}</td>
      <td>{{ $data->tgl_pinjam }}</td>
      <td>{{ $data->max_kembali }}</td>
      <td>
        @if($data->status == 0)
          <p class="badge badge-warning text-wrap" style="width: 6rem;">Belum Diambil</p>
        @else
        <p class="badge badge-success text-wrap" style="width: 6rem;">Dipinjam</p>
        @endif
      </td>
      <td>
        <form action="{{ route('return.book',$data) }}" method="post">
          @if($data->status == 0)
          <a href="{{ route('cancel.book',$data) }}" class="btn btn-sm btn-success square">Ambil</a>
          @else
          @csrf
          <input type="hidden" name="id_buku" value="{{ $data->buku_id }}">
          <button type="submit" class="btn btn-sm btn-info square" name="button">Kembali</button>
          @endif
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</div>
@stop

<script type="text/javascript">
setTimeout(function() {
  location.reload();
}, 30000);
</script>
