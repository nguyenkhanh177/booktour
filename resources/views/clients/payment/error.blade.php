@extends('layouts.client')
@section('title', 'Thanh toán thất bại')
@section('content')
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">

                        {{-- ICON --}}
                        <div class="mb-4">
                            <i class="fas fa-times-circle text-danger" style="font-size: 90px;"></i>
                        </div>

                        {{-- TITLE --}}
                        <h2 class="text-danger font-weight-bold mb-3">
                            Thanh toán không thành công
                        </h2>

                        {{-- DESCRIPTION --}}
                        <p class="text-muted mb-4">
                            Rất tiếc, giao dịch của bạn chưa thể hoàn tất vào lúc này.
                            Vui lòng thử lại hoặc chọn phương án khác.
                        </p>

                        {{-- ALERT --}}
                        <div class="alert alert-warning border-0 small text-left mb-4">
                            <strong>Lưu ý:</strong>
                            <ul class="mb-0 pl-3">
                                <li>Kiểm tra lại số dư hoặc thông tin thẻ</li>
                                <li>Không đóng trình duyệt khi đang thanh toán</li>
                                <li>Nếu đã bị trừ tiền nhưng chưa có đơn hàng, hãy liên hệ hỗ trợ</li>
                            </ul>
                        </div>

                        {{-- ACTION BUTTONS --}}
                        <div class="d-grid gap-3">
                            <form action="{{route('createPayment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="customer_name" value="{{ $customer_name }}">
                                <input type="hidden" name="customer_email" value="{{ $customer_email }}">
                                <input type="hidden" name="total_price" value="{{ $total_price }}">
                                <button type="submit" class="btn btn-danger btn-lg">
                                    <i class="fa fa-undo"></i> Thử thanh toán lại
                                </button>
                            </form>

                            <a href="{{ route('client.home') }}" class="btn btn-outline-primary">
                                <i class="fa fa-home"></i> Quay về trang chủ
                            </a>

                            <a href="" class="btn btn-outline-secondary">
                                <i class="fa fa-headset"></i> Liên hệ hỗ trợ
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection