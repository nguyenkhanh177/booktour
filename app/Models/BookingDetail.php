<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $table = 'booking_details';
    protected $fillable = [
        'booking_id',
        'service_type',
        'service_id',
        'price',
        'quantity',
    ];
    public function service()
    {
        // Đây là cách lấy dữ liệu động dựa trên service_type và service_id
        switch ($this->service_type) {
            case 'tour':
                return $this->belongsTo(Tour::class, 'service_id');
            case 'hotel':
                return $this->belongsTo(Hotel::class, 'service_id');
            case 'restaurant':
                return $this->belongsTo(Restaurant::class, 'service_id');
            case 'car':
                return $this->belongsTo(Car::class, 'service_id');
            default:
                return null;
        }
    }
}
