@extends('layouts.app')

@section('content')
  <div class="container">
    <form action="{{ route('add.kategori') }}" method="post">
      @csrf

      <div class="form-group">
        <label>Kategori</label>
        <input type="text" name="nama" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary" name="button">Submit</button>

    </form><br>

    <div class="table-responsive">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Kategori</th>
          <th>Action</th>
        </tr>
      </thead>
        @foreach($kategori as $Key => $data)
      <tbody>
        <tr>
          <td>{{ $Key+1 }}</td>
          <td>{{ $data->nama }}</td>
          <td>
            <form action="{{ route('delete.kategori',$data) }}" method="post">
              <a href="{{ route('edit.kategori',$data) }}" class="btn btn-sm btn-warning">Edit</a>
              @csrf
              @method('DELETE')
              <button type="submit" name="button" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">DELETE</button>
            </form>
          </td>
        </tr>
      </tbody>
      @endforeach
  </div>
</div>
{{ $kategori->links() }}
@endsection
