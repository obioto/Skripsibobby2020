@extends('layouts.plain')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-4">
            <h3 class="text-center mb-4">{{ trans('backpack::base.register') }}</h3>
            <div class="card">
                <div class="card-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST" enctype="multipart/form-data" action="{{ route('revised.auth.register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label" for="name">{{ trans('backpack::base.name') }}</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="{{ backpack_authentication_column() }}">{{ config('backpack.base.authentication_column_name') }}</label>

                            <div>
                                <input type="{{ backpack_authentication_column()=='email'?'email':'text'}}" class="form-control{{ $errors->has(backpack_authentication_column()) ? ' is-invalid' : '' }}" name="{{ backpack_authentication_column() }}" id="{{ backpack_authentication_column() }}" value="{{ old(backpack_authentication_column()) }}">

                                @if ($errors->has(backpack_authentication_column()))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first(backpack_authentication_column()) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password">{{ trans('backpack::base.password') }}</label>

                            <div>
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password_confirmation">{{ trans('backpack::base.confirm_password') }}</label>

                            <div>
                                <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label" for="namaLengkap">Nama Lengkap (Sesuai KTP)</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has('namaLengkap') ? ' is-invalid' : '' }}" name="namaLengkap" id="namaLengkap" value="{{ old('namaLengkap') }}">

                                @if ($errors->has('namaLengkap'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('namaLengkap') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="alamat">Alamat (Sesuai KTP)</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" id="alamat" value="{{ old('alamat') }}">

                                @if ($errors->has('alamat'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nomorKtp">Nomor KTP</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has('nomorKtp') ? ' is-invalid' : '' }}" name="nomorKtp" id="nomorKtp" value="{{ old('nomorKtp') }}">

                                @if ($errors->has('nomorKtp'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nomorKtp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="noHp">Nomor yang dapat dihubungi</label>

                            <div>
                                <input type="text" class="form-control{{ $errors->has('noHp') ? ' is-invalid' : '' }}" name="noHp" id="noHp" value="{{ old('noHp') }}">

                                @if ($errors->has('noHp'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('noHp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="fotoKtp">Foto KTP</label>

                            <div>
                                <input type="file" class="form-control{{ $errors->has('fotoKtp') ? ' is-invalid' : '' }}" name="fotoKtp" id="fotoKtp" value="{{ old('fotoKtp') }}">

                                @if ($errors->has('fotoKtp'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fotoKtp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ trans('backpack::base.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (backpack_users_have_email())
                <div class="text-center"><a href="{{ route('backpack.auth.password.reset') }}">{{ trans('backpack::base.forgot_your_password') }}</a></div>
            @endif
            <div class="text-center"><a href="{{ route('revised.auth.login') }}">{{ trans('backpack::base.login') }}</a></div>
        </div>
    </div>
@endsection
