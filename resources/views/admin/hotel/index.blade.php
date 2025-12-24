@extends('admin.layouts.client')
@section('title', 'Quản lý Hotel')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Quản lý Hotel</h3>
            <a href="{{ route('admin.hotel.create') }}" class="btn btn-primary">
                + Thêm hotel
            </a>
        </div>

        <!-- TABLE -->
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tên hotel</th>
                            <th>Địa chỉ</th>
                            <th>Giá</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Trạng thái</th>
                            <th width="150">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($hotels as $hotel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $hotel->name }}</td>
                                <td>{{ $hotel->address }}</td>
                                <td>{{ number_format($hotel->price) }} VNĐ</td>
                                <td>{{ $hotel->created_at }}</td>
                                <td>{{ $hotel->updated_at }}</td>
                                <td>
                                    @if($hotel->status)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.hotel.edit', $hotel->id) }}" class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>

                                    <form action="{{ route('admin.hotel.destroy', $hotel->id) }}" method="POST"
                                        style="display:inline-block"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa tour này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection