@extends('layouts.app')

@push('js')

<script>
  $(document).ready(function() {
      $('#datatable').DataTable({
        dom: 'lBfrtip',
        buttons: [
          {
            extend: 'pdfHtml5',
            exportOptions: {
              columns: [2,3,4,5,6]
            },
          },
          {
            extend: 'print',
            exportOptions: {
              columns: [2,3,4,5,6]
            },
          },
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: [2,3,4,5,6],
            },
          },
        ],
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('buku.datatables') }}",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
          {
            data: 'cover', searchable: false, orderable: false,
            render: function(data){
              return '<img src="{{ asset('images_buku') }}/'+data+'" class="img-responsive" style="max-height:75px !important">';
            },
            noImageText: 'No Image',
          },
          {data: 'noisbn'},
          {data: 'judul'},          
          {data: 'penulis'},
          {data: 'penerbit'},
          {data: 'stok'},
          {
            data: 'harga_jual',
            render: function(data) {
              return 'Rp '+toRupiah(data);
            },
          },
          {data: 'action', searchable: false, orderable: false},
        ],
      });
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
        <h3 class="box-title" style="display:inline !important;width:100% !important;">{{ $title }} <i class="fa fa-book"></i></h3>
        <a href="{{ route('buku.create') }}" class="btn btn-primary btn-show" style="float:right" data-toggle="tooltip" data-placement="left" title="Tambah Data" data-title="Tambah Data">Tambah {{ $aim }}</a>
        <div class="clearfix"></div>
      </div>

      <div class="box-body">
        <table class="table table-striped table-hover" id="datatable" style="width: 100%;">
          <thead>
            <tr>
              <th>#</th>
              <th>Cover</th>
              <th>No ISBN</th>  
              <th>Judul</th>
              <th>Penulis</th>
              <th>Penerbit</th>
              <th>Stok</th>
              <th>Harga Jual</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>


      </div>
    </div>
  </div>
</div>
@endsection
