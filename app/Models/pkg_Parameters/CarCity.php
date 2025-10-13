<?php

namespace App\Models\pkg_Parameters;

use App\Models\pkg_Cars\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarCity extends Model
{
    //
    use HasFactory;

    protected $table = 'car_cities';
    protected $primaryKey = 'car_city_id';
    public $timestamps = true; // Laravel gérera les timestamps par défaut

    protected $fillable = [
        'city_name',
        'country'
    ];

    /**
     * Relation avec les voitures (une ville peut avoir plusieurs voitures)
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'car_city_id', 'car_city_id');
    }
}
