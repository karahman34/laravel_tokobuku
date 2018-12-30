<div class="row">
    <div class="col-md-6 col-xl-6">
        <img src="{{ asset('images_buku/'.$model->cover) }}" alt="Cover Buku" class="img-responsive">
    </div>

    <div class="col-md-6 col-xl-6">
        <p>No ISBN : {{ $model->noisbn }}</p>
        <p>Judul : {{ $model->judul }} </p>
        <p>Tahun : {{ $model->tahun }}</p>
        <p>Penulis : {{ $model->penulis }}</p>   
        <p>Penerbit : {{ $model->penerbit }}</p>
        <p>Stok : {{ $model->stok }}</p>
        <p>Harga Pokok : Rp {{ number_format($model->harga_pokok, 0, ',','.') }}</p>
        <p>Harga Jual : Rp {{ number_format($model->harga_jual, 0, ',','.') }}</p>
        <p>PPN : {{ $model->ppn }}%</p>
        <p>Diskon : {{ $model->diskon }}%</p>
    </div>
</div>