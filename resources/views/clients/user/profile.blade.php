@extends('layouts.client')
@section('title', 'Profile')
@section('content')
    <div class="header-status-bar"
        style="background: linear-gradient(to bottom, rgba(238, 61, 61, 0.8) 0%, rgba(238, 61, 61, 0.6) 100%); height: 100px;"></div>

    <section class="hero-wrap-2" style="background-color: #f8f9fa; padding: 40px 0; border-bottom: 1px solid #eee;">
        <div class="container text-center">
            <p class="breadcrumbs mb-2"
                style="text-transform: uppercase; font-size: 12px; letter-spacing: 2px; color: #999;">
                <a href="/">Trang chủ</a> / <span>Profile</span>
            </p>
            <h1 class="mb-0 bread fw-bold" style="text-transform: uppercase; letter-spacing: 5px; color: #222;">Thông tin cá nhân</h1>
        </div>
    </section>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 text-center p-4 rounded-4">
                    <div class="position-relative d-inline-block mx-auto mb-3">
                        <img id="preview-image"
                            src="{{ $user->image ? asset('storage/' . $user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                            class="rounded-circle shadow-sm"
                            style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #fff;">
                    </div>
                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-muted small">@ {{ $user->username }}</p>
                    <hr class="my-4">
                    <div class="text-start">
                        <p class="small text-muted mb-1">Ngày tham gia:
                            <strong>{{ $user->created_at->format('d/m/Y') }}</strong></p>
                        <p class="small text-muted mb-0">Trạng thái:
                            <span class="{{ $user->status ? 'text-success' : 'text-danger' }}">
                                {{ $user->status ? '● Hoạt động' : '● Đã khóa' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h4 class="fw-bold text-uppercase mb-1" style="letter-spacing: 1px; color: #222;">
                                Cấu hình
                            </h4>

                            <p class="text-muted small mb-0">
                                <i class="fa fa-info-circle me-1"></i>
                                Mật khẩu để trống nếu không muốn thay đổi
                            </p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success border-0 small">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Họ và tên</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $user->email) }}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label small fw-bold">Thay đổi ảnh đại diện</label>
                                    <input type="file" name="image" class="form-control" onchange="previewFile(this)">
                                </div>

                                <hr class="my-4">


                                <div class="col-12">
                                    <label class="form-label small fw-bold">Mật khẩu hiện tại</label>
                                    <input type="password" name="current_password" class="form-control"
                                        placeholder="Nhập mật khẩu cũ">
                                    @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Mật khẩu mới</label>
                                    <input type="password" name="new_password" class="form-control"
                                        placeholder="Tối thiểu 8 ký tự">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Xác nhận mật khẩu mới</label>
                                    <input type="password" name="new_password_confirmation" class="form-control"
                                        placeholder="Nhập lại mật khẩu mới">
                                </div>

                                <div class="col-12 mt-4 text-end">
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill">Lưu thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    document.getElementById("preview-image").src = reader.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection