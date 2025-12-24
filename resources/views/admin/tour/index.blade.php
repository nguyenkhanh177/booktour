@extends('admin.layouts.client')
@section('title', 'TourAdmin')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Quản lý Tour</h3>
            <a href="{{ route('admin.tour.create') }}" class="btn btn-primary">
                + Thêm tour
            </a>
        </div>

        <!-- TABLE -->
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tên tour</th>
                            <th>Thời gian</th>
                            <th>Địa chỉ</th>
                            <th>Giá</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Trạng thái</th>
                            <th width="150">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($tours as $tour)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tour->name }}</td>
                                <td>{{ $tour->time }}</td>
                                <td>{{ $tour->address }}</td>
                                <td>{{ number_format($tour->price) }} VNĐ</td>
                                <td>{{ $tour->created_at }}</td>
                                <td>{{ $tour->updated_at }}</td>
                                <td>
                                    @if($tour->status)
                                        <span class="badge badge-success">Hiển thị</span>
                                    @else
                                        <span class="badge badge-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.tour.edit', $tour->id) }}" class="btn btn-sm btn-warning">
                                        Sửa
                                    </a>

                                    <form action="{{ route('admin.tour.destroy', $tour->id) }}" method="POST"
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
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                {{-- Nút quay lại --}}
                                @if ($tours->onFirstPage())
                                    <li class="disabled d-inline-block"><span>&lt;</span></li>
                                @else
                                    <li class="d-inline-block"><a href="{{ $tours->previousPageUrl() }}">&lt;</a></li>
                                @endif
                                {{-- Danh sách các số trang --}}
                                @foreach ($tours->getUrlRange(1, $tours->lastPage()) as $page => $url)
                                    <li class="{{ ($page == $tours->currentPage()) ? 'active' : '' }} d-inline-block">
                                        <a href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach
                                {{-- Nút tiếp theo --}}
                                @if ($tours->hasMorePages())
                                    <li class="d-inline-block"><a href="{{ $tours->nextPageUrl() }}">&gt;</a></li>
                                @else
                                    <li class="disabled d-inline-block"><span>&gt;</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection