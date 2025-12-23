@extends('admin.layouts.client')
@section('title', 'Cập nhật restaurant')
@section('content')

    <div class="container-fluid">
        <h3 class="mb-4">Cập nhật restaurant</h3>

        <form method="POST" action="{{ route('admin.restaurant.update', $restaurants->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên restaurant</label>
                <input type="text" name="name" class="form-control" value="{{ $restaurants->name }}" required>
            </div>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ $restaurants->title }}" required>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ $restaurants->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ $restaurants->address }}">
            </div>
            <div class="form-group">
                <label>Giá restaurant (VNĐ)</label>
                <input type="number" name="price" class="form-control" value="{{ $restaurants->price }}">
            </div>
            <div class="form-group">
                <label>Ảnh restaurant</label>
                <input type="file" name="image" class="form-control">

                @if($restaurants->image)
                    <img src="{{ asset('uploads/restaurants/' . $restaurants->image) }}" class="mt-2" width="120">
                @endif
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $restaurants->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $restaurants->status == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <button class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.restaurant') }}" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>

@endsection