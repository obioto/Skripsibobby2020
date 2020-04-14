@extends('layouts.plain')

@section('content')
<div class="container">
<div style="margin-top:2rem">
<h4>Cari Konten</h4>
<form action="/cari/hasil" method="GET">
	<input type="text" name="getjudul" placeholder="Cari Konten" value="{{ old('getjudul') }}">
</form>
</div>

<div class=row style="margin-top:5rem">

@foreach ($konten as $konten)
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