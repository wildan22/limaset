@extends('layouts.sidebar')

@section('page_title','Dashboard - Operator')

@section('content-header')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$baik}}</h3>

                    <p>Barang Kondisi Baik</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$kurangbaik}}</h3>

                    <p>Barang Kurang Baik</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cog"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$rusak}}</h3>

                    <p>Barang Rusak</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->


<div class="row">
    <div class="col-md-6">
        <!-- BAR CHART -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Jumlah Inventaris di cabang {{Auth::user()->unit->alias}}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="myChart"
                        style="min-height: 500px; height: 250px; max-height: 500px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
        <!-- BAR CHART -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Sebaran kondisi barang di cabang {{Auth::user()->unit->alias}}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="doughnutChart"
                        style="min-height: 500px; height: 250px; max-height: 500px; max-width: 100%;"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection


@section('javascript')
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<script>
    var barChart = document.getElementById("myChart").getContext("2d");

    var barChartData = {
        labels: [
            @foreach($tahunbarang as $tb)
                {{$tb->tahun_perolehan}},
            @endforeach
        ],
        datasets: [
            @foreach($datacabang as $dc)
            {
                label: "{{$dc->alias}}",
                backgroundColor: "grey",
                data: [
                    @foreach($tahunbarang as $tb)
                    <?php $count=0 ?>
                        @foreach($databarang as $db)
                            @if($db->unit->alias == $dc->alias && $tb->tahun_perolehan == $db->tahun_perolehan)
                            <?php $count++ ?>
                            @endif
                        @endforeach
                    <?php echo $count.","?>
                    @endforeach
                    ]
            },
            @endforeach
        ]
    };

    var myBarChart = new Chart(barChart, {
        type: 'bar',
        data: barChartData,
        options: {
            barValueSpacing: 20,
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                    }
                }]
            }
        
        }
    });

    var  doughnutChart = document.getElementById("doughnutChart").getContext("2d");

    var doughnutChartData = {
        labels: [
            'BAIK',
            'KURANG BAIK',
            'RUSAK'
        ],
        datasets: [
            @foreach($datacabang as $dc)
            {
                label: ['BAIK','KURANG BAIK','RUSAK'],
                backgroundColor: ['green','yellow','red'],
                data: [
                    {{$baik}},{{$kurangbaik}},{{$rusak}}
                    ]
            },
            @endforeach
        ]
    };

    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
            datalabels: {
                formatter: (value, myDoughnutChart) => {
                    let sum = 0;
                    let dataArr = myDoughnutChart.chart.data.datasets[0].data;
                    dataArr.map(data => {
                        sum += data;
                    });
                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                    return percentage;
                },
                color: '#fff',
            }
        }
    }

    var myDoughnutChart = new Chart(doughnutChart, {
        type: 'doughnut',
        data: doughnutChartData,
        options: donutOptions
    });
    </script>

@endsection