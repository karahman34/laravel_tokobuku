<div class="row">
    <div class="col-md-6">
        <img src="{{ asset('images/'. Auth::user()->photo) }}" alt="Photo Kasir" class="img-responsive">
    </div>

    <div class="col-md-6">
        <p>Nama : {{ $model->nama  }}</p>
        <p>E-Mail : {{ $model->email }}</p>
        <p>Alamat : {{ $model->alamat }}</p>
        <p>Telepon : {{ $model->telepon }}</p>
    </div>
</div>