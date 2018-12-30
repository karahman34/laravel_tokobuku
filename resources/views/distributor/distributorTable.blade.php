@extends('layouts.app')

@push('css')
    <style>
        .buttons-html5{
            margin-height:15px !important;
        }
    </style>
@endpush

@push('js')
<script>
    $('#datatable').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [1,2,3]
                },
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [1,2,3],
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [1,2,3]
                },
            },
        ],
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('distributor.datatables') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'nama_distributor'},
            {data: 'alamat'},
            {data: 'telepon'},
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
                <h3 class="box-title" style="width: 100%;display: inline;">List Distributor <i class="fa fa-truck"></i></h3>
                <a href="{{ route('distributor.create') }}" style="float: right;" class="btn btn-primary btn-show" data-toggle="tooltip" data-placement="left" title="Tambah Data" data-title="Tambah Data">Tambah Data</a>
            </div>
            <div class="box-body">
                <table class="table table-hover table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Distributor</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
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