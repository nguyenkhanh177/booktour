@extends('admin.layouts.client')
@section('title', 'CarAdmin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Quản lý Car</h3>
            <a href="{{ route('admin.car.create') }}" class="btn btn-primary">
                + Thêm xe
            </a>
        </div>

        <!-- TABLE -->
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tên car</th>
                            <th>Giá</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Trạng thái</th>
                            <th width="150">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($cars as $car)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $car->name }}</td>
                                <td>{{ number_format($car->price) }} VNĐ</td>
                                <td>{{ $car->created_at }}</td>
                                <td>{{ $car->updated_at }}</td>
                                <td>
                                    @if($car->status)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.car.edit', $car->id) }}" class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>

                                    <form action="{{ route('admin.car.destroy', $car->id) }}" method="POST"
                                        style="display:inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa car này?')">
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