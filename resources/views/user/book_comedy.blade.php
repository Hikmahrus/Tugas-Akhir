@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      @foreach($comedy as $book)
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
  </div>
@stop
