<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = 'tours';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'alias',
        'title',
        'description',
        'image',
        'price',
        'address',
        'time',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $attributes = [
        'status' => 1,
    ];
    public function isActive(): bool
    {
        return $this->status === 1;
    }
}
