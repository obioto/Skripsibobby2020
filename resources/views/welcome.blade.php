@extends('layouts.plain')

@section('content')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="depan">Donasi Kuy!</h1>
    <p class="lead">Bantu Orang Orang Sekitar dengan aksi nyatamu!</p>
    @if(backpack_auth()->check())
    <a class="btn btn-secondary" href="{{ route('buatkonten') }}" role="button">Buat Konten baru</a>
    @else
    <a class="btn btn-secondary" href="{{ route('revised.auth.register') }}" role="button">Gabung Bersama Kami</a>
    @endif
  </div>
</div>

<div class=container>
<h4>Ayo Bantu Mereka!</h4>
<h6>Donasi darimu dapat membantu mereka!</h6>
<div class=row>
@foreach ($kontens as $konten)
  <div class="card" style="width: 15rem;margin-right:15px">
    <img src="<?php echo asset("uploads/images/GambarKonten/$konten->gambar")?>" class="card-img-top">
    <div class="card-body">
    <a href={{url('konten/'.$konten->id)}}>
      <h5 class="card-title">{{ $konten->judul }}</h5>
    </a>
      <p class="small">{{ $konten->Owner->name }}</p> 
    </div>
  </div>
@endforeach
</div>
</div>
@endsection