@extends('layouts.app')

@section('title')
    Home
@endsection

@push('js')
    <script>
        var ctx = document.getElementById("canvas").getContext('2d'),
            url = "{{ route('penjualan.chart') }}",
            book = new Array();

        $.get(url, function(res) {
            res.forEach(function(data) {
                book.push(data);
            });
        });

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["January", "February", "Maret", "April", "Mei", "Juny", "July", "Agustus", "September", "October", "November", "Desember"],
                datasets: [{
                    label: 'Top Buku In 2019',
                    data: book,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(245,130,48)',
                        'rgba(60,180,75',
                        'rgba(145,30,180)',
                        'rgba(230,25,75)',
                        'rgba(0,130,200)',
                        'rgba(240,50,230)',
                        'rgba(170,255,195)',
                        'rgba(170,110,40)',
                        'rgba(0,128,128)',
                        'rgba(0,0,128)',
                        'rgba(255,255,35)',
                        'rgba(250,190,190)',
                    ],
                }],
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                }
            }
        }); 

        
    </script>
@endpush
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
        <div class="inner">
        <h3>150</h3>

        <p>New Orders</p>
        </div>
        <div class="icon">
        <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
        <h3>53<sup style="font-size: 20px">%</sup></h3>

        <p>Bounce Rate</p>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
        <h3>44</h3>

        <p>User Registrations</p>
        </div>
        <div class="icon">
        <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
        <div class="inner">
        <h3>65</h3>

        <p>Unique Visitors</p>
        </div>
        <div class="icon">
        <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->   

{{-- Chart --}}
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Chart</h3>
            </div>
            <div class="box-body">
                <canvas id="canvas" width="400" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@stop


