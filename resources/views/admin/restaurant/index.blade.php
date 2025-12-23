@extends('admin.layouts.client')
@section('title', 'RestaurantAdmin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Quản lý Restaurant</h3>
            <a href="{{ route('admin.restaurant.create') }}" class="btn btn-primary">
                + Thêm restaurant
            </a>
        </div>

        <!-- TABLE -->
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tên restaurant</th>
                            <th>Giá</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Trạng thái</th>
                            <th width="150">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($restaurants as $restaurant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $restaurant->name }}</td>
                                <td>{{ number_format($restaurant->price) }} VNĐ</td>
                                <td>{{ $restaurant->created_at }}</td>
                                <td>{{ $restaurant->updated_at }}</td>
                                <td>
                                    @if($restaurant->status)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.restaurant.edit', $restaurant->id) }}"
                                        class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>

                                    <form action="{{ route('admin.restaurant.destroy', $restaurant->id) }}" method="POST"
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