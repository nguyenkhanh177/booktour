@extends('admin.layouts.client')
@section('title', 'Cập nhật menu')
@section('content')

    <div class="container-fluid">
        <h3 class="mb-4">Cập nhật menu</h3>

        <form method="POST" action="{{ route('admin.menu.update', $menus->id) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên menu</label>
                <input type="text" name="name" class="form-control" value="{{ $menus->name }}" required>
            </div>
            <div class="form-group">
                <label>Thứ tự</label>
                <input type="text" name="order" class="form-control" value="{{ $menus->order }}" required>
            </div>
            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $menus->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ $menus->status == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>

            <button class="btn btn-success">Cập nhật</button>
            <a href="{{ route('admin.menu') }}" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>

@endsection