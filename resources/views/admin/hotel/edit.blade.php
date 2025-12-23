@extends('admin.layouts.client')
@section('title', 'Cập nhật hotel')
@section('content')

    <div class="container-fluid">
        <h3 class="mb-4">Cập nhật hotel</h3>

        <form method="POST" action="{{ route('admin.hotel.update', $hotels->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên hotel</label>
                <input type="text" name="name" class="form-control" value="{{ $hotels->name }}" required>
            </div>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ $hotels->title }}" required>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ $hotels->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ $hotels->address }}">
            </div>
            <div class="form-group">
                <label>Giá hotel (VNĐ)</label>
                <input type="number" name="price" class="form-control" value="{{ $hotels->price }}">
            </div>
            <div class="form-group">
                <label>Ảnh hotel</label>
                <input type="file" name="image" class="form-control">

                @if($hotels->image)
                    <img src="{{ asset('uploads/hotels/' . $hotels->image) }}" class="mt-2" width="120">
                @endif
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $hotels->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $hotels->status == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <button class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.hotel') }}" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>

@endsection