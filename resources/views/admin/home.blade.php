@extends('admin.layouts.client')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 m-b-30">
            <div class="card stat-card bg-grad-purple">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1">Tổng Người dùng</p>
                            <h3 class="mb-0">{{ number_format($totalUsers) }}</h3>
                        </div>
                        <div class="icon-shape"><i class="ti ti-user"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 m-b-30">
            <div class="card stat-card bg-grad-blue">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1">Tổng lượt đặt</p>
                            <h3 class="mb-0">{{ number_format($totalBookings) }}</h3>
                        </div>
                        <div class="icon-shape"><i class="ti ti-shopping-cart"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 m-b-30">
            <div class="card stat-card bg-grad-orange">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1">Chờ xác nhận</p>
                            <h3 class="mb-0">{{ $pendingBookings }}</h3>
                        </div>
                        <div class="icon-shape"><i class="ti ti-timer"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 m-b-30">
            <div class="card stat-card bg-grad-green">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="mb-1">Doanh thu</p>
                            <h3 class="mb-0">{{ number_format($totalRevenue) }} đ</h3>
                        </div>
                        <div class="icon-shape"><i class="ti ti-money"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4">
                    <h4><i class="ti ti-bar-chart text-primary"></i> Lượt đặt Tour 7 ngày qua</h4>
                </div>
                <div class="card-body">
                    <canvas id="bookingChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('bookingChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($days) !!},
            datasets: [{
                label: 'Số lượng đặt Tour',
                data: {!! json_encode($bookingCounts) !!},
                borderColor: '#2575fc',
                backgroundColor: 'rgba(37, 117, 252, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4, // Tạo độ cong cho đường kẻ
                pointRadius: 5,
                pointBackgroundColor: '#2575fc'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection