@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="row ">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Products</h5>
                                    <h2 class="mb-3 font-18">{{ number_format($productCount) }}</h2>
                                    <p class="mb-0">Total available</p>
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
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Services</h5>
                                    <h2 class="mb-3 font-18">{{ number_format($serviceCount) }}</h2>
                                    <p class="mb-0">Total offered</p>
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
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">New Messages</h5>
                                    <h2 class="mb-3 font-18">{{ number_format($unreadMessageCount) }}</h2>
                                    <p class="mb-0"><span class="{{ $unreadMessageCount > 0 ? 'text-danger' : 'text-success' }}">{{ $unreadMessageCount > 0 ? 'Action required' : 'All caught up' }}</span></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('admin-assets/assets/img/banner/3.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Total Visits</h5>
                                    <h2 class="mb-3 font-18">{{ number_format($totalVisitCount) }}</h2>
                                    <p class="mb-0">Across all time</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('admin-assets/assets/img/banner/4.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Traffic Overview (7 Days)</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.traffic.index') }}" class="btn btn-primary">Detailed Analysis</a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="dashboardTrafficChart"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Latest Messages</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                            @forelse($recentMessages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>
                                    @if($message->replied_at)
                                        <div class="badge badge-success">Replied</div>
                                    @else
                                        <div class="badge badge-warning">Pending</div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">No messages yet</td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var options = {
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
                data: @json($dailyTraffic->pluck('total_visits'))
            },
            {
                name: 'Unique Visitors',
                data: @json($dailyTraffic->pluck('unique_visitors'))
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
                categories: @json($dailyTraffic->pluck('date')),
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
                    text: "Visits"
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

        var chart = new ApexCharts(document.querySelector("#dashboardTrafficChart"), options);
        chart.render();
    });
</script>
@endpush
