<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class UserAdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("admin.user.index", compact("users"));
    }
    public function detail($id)
    {
        $user = User::findOrFail($id);
        return view("admin.user.detail", compact("user"));
    }
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status; // Đảo ngược trạng thái 0 thành 1 và ngược lại
        $user->save();

        $msg = $user->status ? 'Đã mở khóa tài khoản!' : 'Đã khóa tài khoản thành công!';
        return redirect()->back()->with('success', $msg);
    }
    public function updateRole($id)
    {
        $user = User::findOrFail($id);
        $user->role = request('role');
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật vai trò thành công!');
    }
}
