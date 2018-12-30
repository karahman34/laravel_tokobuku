@extends('layouts.app')

@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endpush

@push('js')
    {{-- SELECT2 --}}
    <script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2();
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('cart.datatables') }}",
            columns: [
                {data: 'DT_RowIndex', searchable: false},
                {
                    data: 'cover', orderable: false, searchable: false,
                    render: function(data) {
                        return '<img src="'+ base_url +'images_buku/'+ data +'" class="img-responsive">';
                    },
                },
                {data: 'judul'},
                {
                    data: 'harga_total',
                    render: function(data){
                        return 'Rp '+toRupiah(data);
                    },
                },
                {data: 'jumlah'},
                {data: 'action', orderable: false, searchable: false},
            ],
        });

        $('#uang_pelanggan').on('keyup', function(){
            var me = $(this).val().split('.'),
                harga = $('#total_harga').attr('data-uang');

            var uang_pelanggan = '';
            
            for(i = 0; i < me.length; i++)
            {
                uang_pelanggan += me[i];
            }

            $('#uang_kembali').val(toRupiah(uang_pelanggan-harga));
        });
    </script>
@endpush

@section('title')
    {{$title}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Kasir <i class="fa fa-shopping-cart"></i></h3>
                </div>
                <div class="box-body">
                    {!! Form::model($model, [
                        'route' => 'cart.store',
                        'method' => 'POST',
                        'id' => 'form-tambahBuku',
                    ]) !!}

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('buku', 'Buku') !!}
                            {!! Form::select('buku', $model->pluck('judul', 'id_buku'), null, ['id' => 'buku','class' => 'form-control select2', 'placeholder' => 'Pilih Buku']); !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('jumlahB', 'Jumlah') !!}
                            {!! Form::number('jumlahB', null, ['id' => 'jumlahB', 'class' => 'form-control']); !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::submit('Tambah', ['class' => 'btn btn-primary', 'style' => 'margin-top: 25px;']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                    <br>

                    <table class="table table-hover table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cover</th>
                                <th>Judul</th>
                                <th>Harga Total</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="5" align="right"><b>Total :</b></td>
                                <td id="total_harga" data-uang="{{ $hartot }}"><b>Rp {{ number_format($hartot, 0, ',','.') }}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="box-body">
                    
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Penjualan</h3>
                </div>
                <div class="box-body">
                    {!! Form::open(['route' => 'penjualan.store', 'method' => 'POST', 'id' => 'form-single-submit']) !!}

                    <div class="form-group">
                        {!! Form::label('uang_pelanggan', 'Uang Pelanggan') !!}

                        <div class="input-group">
                            <div class="input-group-addon">Rp</div>
                            {!! Form::text('uang_pelanggan', null, ['class' => 'form-control', 'id' => 'uang_pelanggan']) !!}
                        </div>
                    </div>

                    <div class="form group">
                        {!! Form::label('uang_kembali', 'Uang Kembali') !!}
                        <div class="input-group">
                            <div class="input-group-addon">RP</div>
                            {!! Form::text('uang_kembali', null, ['class' => 'form-control', 'id' => 'uang_kembali']) !!}
                        </div>
                    </div>
                    <br>

                    {!! Form::submit('Selesai', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('cart.clearAll') }}" class="btn btn-danger" id="btn-clearAll">Clear all</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection