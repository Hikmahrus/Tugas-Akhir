@extends('layouts.app')

@section('content')
<div class="container">
  <embed src="{{ asset('pdf/'.$ebook->pdf) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="500px" alt="pdf" />
</div>
@stop
