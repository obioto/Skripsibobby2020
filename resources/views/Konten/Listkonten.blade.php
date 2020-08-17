@extends('layouts.plain')

@section('content')
<div class="container">
<div style="margin-top:2rem">
<h4>List Konten</h4>
</div>

<div class=row style="margin-top:5rem">

@foreach ($kontens as $kontens)
  <div class="card" style="width: 15rem;margin-right:15px">
    <img src="<?php echo asset("uploads/images/GambarKonten/$kontens->gambar")?>" class="card-img-top">
    <div class="card-body">
    <a href={{url('konten/'.$kontens->id)}}>
      <h5 class="card-title">{{ $kontens->judul }}</h5>
    </a>
      <p class="small">{{ $kontens->Owner->name }}</p> 
    </div>
  </div>
@endforeach
</div>
		</div>
@endsection