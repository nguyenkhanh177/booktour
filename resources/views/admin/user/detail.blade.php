@extends('admin.layouts.client')
@section('title', 'Chi tiết người dùng')
@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0" style="border-radius: 15px;">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Chi tiết người dùng</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vai trò</label>
                            <input type="text" class="form-control" value="{{ $user->role }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" value="{{ $user->status ? 'Hoạt động' : 'Bị khóa' }}"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ngày tham gia</label>
                            <input type="text" class="form-control" value="{{ $user->created_at->format('d/m/Y') }}"
                                readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection