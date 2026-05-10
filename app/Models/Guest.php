<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'phone', 'category',
        'is_confirmed', 'guest_count', 'message', 'opened_at'
    ];

    protected $casts = [
        'is_confirmed' => 'boolean',
        'opened_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($guest) {
            if (empty($guest->slug)) {
                $guest->slug = Str::slug($guest->name) . '-' . Str::random(5);
            }
        });
    }
}
