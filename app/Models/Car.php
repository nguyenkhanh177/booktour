<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = [
        'name',
        'alias',
        'title',
        'image',
        'address',
        'phone',
        'email',
        'description',
        'price',
        'status',
    ];
}
