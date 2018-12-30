@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Ganti Password &nbsp; <i class="fa fa-key"></i></h3>
                </div>
                <div class="box-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }} <i class="fa fa-key"></i>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }} <i class="fa fa-key"></i>
                        </div>
                    @endif
                    <div class="col-md-6">
                        {!! Form::open(['route' => 'account.password.update', 'method' => 'POST', 'id' => 'form-account']) !!}
                        
                            <div class="form-group">
                                {!! Form::label('password_lama', 'Password Lama') !!}
                                {!! Form::password('password_lama', ['id' => 'password_lama', 'class' => 'form-control', 'placeholder' => 'Password Lama']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Password Baru') !!}
                                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password Baru']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password_confirmation', 'Password Confirmation') !!}
                                {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => 'Ketik Ulang Password']) !!}
                            </div>

                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection