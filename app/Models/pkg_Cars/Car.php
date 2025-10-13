<?php

namespace App\Models\pkg_Cars;

use App\Models\pkg_Agencies\Agency;
use App\Models\pkg_Parameters\CarBrand;
use App\Models\pkg_Parameters\CarCategory;
use App\Models\pkg_Parameters\CarCity;
use App\Models\pkg_Parameters\CarColor;
use App\Models\pkg_Parameters\CarFuelType;
use App\Models\pkg_Parameters\CarModel;
use App\Models\pkg_Reviews\CarReview;
use App\Models\pkg_Subscriptions\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Car extends Model
{
    //
    use HasFactory;

    protected $table = 'cars';
    protected $primaryKey = 'car_id';
    public $timestamps = true;

    protected $fillable = [
        'agency_id',
        'car_brand_id',
        'car_model_id',
        'car_category_id',
        'car_color_id',
        'car_fuel_type_id',
        'car_city_id',
        'feature_car',
        'year',
        'mileage',
        'transmission',
        'registration_number',
        'price',
        'is_available',
        'description',
        'features',
        'is_discount',
        'discount_price',
        'discount_end_date'
    ];

    // Relationships
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'agency_id');
    }

    public function brand()
    {
        return $this->belongsTo(CarBrand::class, 'car_brand_id', 'car_brand_id');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id', 'car_model_id');
    }

    public function category()
    {
        return $this->belongsTo(CarCategory::class, 'car_category_id', 'car_category_id');
    }

    public function color()
    {
        return $this->belongsTo(CarColor::class, 'car_color_id', 'car_color_id');
    }

    public function fuelType()
    {
        return $this->belongsTo(CarFuelType::class, 'car_fuel_type_id', 'car_fuel_type_id');
    }

    public function city()
    {
        return $this->belongsTo(CarCity::class, 'car_city_id', 'car_city_id');
    }

    public function images()
    {
        return $this->hasMany(CarImage::class, 'car_id', 'car_id');
    }

    public function reviews()
    {
        return $this->hasMany(CarReview::class, 'car_id', 'car_id');
    }


    public function scopeOnDiscount($query)
    {
        return $query->where('is_discount', true)
                    ->whereDate('discount_end_date', '>=', now()->toDateString());
    }

    public function scopeActiveDiscounts($query)
    {
        return $query->where('is_discount', true)
                    ->whereDate('discount_end_date', '>=', now()->toDateString());
    }

    public function scopeExpiredDiscounts($query)
    {
        return $query->where('is_discount', true)
                    ->whereDate('discount_end_date', '<', now()->toDateString());
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

}