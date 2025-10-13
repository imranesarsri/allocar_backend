<?php

namespace App\Models\pkg_Parameters;

use App\Models\pkg_Cars\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    //
    use HasFactory;

    protected $table = 'car_brands';
    protected $primaryKey = 'car_brand_id';
    public $timestamps = true;

    protected $fillable = [
        'brand_name',
        'description',
        'logo_url'
    ];


    public function models()
    {
        return $this->hasMany(CarModel::class, 'car_brand_id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'car_brand_id');
    }

}
