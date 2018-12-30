@extends('layouts.auth')

@push('js')
    <script>$('body').css('margin-top', '-65px');</script>
@endpush

@section('content')
<div class="register-box">
    <div class="register-logo">
      <a href="{{ route('register') }}"><b>Register Kasir</b></a>
    </div>
  
    <div class="register-box-body">
      <p class="login-box-msg">Register a new membership</p>
  
      <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        
        @csrf
        
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Full name" name="nama" value="{{ old('nama') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->any())
                <span class="text-danger">{{ $errors->first('nama') }}</span>
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->any())
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->any())
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Telepon" name="telepon" value="{{ old('telepon') }}">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            @if ($errors->any())
                <span class="text-danger">{{ $errors->first('telepon') }}</span>
            @endif
            </div>
        <div class="form-group has-feedback">
            <textarea name="alamat" id="alamat" cols="35" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
            @if ($errors->any())
                <span class="text-danger">{{ $errors->first('alamat') }}</span>
            @endif
        </div>  
        <div class="form-group">
            <label for="img">{{ __('Photo Anda') }}</label>
            <input type="file" class="form-control-file" id="img" name="photo">
            
            @if ($errors->has('photo'))
                <span class="text-danger">
                    <strong>{{ $errors->first('photo') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-8">
            <div class="checkbox icheck">
                <label>
                    <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
                </label>
            </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
            <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div>
  <!-- /.register-box -->
@endsection