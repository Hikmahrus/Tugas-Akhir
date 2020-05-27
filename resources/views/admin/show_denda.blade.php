@extends('layouts.app')

@section('content')
<div class="container">
  @if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
  @endif
  <div class="table-responsive">
  <table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Denda</th>
        <th>Action</th>
      </tr>
    </thead>
@foreach($denda as $Key => $data)
    <tbody>
      <tr>
        <td>{{ $Key+1 }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->denda }}</td>
        <td>
          <a href="{{ route('denda.user',$data) }}" class="btn btn-sm btn-info">Bayar</a>
        </td>
      </tr>
    </tbody>
    @endforeach
</div>
</div>
{{ $denda->links() }}
@stop
