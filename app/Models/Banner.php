<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'url',
        'sort_order',
        'is_active',
        'is_small',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_small' => 'boolean',
    ];
}
