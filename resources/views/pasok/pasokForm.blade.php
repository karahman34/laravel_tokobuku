{!! Form::model($model, [
    'route' => $model->exists ? ['pasok.update', $model->id_pasok] : 'pasok.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'class' => 'form-submit'
])!!}

<div class="form-group">
    {!! Form::label('id_distributor', 'ID Distributor', ['class' => 'control-label']) !!}
    {!! Form::text('id_distributor', null, ['id' => 'id_distributor', 'class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('id_buku', 'ID Buku', ['class' => 'control-label']) !!}
    {!! Form::text('id_buku', null, ['id' => 'id_buku', 'class' => 'form-control'])!!}
</div>

<div class="form-group">
    {!! Form::label('jumlah', 'Jumlah', ['class' => 'control-label']) !!}
    {!! Form::number('jumlah', null, ['id' => 'jumlah', 'class' => 'form-control'])!!}
</div>

{!! Form::close() !!}