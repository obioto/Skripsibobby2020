@extends('layouts.plain')

@section('content')
<div class=container>
<div style="margin:8vh; width:80%" class="containers">
            <h1 style="margin-left:8vh">{{$konten->judul}}</h1>
            <div style="margin-top:5vh" class="row">
                <div class="col-sm-6">
                    <img src="<?php echo asset("uploads/images/GambarKonten/$konten->gambar")?>" style="width:400px" class="rounded mx-auto d-block">
                </div>
                <div class="col">
                    <div class="col-sm">
                        <h3>
                            Rp. {{number_format($konten->terkumpul,0,'.','.')}}
                        </h3>
                        <h4 style="font-weight:100">
                            terkumpul dari target Rp. {{number_format($konten->target,0,'.','.')}}
                        </h4>
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <div class="col-sm" style="align-self: center;">
                                <h5 style="">{{$konten->Owner->username}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 7vh">
                        <div class="col-sm justify-content-center align-self-center" style="font-size: 4vh;border-right: solid;">
                        <h5 style="margin-left:8vh">
                            {{ round((float)$konten->terkumpul/$konten->target * 100 )}}%
                        </h5>
                        <h5 style="font-weight:100;margin-left:8vh">
                            Target
                        </h5>
                        </div>
                        <div class="col-sm justify-content-center align-self-center" style="font-size: 4vh;border-right: solid;text-align-last: center;">
                        <h5 style="">
                         {{$count}}
                        </h5>
                        <h5 style="font-weight:100;">
                            Donatur
                        </h5>
                        </div>
                        <div class="col-sm justify-content-center align-self-center" style="font-size: 4vh;">
                        <h5 style="margin-left:10vh">
                           {{$diff}}   
                        </h5>
                        <h5 style="font-weight:100;margin-left:6vh">
                            Hari Lagi
                        </h5>
                        </div>
                    </div>
                    <br>
                    <div class="float-right" style="margin:8vh">
                    @if($konten->confirmed == 1)
                        @if($diff !== 0)
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                        Beri Donasi
                        </button>

                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Donasi untuk "{{$konten->judul}}"</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                <h6 class="card-title" style="text-align: center;">Silahkan Transfer ke Rekening</h6>
                                <h2 style="text-align: center;font-weight: bold;color: cornflowerblue;">
                                    {{$konten->nomorRekening}}
                                </h2>
                                <h5 style="text-align: center;">Nama Bank : {{$konten->bank}}</h5>
                                <h6 style="text-align: center;">atas nama</h6>
                                <h6 style="text-align: center;">{{$konten->Owner->namaLengkap}}</h6>
                                    <div>
                                    <form class="col-md-12 p-t-10" role="form" method="POST" enctype="multipart/form-data" action="{{ route('isiDonasi',$konten->id) }}">
                                    {!! csrf_field() !!}
                                    <div class="form-group" style="margin-top:1rem ">
                                    <label class="control-label" for="namaLengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control{{ $errors->has('namaLengkap') ? ' is-invalid' : '' }}" name="namaLengkap" id="namaLengkap" value="{{ old('namaLengkap') }}">
                                        @if ($errors->has('namaLengkap'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('namaLengkap') }}</strong>
                                        </span>
                                        @endif
                                    <input type="checkbox" id="isanonim" name="isanonim" checked onclick="toggleswitch()"> Membuat Nama Menjadi Anonim
                                    </div>
                                    <div class="form-group" style="margin-top:1rem ">
                                    <label class="control-label" for="jumlah">Jumlah (Dalam Rupiah)</label>
                                    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control{{ $errors->has('jumlah') ? ' is-invalid' : '' }}" name="jumlah" id="jumlah" value="{{ old('jumlah') }}">
                                        @if ($errors->has('jumlah'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('jumlah') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group" style="margin-top:1rem ">
                                    <label class="control-label" for="nomorTelepon">Nomor yang dapat Dihubungi</label>
                                    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control{{ $errors->has('nomorTelepon') ? ' is-invalid' : '' }}" name="nomorTelepon" id="nomorTelepon" value="{{ old('nomorTelepon') }}">
                                        @if ($errors->has('nomorTelepon'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('nomorTelepon') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group" style="margin-top:1rem ">
                                    <label class="control-label" for="bukti">Bukti Transfer</label>
                                    <input type="file" class="form-control{{ $errors->has('bukti') ? ' is-invalid' : '' }}" name="bukti" id="bukti" value="{{ old('bukti') }}">
                                        @if ($errors->has('bukti'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('bukti') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Beri Donasi</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        @endif
                        @else
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" disabled>
                        Belum Terverifikasi
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            <br>    
            <nav class="nav nav-pills flex-column flex-sm-row">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Deskripsi Konten</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Perkembangan Konten</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Donatur</a>
                @if(backpack_auth()->user())
                    @if(backpack_auth()->user()->id == $konten->id_user)
                    <a class="nav-item nav-link" id="nav-checkdonasi-tab" data-toggle="tab" href="#nav-checkdonasi" role="tab" aria-controls="nav-checkdonasi" aria-selected="false">Check Donasi</a>                
                    <a class="nav-item nav-link" id="nav-perpanjangan-tab" data-toggle="tab" href="#nav-perpanjangan" role="tab" aria-controls="nav-perpanjangan" aria-selected="false">Form Perpanjangan Donasi</a>                                
                    @endif
                @endif
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">{{$konten->deskripsi}}</div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                @if(count($perkembangan) >= 1)
                    @foreach($perkembangan as $update)
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0">{{$update->tanggal}}</h5>
                            <img src="<?php echo asset("uploads/images/GambarKonten/$konten->gambar")?>" style="width:200px" class="mr-3" alt=" ">
                            <br>
                            <h6>{{$update->deskripsi}}<h6>
                            <h5 style="text-align:right">Rp. {{$update->pengeluaran}}</h5>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0">Belum Ada Perkembangan</h5>
                            
                        </div>
                    </div>
                @endif
                @if(backpack_auth()->user())
                    @if(backpack_auth()->user()->id == $konten->id_user)
                <hr>
                    <h5>Buat Perkembangan</h5>
                    <form class="col-md-12 p-t-10" role="form" method="POST" enctype="multipart/form-data" action="{{ route('perkembangan',$konten->id) }}">
                                    {!! csrf_field() !!}
                                    <div class="form-group" style="margin-top:1rem ">
                                    <label class="control-label" for="namaLengkap">Deskripsi</label>
                                    <textarea class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" name="deskripsi" id="deskripsi" value="{{ old('deskripsi') }}"></textarea>
                                        @if ($errors->has('deskripsi'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('deskripsi') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group" style="margin-top:1rem ">
                                    <label class="control-label" for="bukti">Gambar Pendukung Perkembangan Konten</label>
                                    <input type="file" class="form-control{{ $errors->has('gambar') ? ' is-invalid' : '' }}" name="gambar" id="gambar" value="{{ old('gambar') }}">
                                        @if ($errors->has('gambar'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('gambar') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group" style="margin-top:1rem ">
                                    <label class="control-label" for="bukti">Pengeluaran</label>
                                    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control{{ $errors->has('pengeluaran') ? ' is-invalid' : '' }}" name="pengeluaran" id="pengeluaran" value="{{ old('pengeluaran') }}">
                                        @if ($errors->has('pengeluaran'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('pengeluaran') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                       <br>
                                    <button type="submit" class="btn btn-primary">Beri Donasi</button>
                                    </form>
                    @endif
                @endif
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Nama Donatur</th>
                    <th scope="col">Waktu Pemberian</th>
                    <th scope="col">Jumlah Donasi</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($donatur) >= 1)
                    @foreach($donatur as $donatur)
                    @if($donatur->isconfirmed == '1')
                        @if($donatur->isanonim == '1')
                        <tr>
                        <td>NN</td>
                        <td>{{$donatur->created_at}}</td>
                        <td>{{$donatur->jumlah}}</td>
                        </tr>
                        @else
                        <tr>
                        <td>{{$donatur->namaLengkap}}</td>
                        <td>{{$donatur->created_at}}</td>
                        <td>{{$donatur->jumlah}}</td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                @else
                    <tr>
                    <td colspan="3">Belum ada Donasi</td>
                    </tr>
                @endif
                </tbody>
                </table>
              </div>

              <div class="tab-pane fade" id="nav-checkdonasi" role="tabpanel" aria-labelledby="nav-checkdonasi-tab">
              <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Nama Donatur</th>
                    <th scope="col">Waktu Pemberian</th>
                    <th scope="col">Jumlah Donasi</th>
                    <th scope="col">Bukti Transfer</th>
                    <th scope="col">Konfirmasi</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($unregisted) >=1 )
                @foreach($unregisted as $unregisted)
                        <tr>
                        <td>{{$unregisted->namaLengkap}}</td>
                        <td>{{$unregisted->created_at}}</td>
                        <td>{{$unregisted->jumlah}}</td>
                        <td><img src="<?php echo asset("uploads/images/buktitransfer/$unregisted->bukti")?>" style="width: 100px" </td>
                        <td>
                    <form class="col-md-12 p-t-10" role="form" method="POST" enctype="multipart/form-data" action="{{ route('verifikasi',$unregisted->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    </form>                    
                        </td>                        
                        </tr>
                @endforeach
                @else
                    <tr>
                    <td colspan="3">Belum ada yang mendonasi</td>
                    </tr>
                @endif
                </tbody>
                </table>
              </div> 
              <div class="tab-pane fade" id="nav-perpanjangan" role="tabpanel" aria-labelledby="nav-perpanjangan-tab">
                
                @if ($diff >= 5)
                <tr>
                    <td colspan="3">Belum bisa mengajukan Perpanjangan</td>
                </tr>
                @else
              <form class="col-md-12 p-t-10" role="form" method="POST" enctype="multipart/form-data" action="{{ route('Perpanjangan',$konten->id) }}">
                    {{ csrf_field() }}
                    <label class="control-label" for="jumlah_hari">Tambahan Hari </label>
                    <select class="form-control" name="jumlah_hari" id="jumlah_hari" value="{{ old('jumlah_hari') }}">
                        <option>30</option>
                        <option>60</option>
                        <option>90</option>
                        <option>120</option>
                        <option>150</option>
                    </select>

                    <label for="alasan">Alasan Perpanjangan</label>
                    <textarea class="form-control{{ $errors->has('alasan') ? ' is-invalid' : '' }}" name="alasan" id="alasan" value="{{ old('alasan') }}"rows="3"></textarea>
                                @if ($errors->has('alasan'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('alasan') }}</strong>
                                    </span>
                                @endif
                    <br>
                    <button type="submit" class="btn btn-primary">Ajukan Permohonan</button>
                </form>
                @endif
                <br>
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Waktu Pengajuan</th>
                    <th scope="col">Permintaan Hari</th>                    
                    <th scope="col">Alasan</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($perpanjangan) >= 1)
                @foreach($perpanjangan as $perpanjangan)
                <tr>
                        <td>{{$perpanjangan->created_at}}</td>
                        <td>{{$perpanjangan->jumlah_hari}}</td>
                        <td>{{$perpanjangan->alasan}}</td>
                        <td>{{$perpanjangan->status}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                <td colspan="3">Belum ada Perpanjangan</td>                
                </tr>
                @endif
                </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
</div>
<script> 
    function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
</script> 
</div>
@endsection