<?php

namespace App\Models\pkg_Parameters;

use App\Models\pkg_Cars\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFuelType extends Model
{
    //
    use HasFactory;

    protected $table = 'car_fuel_types';

    protected $primaryKey = 'car_fuel_type_id';

    protected $fillable = [
        'fuel_type_name',
        'description',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'car_fuel_type_id');
    }
}