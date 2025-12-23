@extends('admin.layouts.client')
@section('title', 'Thêm tour')
@section('content')

    <div class="container-fluid">
        <h3 class="mb-4">Thêm tour mới</h3>

        <form method="POST" action="{{ route('admin.tour.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Tên tour</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Thời gian</label>
                <input type="text" name="time" class="form-control" placeholder="VD: 3 ngày 2 đêm">
            </div>

            <div class="form-group">
                <label>Giá tour (VNĐ)</label>
                <input type="number" name="price" class="form-control">
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Ảnh tour</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>

            <button class="btn btn-success">Thêm mới</button>
            <a href="{{ route('admin.tour') }}" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>

@endsection