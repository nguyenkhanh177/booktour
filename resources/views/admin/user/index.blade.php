@extends('admin.layouts.client')
@section('title', 'Quản lý người dùng')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Danh sách người dùng</h5>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            <th>Họ tên </th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th>Ngày tham gia</th>
                            <th>Ngày cập nhật</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div>{{ $user->name }}</div>
                                    <small>@ {{ $user->username }}</small>
                                </td>
                                <td>{{ $user->email }}</td>
                               <td>
                                    <form action="{{ route('admin.user.updateRole', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" onchange="this.form.submit()"
                                            class="form-control form-control-sm fw-bold border-0 bg-light
                                            {{ $user->role == 'admin' ? 'text-danger' : ($user->role == 'customer' ? 'text-info' : 'text-primary') }}"
                                            style="cursor: pointer; width: auto; display: inline-block;">
                                            
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                                            
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    @if($user->status)
                                        <span class="text-success"><span class="status-dot bg-success"></span> Hoạt động</span>
                                    @else
                                        <span class="text-danger"><span class="status-dot bg-danger"></span> Bị khóa</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        {{-- <a href="{{ route('admin.user.detail', $user->id) }}"
                                            class="btn btn-light btn-sm text-info mx-1" title="Xem chi tiết">
                                            <i class="ti ti-eye"></i> Chi tiết
                                        </a> --}}
                                        <form action="{{ route('admin.user.toggleStatus', $user->id) }}" method="POST"
                                            style="display:inline">
                                            @csrf
                                            @method('PATCH')
                                            @if($user->status)
                                                <button type="submit" class="btn btn-light btn-sm text-danger mx-1"
                                                    title="Khóa tài khoản"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?')">
                                                    <i class="ti ti-lock"></i> Khóa
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-light btn-sm text-success mx-1"
                                                    title="Mở khóa tài khoản">
                                                    <i class="ti ti-lock-open"></i> Mở khóa
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection