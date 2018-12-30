@extends('layouts.app')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Account <i class="fa fa-user"></i></h3>
                </div>
                <div class="box-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    {!! Form::model($model, [
                        'route' => ['account.update', $model->id_kasir],
                        'method' => 'PUT',
                        'file' => true,
                        'id' => 'form-account',
                    ])!!}

                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('nama', 'Nama') !!}
                            {!! Form::text('nama', null, ['id' => 'nama', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('email', 'E-Mail') !!}
                            {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('telepon', 'Telepon') !!}
                            {!! Form::number('telepon', null, ['id' => 'telepon', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-md-6">
                            {!! Form::label('alamat', 'Alamat') !!}
                            {!! Form::textarea('alamat', null, ['id' => 'alamat', 'class' => 'form-control', 'rows' => '-10']) !!}
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::label('photo', 'Photo') !!}
                            {!! Form::file('photo', null, ['id' => 'photo', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="form-group col-md-6">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('account.password') }}" class="btn btn-warning">Ganti Password ? <i class="fa fa-key"></i></a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection