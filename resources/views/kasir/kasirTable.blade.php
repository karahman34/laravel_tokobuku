@extends('layouts.app')

@push('js')

<script>
    $('#datatable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('kasir.datatables') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {
                data: 'photo', searchable: false, orderable: false,
                render: function(data){
                    return '<img src="{{ asset('images') }}/'+data+'" class="img-responsive" style="max-height:80px !important">';
                },
            },
            {data: 'nama'},
            {data: 'email'},
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
                <h3 class="box-title" style="width: 100%;display: inline;">List Kasir <i class="fa fa-dollar"></i></h3>
            </div>
            <div class="box-body">
                <table class="table table-hover table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Nama</th>
                            <th>E-Mail</th>
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