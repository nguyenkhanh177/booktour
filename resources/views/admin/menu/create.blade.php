@extends('admin.layouts.client')
@section('title', 'Thêm menu')
@section('content')

    <div class="container-fluid">
        <h3 class="mb-4">Thêm menu mới</h3>

        <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Tên menu</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Thứ tự</label>
                <input type="number" name="order" class="form-control">
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>

            <button class="btn btn-success">Thêm mới</button>
            <a href="{{ route('admin.menu') }}" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>
@endsection