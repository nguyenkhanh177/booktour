<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BookingDetail;
use App\Models\User;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'user_id',
        'total_price',
        'status',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        // Giả sử tên bảng chi tiết của bạn đang là booking_details
        return $this->hasMany(BookingDetail::class, 'booking_id');
    }
}
