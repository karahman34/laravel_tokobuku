{!! Form::model($model, [
    'route' => $model->exists ? ['distributor.update', $model->id_distributor] : 'distributor.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'class' => 'form-submit',
]) !!}

<div class="form-group">
    {!! Form::label('nama_distributor', 'Nama Distributor', ['class' => 'control-label']) !!}
    {!! Form::text('nama_distributor', null, ['id' => 'nama_distributor', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('alamat', 'Alamat', ['class' => 'control-label']) !!}
    {!! Form::textarea('alamat', null, ['id' => 'alamat', 'class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('telepon', 'Telepon', ['class' => 'control-label']) !!}
    {!! Form::number('telepon', null, ['id' => 'telepon', 'class' => 'form-control']) !!}
</div>

{!! Form::close() !!}