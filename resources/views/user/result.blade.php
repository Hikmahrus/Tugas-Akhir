@extends('layouts.app')
@section('content')
<div class="container">
@if(count($book))
    <h4 class="font-weight-bold">Buku</h4>
    <div class="row">
      @foreach($book as $book)
      <div class="col-md-auto">
        <div class="card mb-3" style="width: 11rem;">
              <a href="{{ route('detail.book',$book) }}" style="color:black;text-decoration: none;">
                <img src="{{ asset('img/'.$book->img) }}" class="card-img-top" alt="...">
              </a>
              <div class="card-body">
                <center>
                  <h6 class="card-title">{{ $book->name }}</h6>
                  <a href="{{ route('detail.book',$book) }}" class="btn btn-info square">Details</a>
                </center>
              </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="container">
      <h4 class="font-weight-bold">Buku</h4>
      <div class="row">
        <div class="alert alert-danger">Not Found !!!</div>
      </div>
    </div>
    @endif
    @if(count($ebook))
    <h4 class="font-weight-bold">eBook</h4>
    <div class="row">
      @foreach($ebook as $ebook)
      <div class="col-md-auto">
        <div class="card mb-3" style="width: 11rem;">
              <a href="{{ route('detail.ebook',$book) }}" style="color:black;text-decoration: none;">
                <img src="{{ asset('img/'.$ebook->img) }}" class="card-img-top" alt="...">
              </a>
              <div class="card-body">
                <center>
                  <h6 class="card-title">{{ $ebook->name }}</h6>
                  <a href="{{ route('detail.ebook',$ebook) }}" class="btn btn-info square">Details</a>
                </center>
              </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="container">
      <h4 class="font-weight-bold">eBook</h4>
      <div class="row">
        <div class="alert alert-danger">Not Found !!!</div>
      </div>
    </div>
    @endif
  </div>
@stop
