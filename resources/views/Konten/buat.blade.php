@extends('layouts.plain')

@section('content')
<div class=container>
<div style="margin-top: 2rem">
  <div class="card">
    <div class="card-header">
      Buat Konten Baru
    </div>
    <div class="card-body">
      <h5 class="card-title">Isi Form yang telah disediakan</h5>
      <form class="col-md-12 p-t-10" role="form" method="POST" enctype="multipart/form-data" action="{{ route('buatkonten') }}">
      {!! csrf_field() !!}

        <div class="row">
          <div class="col">
            <label for="gambar">Gambar Konten</label>
            <input type="file" class="form-control{{ $errors->has('gambar') ? ' is-invalid' : '' }}" name="gambar" id="gambar" value="{{ old('gambar') }}">            
                                @if ($errors->has('gambar'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gambar') }}</strong>
                                    </span>
                                @endif
          </div>
          <div class="col">
            <label class="control-label" for="judul">Judul Konten</label>
            <input type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" id="judul" value="{{ old('judul') }}">
                                @if ($errors->has('judul'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                @endif
            </div>
        </div>
          <div class="form-group" style="margin-top:1rem ">
          <label for="deskripsi">Deskripsi</label>
          <textarea class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" name="deskripsi" id="deskripsi" value="{{ old('deskripsi') }}"rows="3"></textarea>
                                @if ($errors->has('deskripsi'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
        </div>
        <div class="row">
          <div class="col">
          <label class="control-label" for="target">Target (dalam Rupiah)</label>
            <input type="text" class="form-control{{ $errors->has('target') ? ' is-invalid' : '' }}" name="target" id="target" value="{{ old('target') }}">
                                @if ($errors->has('target'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('target') }}</strong>
                                    </span>
                                @endif
            </div>
          <div class="col">
          <label for="lama_donasi">Lama Donasi (Dalam Hari)</label>
            <select class="form-control" name="lama_donasi" id="lama_donasi" value="{{ old('lama_donasi') }}">
              <option>30</option>
              <option>60</option>
              <option>90</option>
              <option>120</option>
              <option>150</option>
            </select>
          </div>
        </div>
        <div class="form-group" style="margin-top:1rem ">
        <label class="control-label" for="nomorRekening">Nomor Rekening (dapat berupa Go-Pay atau OVO)</label>
            <input type="text" class="form-control{{ $errors->has('nomorRekening') ? ' is-invalid' : '' }}" name="nomorRekening" id="nomorRekening" value="{{ old('nomorRekening') }}">
                                @if ($errors->has('nomorRekening'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nomorRekening') }}</strong>
                                    </span>
                                @endif
            </div>
            <small>*Pastikan sesuai dengan nama Lengkap yang sudah dicantumkan pada registrasi user</small>
        </div>
        <button type="submit" class="btn btn-primary">Konfirmasi</button>
        </form>
    </div>
  </div>
</div>
</div>
@endsection