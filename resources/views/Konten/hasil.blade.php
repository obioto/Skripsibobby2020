@extends('layouts.plain')

@section('content')
<div class="container">
			<h3>Pencarian</h3>
			<hr>
			<form action="{{ route('getjudul')}}" action="GET">
				<div class="form-group">
					<label for="cari">data yang dicari</label>
					<input type="text" class="form-control" id="cari" name="cari" placeholder="cari">
				</div>
				<input class="btn btn-primary" type="submit" value="Update data">
			</form>
		</div>

<div class="container">
	<h3>Hasil Pencarian</h3>
	<hr>
		@if (count($judul) > 0)
			@foreach ($data as $judul)
				{{ $judul->judul }}<br>
			@endforeach
		@else 
		Data tidak ditemukan.
		@endif
	</div>
@endsection