@extends('admin.layouts.client')
@section('title', 'Thêm hotel')
@section('content')

    <div class="container-fluid">
        <h3 class="mb-4">Thêm hotel mới</h3>

        <form method="POST" action="{{ route('admin.hotel.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Tên hotel</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label>Giá hotel (VNĐ)</label>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="form-group">
                <label>Ảnh hotel</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group">
                <label>Sđt</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>

            <button class="btn btn-success">Thêm mới</button>
            <a href="{{ route('admin.hotel') }}" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>

@endsection