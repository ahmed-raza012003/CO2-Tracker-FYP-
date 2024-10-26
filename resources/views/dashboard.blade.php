@extends('layouts.dashboard')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <main class="col-lg-12 col-md-12">
            <!-- User Profile Section -->
        

            <!-- Performance Dashboard -->
            <h1 class="text-success text-center mb-4">Your Performance Dashboard</h1>
<div class="container mt-4">
    <div class="user-profile text-center mb-4 p-4 shadow-sm rounded" style="background-color: #E6F4EA;">
        <h3 class="text-success">Hello, {{ Auth::user()->name }}!</h3>
        <p class="text-muted mb-3">Your Recent Activities:</p>
        
        <!-- Recent Activities Subcards -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card card-hover" style="background-color: #A4D3A2;">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="fas fa-calculator"></i> Last Calculation</h5>
                        <p class="card-text text-muted">
                            @if ($lastFiveResults->count() > 0)
                                {{ number_format($lastFiveResults->first()->total_co2) }} g CO2
                            @else
                                No calculations found.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card card-hover" style="background-color: #A4D3A2;">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="fas fa-check-circle"></i> Last Completed Goal</h5>
                        <p class="card-text text-muted">
                            @if ($completedGoals > 0)
                                {{ $completedGoals }} goals achieved.
                            @else
                                No goals completed.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar Section -->
   
</div>



            <div class="row mb-4">
                <!-- Total CO2 Consumption Card -->
                <div class="col-lg-4 col-md-6 mb-4 d-flex">
                    <div class="card shadow border-0 rounded-lg flex-fill text-center card-hover">
                        <div class="card-header" style="background-color: #7CB47C;">
                            <h4 class="text-white">Total CO2 Consumption (g)</h4>
                        </div>
                        <div class="card-body">
                            <h2 class="text-white">{{ number_format($totalCO2) }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Completed Goals Card -->
                <div class="col-lg-4 col-md-6 mb-4 d-flex">
                    <div class="card shadow border-0 rounded-lg flex-fill text-center card-hover">
                        <div class="card-header" style="background-color: #7CB47C;">
                            <h4 class="text-white">Completed Goals</h4>
                        </div>
                        <div class="card-body">
                            <h2 class="text-white">{{ $completedGoals }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Total CO2 Reduced Card -->
                <div class="col-lg-4 col-md-6 mb-4 d-flex">
                    <div class="card shadow border-0 rounded-lg flex-fill text-center card-hover">
                        <div class="card-header" style="background-color: #7CB47C;">
                            <h4 class="text-white">Total CO2 Reduced (g)</h4>
                        </div>
                        <div class="card-body">
                            <h2 class="text-white">{{ number_format($totalReductions) }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last 5 CO2 Consumptions Charts -->
            <div class="row mb-4">
                <div class="col-lg-6 mb-4">
                    <h2 class="text-success text-center mb-4">Last 5 CO2 Consumptions</h2>
                    <div class="chart-container">
                        <canvas id="lastFiveCo2Chart"></canvas>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <h2 class="text-success text-center mb-4">Last CO2 Consumption</h2>
                    <div class="chart-container">
                        <canvas id="lastCo2Chart"></canvas>
                    </div>
                </div>
                <h2 class="text-success text-center mb-4">Consumption Comparison</h2>
                <div id="comparisonResult" class="text-center mb-4"></div>
            </div>
            <div class="progress-section text-center mb-4 p-4 shadow-sm rounded" style="background-color: #E6F4EA;">
                <h4 class="text-success">Goal Completion Progress</h4>
                <div class="progress mt-3" style="height: 40px; background-color: #B7E5B4;">
                    @php
                        // Calculate progress based on goals achieved (10% for each goal)
                        $goalProgress = min($completedGoals * 10, 100); // Cap it at 100%
                    @endphp
                    <div class="progress-bar" role="progressbar" style="width: {{ $goalProgress }}%; background-color: #28a745;" aria-valuenow="{{ $goalProgress }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $goalProgress }}% Goals Completed
                    </div>
                </div>
            </div>
            <!-- Consumption Comparison -->
          
        </main>
    </div>
</div>

<style>
    .user-profile {
        background-color: #E6F4EA;
    }
    
    .progress-section {
        background-color: #E6F4EA;
    }

    .card-title {
        font-size: 1.25rem;
    }

    .progress-bar {
        font-size: 1.5rem; /* Adjust font size */
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition for color and scaling */
    }

    .progress-bar:hover {
        background-color: #218838; /* Darker green on hover */
        transform: scale(1.05); /* Slightly increase size on hover */
    }
        .chart-container {
        width: 100%;
        padding: 20px;
        background-color: #C4E4C1;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease; /* Smooth transition for scaling */
    }

    .chart-container:hover {
        transform: scale(1.02); /* Slightly increase size on hover */
    }

    .card-hover {
        background-color: #A4D3A2;
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for transform and shadow */
    }

    .card-hover:hover {
        transform: scale(1.05); /* Slightly increase size on hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
    }

    .progress-bar {
        font-size: 1.5rem; /* Adjust font size */
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition for color and scaling */
    }

    .progress-bar:hover {
        background-color: #218838; /* Darker green on hover */
        transform: scale(1.05); /* Slightly increase size on hover */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lastFiveCtx = document.getElementById('lastFiveCo2Chart').getContext('2d');
        const lastCtx = document.getElementById('lastCo2Chart').getContext('2d');

        const results = @json($lastFiveResults);
        const lastFiveLabels = results.map(result => new Date(result.created_at).toLocaleDateString());
        const lastFiveValues = results.map(result => result.total_co2);
        const lastConsumption = results.length > 0 ? results[0].total_co2 : 0;

        createChart(lastFiveCtx, lastFiveLabels, lastFiveValues, 'Last 5 CO2 Consumptions (g)', 'bar', 'rgba(82, 204, 108, 0.6)');
        createChart(lastCtx, ['Last Consumption'], [lastConsumption], 'Last CO2 Consumption (g)', 'bar', 'rgba(46, 139, 87, 0.6)');

        compareLatestConsumption(results);

        function createChart(ctx, labels, data, label, chartType, backgroundColor) {
            new Chart(ctx, {
                type: chartType,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: 'rgba(34, 139, 34, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    animation: {
                        duration: 1000,
                        easing: 'easeOutBounce'
                    },
                    scales: {
                        x: { title: { display: true, text: 'Date' }},
                        y: { title: { display: true, text: 'CO2 (g)' }, beginAtZero: true }
                    },
                    plugins: { legend: { display: true, position: 'top' }}
                }
            });
        }

        function compareLatestConsumption(results) {
            if (results.length < 2) {
                document.getElementById('comparisonResult').innerHTML = "Not enough data for comparison.";
                return;
            }
            const latest = results[0].total_co2;
            const previous = results[1].total_co2;
            const comparisonResult = latest > previous 
                ? `Your latest consumption is ${latest - previous}g higher than your previous consumption.` 
                : `Your latest consumption is ${previous - latest}g lower than your previous consumption.`;

            document.getElementById('comparisonResult').innerHTML = `
                <div class="alert alert-info" role="alert">
                    ${comparisonResult}
                </div>
            `;
        }
    });
</script>
@endsection
