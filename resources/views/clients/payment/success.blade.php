@extends('layouts.client')
@section('title', 'Thanh toán thành công')
@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    
                    <h2 class="text-success mb-3">Thanh Toán Thành Công!</h2>
                    <p class="text-muted">Cảm ơn bạn đã tin tưởng dịch vụ của chúng tôi. Đơn hàng của bạn đã được xác nhận thành công.</p>
                    
                    <div class="bg-light p-4 rounded-3 mb-4 text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Mã giao dịch:</span>
                            <strong>#{{ request()->vnp_TransactionNo }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Mã đơn hàng:</span>
                            <strong>{{ request()->vnp_TxnRef }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Số tiền:</span>
                            <strong class="text-primary">{{ number_format(request()->vnp_Amount / 100, 0, ',', '.') }} VNĐ</strong>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('bookingHistory') }}" class="btn btn-primary btn-lg">Xem Tour của tôi</a>
                        <a href="{{ route('client.home') }}" class="btn btn-outline-secondary">Quay về Trang chủ</a>
                    </div>
                </div>
            </div>
            <p class="mt-4 text-muted small">Một email xác nhận đã được gửi đến địa chỉ của bạn.</p>
        </div>
    </div>
</div>
@endsection