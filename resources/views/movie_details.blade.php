@extends('layouts.master')

@section('title', 'Movie Details')

@section('main')

<div class="row">
  <div class="col-md-3 mb-5 mb-md-0">
    <img class="rounded-lg" src="{{ asset($movie->imgPath) }}" style="width: 100%;" alt="">
  </div>
  <div class="col">
    <h2 class="text-capitalize text-center"> {{ $movie->title }} </h2>
    <div class="text-muted text-center mb-5 row">
      <p class="col-4">{{ $movie->lang }}</p>
      <p class="col-4">{{ $formatted_duration }}</p>
      <p class="col-4">{{ $movie->releaseYear }}</p>
    </div>

    <p class="description px-5">{{ $movie->desc }}</p>

    <button class="btn-lg btn-primary float-right">Book</button>
  </div>
</div>

@endsection
