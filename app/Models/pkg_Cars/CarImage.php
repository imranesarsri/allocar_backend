<?php

namespace App\Models\pkg_Cars;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    //
    use HasFactory;

    protected $table = 'car_images';
    protected $primaryKey = 'car_image_id';
    public $timestamps = true;

    protected $fillable = [
        'car_id',
        'image_url',
        'is_primary'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }
}
