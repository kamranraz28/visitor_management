@extends('frontdesk.master')
@section('title','VMS')
@section('content')
@section('css')
<style>
    .dataTables_filter {
        padding: 20px;
    }

    .dataTables_length {
        padding-left: 20px;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
<div class="col-md-9 col-lg-8 col-xl-12">
    <div class="row">

        <div class="card dash-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="dash-widget dct-border-rht">
                            <div class="circle-bar circle-bar1">
                                <div class="circle-graph1" data-percent="75">
                                    <img src="assets/img/total-icon.png" class="img-fluid" alt="patient">
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6>Total Visitor</h6>
                                <h3>{{$vcount}}</h3>
                                <p class="text-muted">Till Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="dash-widget dct-border-rht">
                            <div class="circle-bar circle-bar2">
                                <div class="circle-graph2" data-percent="65">
                                    <img src="assets/img/pending-icon.png" class="img-fluid" alt="Patient">
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6>New Application</h6>
                                <h3>{{$newCount}}</h3>
                                <p class="text-muted">Pending</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="card dash-card">

            <div class="card-body">
                <div class="text-center">
                    <h4>Graph: Last 15 days Visitor</h4>
                </div>
                <br>
                <canvas id="daysChart" style="width: 600px; height:200px"></canvas>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="card dash-card">

            <div class="card-body">
                <div class="text-center">
                    <h4>Graph: Department Vs Visitor</h4>
                </div>
                <br>
                <canvas id="myChart" style="width: 600px; height:200px"></canvas>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="card dash-card">

            <div class="card-body">
                <div class="text-center">
                    <h4>Graph: Reason Vs Visitor</h4>
                </div>
                <br>
                <canvas id="reasonChart" style="width: 600px; height:200px"></canvas>
            </div>
        </div>
    </div>





</div>


@section('js')

<script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        var chartData = @json($chartData);
        var reasonChartData = @json($reasonChartData);
        var daysChartData = @json($daysChartData);
    </script>


<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: '# of Visitors',
                data: chartData.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<!-- Visitor by reason Start-->

<script>
    var ctx = document.getElementById("reasonChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: reasonChartData.labels,
            datasets: [{
                label: '# of Visitors',
                data: reasonChartData.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<!-- DaysChart Start here -->

<script>
    var ctx = document.getElementById("daysChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: daysChartData.labels,
            datasets: [{
                label: '# of Visitors',
                data: daysChartData.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

@endsection


@endsection