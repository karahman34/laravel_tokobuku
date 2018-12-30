@extends('layouts.app')

@push('js')

<script>
    $('#datatable').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [1,2,3,4],
                },
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [1,2,3,4],
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [1,2,3,4],
                },
            },
        ],
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('penjualan.datatables') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'id_buku'},
            {data: 'id_kasir'},
            {data: 'jumlah'},
            {
                data: 'total',
                render: function(data){
                    return 'Rp '+ toRupiah(data);
                },
            },
            {data: 'action', searchable: false, orderable: false},
        ],
    });
</script>
@endpush

@section('title')
{{ $title }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">List Penjualan <i class="fa fa-shopping-cart"></i></h3>
            </div>
            <div class="box-body">
                <table class="table table-hover table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Buku</th>
                            <th>ID Kasir</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        {{-- DATA --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection