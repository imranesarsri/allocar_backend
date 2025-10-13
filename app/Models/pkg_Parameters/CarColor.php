<?php

namespace App\Models\pkg_Parameters;

use App\Models\pkg_Cars\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarColor extends Model
{
    //
    use HasFactory;

    protected $table = 'car_colors';
    protected $primaryKey = 'car_color_id';
    public $timestamps = true;

    protected $fillable = [
        'color_name',
        'color_code'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'car_color_id');
    }
}