@extends('layouts.app')

@section('content')
    <!-- view book -->

    <div class="row">
      <div class="col">

        <h4 class="font-weight-bold">Random</h4>
        <div class="row">
              @foreach($random as $Key => $book)
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

        <h4 class="font-weight-bold">
          <a style="text-decoration: none;" href="{{ route('all.horor') }}">Horor</a>
        </h4>
        <div class="row">
              @foreach($horor as $Key => $book)
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

        <h4 class="font-weight-bold">
          <a style="text-decoration: none;" href="{{ route('all.novel') }}">Novel</a>
        </h4>
        <div class="row">
              @foreach($novel as $Key => $book)
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
    </div>

    <!-- view ebook -->
    <div class="row">
      <div class="col">
        <h4 class="font-weight-bold">eBook</h4>

        <div class="row">
              @foreach($ebook as $Key => $ebook)
              <div class="col-md-auto">
                <div class="card mb-3" style="width: 11rem;">
                    <a href="{{ route('detail.ebook',$ebook) }}" class="text-decoration-none" style="color:black;text-decoration: none;">
                      <img src="{{ asset('img/'.$ebook->img) }}" class="card-img-top" alt="...">
                      </a>
                      <div class="card-body">
                        <center>
                          <h6 class="card-title">{{ $ebook->name }}</h6>
                          <form action="{{ route('read.pdf',$book) }}" method="post">
                            @csrf
                            <input type="hidden" name="kode" value="{{ $ebook->kode }}">
                            <button type="submit" onclick="return confirm('Are you sure?')" name="id" value="{{ $ebook->id }}" class="btn btn-info square">Read</button>
                          </form>
                        </center>
                      </div>
                </div>
              </div>
              @endforeach
        </div>
      </div>
    </div>

@endsection
