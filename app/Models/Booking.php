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
        'booking_code',
        'start_date',
        'end_date',
        'payment_method',
        'payment_status',
        'note',
    ];
    const STATUS_PENDING = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_CANCELLED = 2;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        // Giả sử tên bảng chi tiết của bạn đang là booking_details
        return $this->hasMany(BookingDetail::class, 'booking_id');
    }
    public function tour()
    {
        // Giả sử cột khóa ngoại trong bảng bookings của bạn là tour_id
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
