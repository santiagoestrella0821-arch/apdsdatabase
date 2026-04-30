@extends('layouts.admin')

@section('content')

<h4 class="mb-4">Dashboard Overview</h4>

<div class="row">

    <!-- PLI -->
    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h6>Total PLI</h6>
            <h2>{{ \App\Models\PLI::count() }}</h2>
        </div>
    </div>

    <!-- Verifier -->
    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h6>Total Verifiers</h6>
            <h2>0</h2>
        </div>
    </div>

    <!-- Coverage -->
    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h6>Total Coverage</h6>
            <h2>0</h2>
        </div>
    </div>

    <!-- Transactions -->
    <div class="col-md-3">
        <div class="card shadow-sm p-3">
            <h6>Transactions</h6>
            <h2>0</h2>
        </div>
    </div>

</div>

<!-- CHARTS -->
<div class="row mt-4">

    <!-- BAR CHART -->
    <div class="col-md-6">
        <div class="card p-3">
            <h6>PLI Distribution</h6>
            <canvas id="barChart"></canvas>
        </div>
    </div>

    <!-- LINE CHART -->
    <div class="col-md-6">
        <div class="card p-3">
            <h6>Coverage Trend</h6>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {

    // BAR CHART
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Region 1', 'Region 2', 'Region 3'],
            datasets: [{
                label: 'PLI Count',
                data: [5, 8, 3],
                backgroundColor: '#0d6efd'
            }]
        }
    });

    // LINE CHART
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr'],
            datasets: [{
                label: 'Coverage',
                data: [10, 20, 15, 30],
                borderColor: '#198754',
                fill: false
            }]
        }
    });

});
</script>