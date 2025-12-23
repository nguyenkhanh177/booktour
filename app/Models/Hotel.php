<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';
    protected $fillable = [
        'name',
        'alias',
        'title',
        'description',
        'price',
        'image',
        'address',
        'phone',
        'email',
        'status',
    ];
}
