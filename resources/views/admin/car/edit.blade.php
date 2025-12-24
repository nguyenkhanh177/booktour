@extends('admin.layouts.client')
@section('title', 'Cập nhật car')
@section('content')

    <div class="container-fluid">
        <h3 class="mb-4">Cập nhật car</h3>

        <form method="POST" action="{{ route('admin.car.update', $cars->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên car</label>
                <input type="text" name="name" class="form-control" value="{{ $cars->name }}" required>
            </div>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ $cars->title }}" required>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ $cars->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ $cars->address }}">
            </div>
            <div class="form-group">
                <label>Giá car (VNĐ)</label>
                <input type="number" name="price" class="form-control" value="{{ $cars->price }}">
            </div>
            <div class="form-group">
                <label>Ảnh car</label>
                <input type="file" name="image" class="form-control">

                @if($cars->image)
                    <img src="{{ asset('uploads/cars/' . $cars->image) }}" class="mt-2" width="120">
                @endif
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $cars->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $cars->status == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <button class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.car') }}" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>

@endsection