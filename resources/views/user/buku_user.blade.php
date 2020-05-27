@extends('layouts.app')
@section('content')
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
  <div class="row">
    <h4 class="font-weight-bold">Buku di Pinjam</h4>
    <div class="table-responsive">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Nama Buku</th>
          <th>Tgl Peminjaman</th>
          <th>Max Tgl Pengembalian</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($buku as $Key => $book)
        <tr>
          <td>{{ $Key+1 }}</td>
          <td>{{ $book->buku->name }}</td>
          <td>{{ $book->tgl_pinjam }}</td>
          <td>{{ $book->max_kembali }}</td>
          <td>
            @if( $book->status == 0 )
                <p class="badge badge-warning text-wrap" style="width: 6rem;">Belum Diambil</p>
            @else
              <p class="badge badge-success text-wrap" style="width: 6rem;">Dipinjam</p>
            @endif
          </td>
          <td><a href="{{ Route('view.bukti',$book) }}" class="btn btn-sm btn-info">Lihat Bukti</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
@stop

<script type="text/javascript">
setTimeout(function() {
  location.reload();
}, 30000);
</script>
