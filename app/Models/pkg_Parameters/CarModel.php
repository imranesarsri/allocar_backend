<?php

namespace App\Models\pkg_Parameters;

use App\Models\pkg_Cars\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    //
    use HasFactory;

    protected $table = 'car_models';
    protected $primaryKey = 'car_model_id';
    public $timestamps = true; 

    protected $fillable = [
        'car_brand_id',
        'model_name',
        'description'
    ];


    public function brand()
    {
        return $this->belongsTo(CarBrand::class, 'car_brand_id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'car_model_id');
    }


}
