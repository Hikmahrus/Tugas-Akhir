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
      <th>Kode eBook</th>
      <th>Nama eBook</th>
      <th>Tgl Pinjam</th>
      <th>Max Pengembalian</th>
      <th>Action</th>
    </tr>
  </thead>


  <tbody>
    @foreach($ebook as $Key => $data)
    <tr>
      <td>{{ $Key+1 }}</td>
      <td>{{ $data->user->name }}</td>
      <td>{{ $data->kode_ebook }}</td>
      <td>{{ $data->ebook->name }}</td>
      <td>{{ $data->tgl_pinjam }}</td>
      <td>{{ $data->max_kembali }}</td>
      <td>
        <form action="" method="post">
          @csrf
          <input type="hidden" name="id_buku" value="{{ $data->ebook_id }}">
          <button type="submit" class="btn btn-sm btn-info square" name="button">Kembali</button>
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
