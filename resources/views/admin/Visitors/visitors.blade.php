@extends('admin.layout.main')
@push('title')
    <title>Visitors</title>
@endpush
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Visitors</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                

                

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $todayVisitors }}</h3>
                            <p>Today's Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $yesterdayVisitors }}</h3>
                            <p>Yesterday's Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $weekVisitors }}</h3>
                            <p>This Week's Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $monthVisitors }}</h3>
                            <p>This Month's Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        
                    </div>
                </div>

                

            </div>
            <div class="row">

                <div class="col-md-4">
                    <h3>All Visitors</h3>

                    <canvas id="visitorChart"></canvas>
                </div>
                <div class="col-md-4">
                    <h3>Monthly Visitors</h3>
                    <canvas id="monthlyVisitorChart"></canvas>
                </div>
                <div class="col-md-4">
                    <h3>Yearly Visitors</h3>
                    <canvas id="yearlyVisitorChart"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('visitorChart').getContext('2d');
    const visitorChart = new Chart(ctx, {
        type: 'bar', // Change to 'line' for a line chart
        data: {
            labels: ['Today', 'Yesterday', 'This Week', 'This Month'],
            datasets: [{
                label: 'Visitors Count',
                data: [{{ $todayVisitors }}, {{ $yesterdayVisitors }}, {{ $weekVisitors }}, {{ $monthVisitors }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Monthly Visitors Data
    const monthlyLabels = @json($monthlyVisitors->pluck('month'));
    const monthlyData = @json($monthlyVisitors->pluck('total'));

    const monthlyVisitorCtx = document.getElementById('monthlyVisitorChart').getContext('2d');
    new Chart(monthlyVisitorCtx, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Monthly Visitors',
                data: monthlyData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Yearly Visitors Data
    const yearlyLabels = @json($yearlyVisitors->pluck('year'));
    const yearlyData = @json($yearlyVisitors->pluck('total'));

    const yearlyVisitorCtx = document.getElementById('yearlyVisitorChart').getContext('2d');
    new Chart(yearlyVisitorCtx, {
        type: 'line',
        data: {
            labels: yearlyLabels,
            datasets: [{
                label: 'Yearly Visitors',
                data: yearlyData,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection


