@extends('layouts.plain')

@section('content')
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="depan">Donasi Pendidikan</h1>
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

  <div class="row ">
    <!-- my php code which uses x-path to get results from xml query. -->
    @foreach($kontens as $konten)
    <div class="col-sm-3 ">
      <div class="card-deck">
        <div class="card  bg-light" style="width: 22rem; ">
          <img class="card-img-top" style="object-fit: cover; width: 100%; height: 15vw" src="{{url('uploads/images/GambarKonten/')}}/{{$konten->gambar}}" alt="Card image cap">

          <div class="card-body">
            <a href={{url('konten/'.$konten->id)}}>
              <h5 class="card-title">{{ $konten->judul }}</h5>
            </a>
            <p class="small" style="margin-bottom : 0px;">{{ $konten->Owner->name }}</p>
            <p style="color: blue;">Terkumpul Rp. {{ number_format($konten->terkumpul) }}</p>
            <p class="small">{{ round((float)$konten->terkumpul/$konten->target * 100 )}}% dari target</p>

          </div>
        </div>
      </div>
      <br>
    </div>
    @endforeach
  </div>

  
</div>
@endsection