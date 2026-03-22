@extends('layouts.admin')

@section('title', 'Traffic Analysis')

@section('content')
<section class="section">
    <div class="row ">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Total Visits</h5>
                                    <h2 class="mb-3 font-18">{{ number_format($totalVisits) }}</h2>
                                    <p class="mb-0">All time tracked visits</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('admin-assets/assets/img/banner/1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Unique Visitors</h5>
                                    <h2 class="mb-3 font-18">{{ number_format($uniqueVisitors) }}</h2>
                                    <p class="mb-0">Based on unique IP addresses</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('admin-assets/assets/img/banner/2.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Traffic Overview</h4>
                    <div class="card-header-action">
                        <ul class="nav nav-pills" id="trafficTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="thirty-days-tab" data-toggle="tab" href="#thirty-days" role="tab"
                                    aria-controls="thirty-days" aria-selected="true">Last 30 Days</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="all-time-tab" data-toggle="tab" href="#all-time" role="tab"
                                    aria-controls="all-time" aria-selected="false">All Time</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="trafficTabContent">
                        <div class="tab-pane fade show active" id="thirty-days" role="tabpanel" aria-labelledby="thirty-days-tab">
                            <div id="trafficChart30"></div>
                        </div>
                        <div class="tab-pane fade" id="all-time" role="tabpanel" aria-labelledby="all-time-tab">
                            <div id="trafficChartAll"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Top 10 Most Visited Pages</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>#</th>
                                <th>Path</th>
                                <th>Visits</th>
                            </tr>
                            @foreach($topPages as $index => $page)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>/{{ $page->path }}</td>
                                <td>{{ number_format($page->count) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Visits</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>Time</th>
                                <th>IP</th>
                                <th>Path</th>
                            </tr>
                            @foreach($recentVisits as $visit)
                            <tr>
                                <td>{{ $visit->created_at->diffForHumans() }}</td>
                                <td>{{ $visit->ip }}</td>
                                <td>/{{ $visit->path }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    #trafficChart30, #trafficChartAll {
        min-height: 350px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Last 30 Days Chart
        var options30 = {
            chart: {
                height: 350,
                type: "line",
                shadow: {
                    enabled: true,
                    color: "#000",
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 1
                },
                toolbar: {
                    show: false
                }
            },
            colors: ["#786BED", "#999b9c"],
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: "smooth"
            },
            series: [{
                name: 'Total Visits',
                data: @json($dailyData->pluck('total_visits'))
            },
            {
                name: 'Unique Visitors',
                data: @json($dailyData->pluck('unique_visitors'))
            }],
            grid: {
                borderColor: "#e7e7e7",
                row: {
                    colors: ["#f3f3f3", "transparent"],
                    opacity: 0.0
                }
            },
            markers: {
                size: 6
            },
            xaxis: {
                categories: @json($dailyData->pluck('date')),
                type: 'datetime',
                labels: {
                    format: 'dd MMM',
                    style: {
                        colors: "#9aa0ac"
                    }
                }
            },
            yaxis: {
                title: {
                    text: "Traffic"
                },
                labels: {
                    style: {
                        colors: "#9aa0ac"
                    }
                }
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy'
                },
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        };

        var chart30 = new ApexCharts(document.querySelector("#trafficChart30"), options30);
        chart30.render();

        // All Time Chart (Monthly)
        var optionsAll = {
            chart: {
                height: 350,
                type: "line",
                shadow: {
                    enabled: true,
                    color: "#000",
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 1
                },
                toolbar: {
                    show: false
                }
            },
            colors: ["#786BED", "#999b9c"],
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: "smooth"
            },
            series: [{
                name: 'Total Visits',
                data: @json($allTimeData->pluck('total_visits'))
            },
            {
                name: 'Unique Visitors',
                data: @json($allTimeData->pluck('unique_visitors'))
            }],
            grid: {
                borderColor: "#e7e7e7",
                row: {
                    colors: ["#f3f3f3", "transparent"],
                    opacity: 0.0
                }
            },
            markers: {
                size: 6
            },
            xaxis: {
                categories: @json($allTimeData->pluck('month')),
                type: 'category',
                labels: {
                    rotate: -45,
                    style: {
                        colors: "#9aa0ac"
                    }
                }
            },
            yaxis: {
                title: {
                    text: "Traffic"
                },
                labels: {
                    style: {
                        colors: "#9aa0ac"
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                floating: true,
                offsetY: -25,
                offsetX: -5
            }
        };

        var chartAll = new ApexCharts(document.querySelector("#trafficChartAll"), optionsAll);
        chartAll.render();

        // Fix chart rendering in hidden tabs
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            window.dispatchEvent(new Event('resize'));
        });
    });
</script>
@endpush
