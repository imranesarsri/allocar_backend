<?php

namespace App\Models\pkg_Parameters;

use App\Models\pkg_Cars\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarCategory extends Model
{
    //
    use HasFactory;

    protected $table = 'car_categories';
    protected $primaryKey = 'car_category_id';
    public $timestamps = true;

    protected $fillable = [
        'category_name',
        'description'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'car_category_id');
    }
}
