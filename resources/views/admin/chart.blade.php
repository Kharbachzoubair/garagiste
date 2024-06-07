@extends('layouts.master')

@section('title', 'Charts')

@section('content')
<div class="container">
    <h1>Direction Chart</h1>
    <canvas id="directionChart" width="400" height="200"></canvas>
    
    <h1>Equipment Age Pyramid</h1>
    <canvas id="equipmentAgePyramid" width="400" height="200"></canvas>
    
    <h1>Equipment Type: BUREAU PORTABLE STATION</h1>
    <canvas id="equipmentTypeChart" width="400" height="200"></canvas>
    
    <h1>Equipment Distribution by Site Geo</h1>
    <canvas id="equipmentSiteGeoChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var directionLabels = {!! json_encode($directionLabels) !!};
        var directionCounts = {!! json_encode($directionCounts) !!};

        var equipmentAgeLabels = {!! json_encode($equipmentAgeLabels) !!};
        var equipmentAgeData = {!! json_encode($equipmentAgeData) !!};

        var equipmentTypeLabels = {!! json_encode(array_keys($equipmentTypes)) !!};
        var equipmentTypeData = {!! json_encode(array_values($equipmentTypes)) !!};

        var equipmentSiteGeoLabels = {!! json_encode(array_keys($equipmentSiteGeo)) !!};
        var equipmentSiteGeoData = {!! json_encode(array_values($equipmentSiteGeo)) !!};

        var ctxDirection = document.getElementById('directionChart').getContext('2d');
        var directionChart = new Chart(ctxDirection, {
            type: 'bar',
            data: {
                labels: directionLabels,
                datasets: [{
                    label: 'Number of Persons',
                    data: directionCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxEquipmentAge = document.getElementById('equipmentAgePyramid').getContext('2d');
        var equipmentAgePyramid = new Chart(ctxEquipmentAge, {
            type: 'bar',
            data: {
                labels: equipmentAgeLabels,
                datasets: [{
                    label: 'Equipment Age',
                    data: equipmentAgeData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Equipment Age Pyramid'
                    }
                }
            }
        });

        var ctxEquipmentType = document.getElementById('equipmentTypeChart').getContext('2d');
        var equipmentTypeChart = new Chart(ctxEquipmentType, {
            type: 'bar',
            data: {
                labels: equipmentTypeLabels,
                datasets: [{
                    label: 'Equipment Type Count',
                    data: equipmentTypeData,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Equipment Type Count'
                    }
                }
            }
        });

        var ctxEquipmentSiteGeo = document.getElementById('equipmentSiteGeoChart').getContext('2d');
        var equipmentSiteGeoChart = new Chart(ctxEquipmentSiteGeo, {
            type: 'bar',
            data: {
                labels: equipmentSiteGeoLabels,
                datasets: [{
                    label: 'Equipment Distribution by Site Geo',
                    data: equipmentSiteGeoData,
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Equipment Distribution by Site Geo'
                    }
                }
            }
        });
    });
</script>

@endsection
