@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
    <h1 class="text-center text-success display-4 mb-5 animate__animated animate__fadeInDown">🌱 Your Goals</h1>

    <!-- Toastr notification -->
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    <div class="row mb-5 align-items-stretch">
        <!-- Goal creation form -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg h-100" style="background-color: #C4E4C1;">
                <div class="card-header" style="background-color: #7CB47C;">
                    <h2 class="mb-0 text-white">Set a New Goal</h2>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('goals.create') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" name="goal" id="goal" class="form-control" placeholder="e.g., Reduce CO2" required>
                            <label for="goal">Goal</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="target_co2" id="target_co2" class="form-control" placeholder="e.g., 1000" required>
                            <label for="target_co2">Target CO2 (g)</label>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100 shadow">🌍 Add Goal</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Graph section -->
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg h-100" style="background-color: #C4E4C1;">
                <div class="card-header" style="background-color: #7CB47C;">
                    <h2 class="mb-0 text-white">🌟 Your Progress Overview</h2>
                </div>
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="chart-container flex-grow-1">
                        <canvas id="goalStatusChart" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Display tracking section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #C4E4C1;">
                <div class="card-header" style="background-color: #7CB47C;">
                    <h2 class="mb-0 text-white">🌟 Your Goals Status</h2>
                </div>
                <div class="card-body p-4">
                    <table class="table table-hover table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Goal</th>
                                <th scope="col">Target CO2 (g)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Achieved</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($goals as $goal)
                                @if ($goal->status !== 'Achieved') <!-- Only display goals that are not achieved -->
                                    <tr style="background-color: #C4E4C1;" onmouseover="this.style.backgroundColor='#B3E5B3';" onmouseout="this.style.backgroundColor='#C4E4C1';">
                                        <td class="text-start">{{ $goal->goal }}</td>
                                        <td>{{ $goal->target_co2 }}</td>
                                        <td>
                                            <span class="badge 
                                                @if ($goal->status == 'Achieved') bg-success
                                                @elseif ($goal->status == 'In Progress') bg-warning
                                                @else bg-danger @endif
                                            ">
                                                {{ $goal->status }}
                                            </span>
                                        </td>
                                        <td>{{ $goal->achieved_at ? \Carbon\Carbon::parse($goal->achieved_at)->format('Y-m-d') : 'N/A' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Achieved Goals Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-lg" style="background-color: #C4E4C1;">
                <div class="card-header" style="background-color: #7CB47C;">
                    <h2 class="mb-0 text-white">🏆 Achieved Goals</h2>
                </div>
                <div class="card-body p-4">
                    <table class="table table-hover table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Goal</th>
                                <th scope="col">Target CO2 (g)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date Achieved</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($goals as $goal)
                                @if ($goal->status === 'Achieved') <!-- Only display achieved goals -->
                                    <tr style="background-color: #C4E4C1;" onmouseover="this.style.backgroundColor='#B3E5B3';" onmouseout="this.style.backgroundColor='#C4E4C1';">
                                        <td class="text-start">{{ $goal->goal }}</td>
                                        <td>{{ $goal->target_co2 }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                {{ $goal->status }}
                                            </span>
                                        </td>
                                        <td>{{ $goal->achieved_at ? \Carbon\Carbon::parse($goal->achieved_at)->format('Y-m-d') : 'N/A' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest CO2 consumption alert -->
    @if ($latestResult)
        <div class="alert alert-info text-center mt-5 animate__animated animate__fadeIn">
            <h4 class="alert-heading">🚨 Latest CO2 Consumption</h4>
            <p>{{ $latestResult->total_co2 }} g</p>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctxGoals = document.getElementById('goalStatusChart').getContext('2d');

        // Data for goal statuses
        const goalStatusData = {
            labels: ['Achieved', 'In Progress', 'Reduce it'],
            datasets: [{
                data: [{{ $completedGoals }}, {{ $inProgressGoals }}, {{ $notAchievedGoals }}],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.6)', // Achieved (Green)
                    'rgba(255, 193, 7, 0.6)', // In Progress (Orange)
                    'rgba(220, 53, 69, 0.6)'  // Reduce it (Red)
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)', // Achieved
                    'rgba(255, 193, 7, 1)', // In Progress
                    'rgba(220, 53, 69, 1)'  // Reduce it
                ],
                borderWidth: 2,
            }]
        };

        // Create the doughnut chart
        new Chart(ctxGoals, {
            type: 'doughnut',
            data: goalStatusData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Goal Status Overview',
                        font: {
                            size: 24,
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    });
</script>
<style>
      .table th{
        background-color: #7CB47C;
        color: #ffffff;
    }
</style>
@endsection
