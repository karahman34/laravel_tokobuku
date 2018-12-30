{!! Form::model($model, [
    'route' => $model->exists ? ['buku.update', $model->id_buku] : 'buku.store',
    'method' => $model->exists ? 'PUT' : 'POST',
    'files' => true,
    'role' => 'form',
    'class' => 'form-submit',
]) !!}

    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-6 col-md-6">
            {!! Form::label('judul', 'Judul', ['class' => 'control-label'])!!}
            {!! Form::text('judul', null, ['id' => 'judul', 'class' => 'form-control', 'placeholder' => 'Judul'])!!}
        </div>
    
        <div class="form-group col-md-6 col-sm-6 col-xs-6 col-md-6">
            {!! Form::label('noisbn', 'No ISBN', ['class' => 'control-label'])!!}
            {!! Form::text('noisbn', null, ['id' => 'noisbn', 'class' => 'form-control', 'placeholder' => 'No ISBN'])!!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-6 ">
            {!! Form::label('penulis', 'Penulis', ['class' => 'control-label'])!!}
            {!! Form::text('penulis', null, ['id' => 'penulis', 'class' => 'form-control', 'placeholder' => 'Penulis'])!!}
        </div>
    
        <div class="form-group col-md-6 col-sm-6 col-xs-6 col-6">
            {!! Form::label('penerbit', 'Penerbit', ['class' => 'control-label'])!!}
            {!! Form::text('penerbit', null, ['id' => 'penerbit', 'class' => 'form-control', 'placeholder' => 'Penerbit'])!!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-6 col-md-6 col-sm-6">
            {!! Form::label('tahun', 'Tahun', ['class' => 'control-label'])!!}
            {!! Form::text('tahun', null, ['id' => 'tahun', 'class' => 'form-control', 'placeholder' => 'Tahun'])!!}
        </div>
    
        <div class="form-group col-md-6 col-sm-6 col-xs-6">
            {!! Form::label('stok', 'Stok', ['class' => 'control-label'])!!}
            {!! Form::number('stok', null, ['id' => 'stok', 'class' => 'form-control', 'placeholder' => 'Stok'])!!}
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-6">
            {!! Form::label('harga_pokok', 'Harga Pokok', ['class' => 'control-label'])!!}
            <div class="input-group">
                <div class="input-group-addon">RP</div>
                {!! Form::number('harga_pokok', null, ['id' => 'harga_pokok', 'class' => 'form-control', 'placeholder' => 'Harga Pokok'])!!}
            </div>
        </div>
    
        <div class="form-group col-md-6 col-sm-6 col-xs-6">
            {!! Form::label('harga_jual', 'Harga Jual', ['class' => 'control-label'])!!}
            <div class="input-group">
                <div class="input-group-addon">RP</div>
                {!! Form::number('harga_jual', null, ['id' => 'harga_jual', 'class' => 'form-control', 'placeholder' => 'Harga Jual'])!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-6">
            {!! Form::label('ppn', 'PPN', ['class' => 'control-label'])!!}
            <div class="input-group">
                {!! Form::number('ppn', null, ['id' => 'ppn', 'class' => 'form-control', 'placeholder' => 'PPN'])!!}
                <div class="input-group-addon">%</div>
            </div>
        </div>
    
        <div class="form-group col-md-6 col-sm-6 col-xs-6">
            {!! Form::label('diskon', 'Diskon', ['class' => 'control-label'])!!}
            <div class="input-group">
                {!! Form::number('diskon', null, ['id' => 'diskon', 'class' => 'form-control', 'placeholder' => 'Diskon'])!!}
                <div class="input-group-addon">%</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('cover', 'Cover Buku', ['class' => 'control-label']) !!}
            {!! Form::file('cover', ['id' => 'cover', 'class' => 'form-control-file']) !!}
        </div>
    </div>
    
{!! Form::close() !!}
