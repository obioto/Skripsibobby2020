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

@foreach($konten as $k)
    <div class="col-sm-3 ">
      <div class="card-deck">
        <div class="card  bg-light" style="width: 22rem; ">
          <img class="card-img-top" style="object-fit: cover; width: 100%; height: 15vw" src="{{url('uploads/images/GambarKonten/')}}/{{$k->gambar}}" alt="Card image cap">

          <div class="card-body">
            <a href={{url('konten/'.$k->id)}}>
              <h5 class="card-title">{{ $k->judul }}</h5>
            </a>
            <p class="small" style="margin-bottom : 0px;">{{ $k->Owner->name }}</p>
            <p style="color: blue;">Terkumpul Rp. {{ number_format($k->terkumpul) }}</p>
            <p class="small">{{ round((float)$k->terkumpul/$k->target * 100 )}}% dari target</p>

          </div>
        </div>
      </div>
      <br>
    </div>
    @endforeach
</div>
		</div>
@endsection