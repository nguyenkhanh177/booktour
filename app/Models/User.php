<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // tên bảng csdl
    protected $table = 'users';

    //khóa chính
    protected $primaryKey = 'id';
    // cho phép Eloquent tự quản lý ngày tạo, ngày cập nhật
    public $timestamps = true;
    // cột cho phép update
    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
        'role',
        'image',
        'status',
    ];
    // cột bảo mật
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // ép kiểu dữ liệu
    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // kiểm tra admin hay khách hàng
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    // kiểm tra trạng thái tài khoản
    public function isActive(): bool
    {
        return $this->status === 1;
    }
}
