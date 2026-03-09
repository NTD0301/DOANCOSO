@extends('layouts.admin')

@section('title', 'Bảng điều khiển')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary h-100">
                <div class="card-body">
                    <p class="mb-1">Sản phẩm</p>
                    <h3 class="fw-bold">{{ $stats['products'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success h-100">
                <div class="card-body">
                    <p class="mb-1">Đơn hàng</p>
                    <h3 class="fw-bold">{{ $stats['orders'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <p class="mb-1">Người dùng</p>
                    <h3 class="fw-bold">{{ $stats['users'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger h-100">
                <div class="card-body">
                    <p class="mb-1">Doanh thu</p>
                    <h3 class="fw-bold">{{ number_format($stats['revenue'], 0, ',', '.') }} đ</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card h-100">
                <div class="card-header">Doanh thu 6 tháng gần nhất</div>
                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb-4">
            <div class="card h-100">
                <div class="card-header">Đơn hàng mới</div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Khách hàng</th>
                                <th>Tổng</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->full_name }}</td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                                    <td><span class="badge text-bg-secondary">{{ $order->status }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
const ctx = document.getElementById('revenueChart');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($chartData['labels']),
        datasets: [{
            label: 'Doanh thu (VND)',
            data: @json($chartData['values']),
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,0.1)',
            tension: 0.3,
            fill: true,
        }]
    }
});
</script>
@endpush
