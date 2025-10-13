<?php

namespace App\Models\pkg_Bookings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'price',
        'name',
        'email',
        'phone',
    ];
}
