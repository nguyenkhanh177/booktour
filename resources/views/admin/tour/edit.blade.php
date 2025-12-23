@extends('admin.layouts.client')
@section('title', 'Cập nhật tour')
@section('content')

    <div class="container-fluid">
        <h3 class="mb-4">Cập nhật tour</h3>

        <form method="POST" action="{{ route('admin.tour.update', $tours->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên tour</label>
                <input type="text" name="name" class="form-control" value="{{ $tours->name }}" required>
            </div>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ $tours->title }}" required>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ $tours->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ $tours->address }}">
            </div>
            <div class="form-group">
                <label>Thời gian</label>
                <input type="text" name="time" class="form-control" value="{{ $tours->time }}"
                    placeholder="VD: 3 ngày 2 đêm">
            </div>
            <div class="form-group">
                <label>Giá tour (VNĐ)</label>
                <input type="number" name="price" class="form-control" value="{{ $tours->price }}">
            </div>
            <div class="form-group">
                <label>Ảnh tour</label>
                <input type="file" name="image" class="form-control">

                @if($tours->image)
                    <img src="{{ asset('uploads/tours/' . $tours->image) }}" class="mt-2" width="120">
                @endif
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $tours->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $tours->status == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <button class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.tour') }}" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>

@endsection