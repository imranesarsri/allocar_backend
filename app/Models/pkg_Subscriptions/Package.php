<?php

namespace App\Models\pkg_Subscriptions;

use App\Models\pkg_Cars\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    use HasFactory;

    protected $table = 'packages';
    protected $primaryKey = 'package_id';
    public $timestamps = true;

    protected $fillable = [
        'package_name',
        'price',
        'max_car_limit',
        'max_feature_cars',
        'description'
    ];

    public function subscriptions()
    {
        return $this->hasMany(AgencySubscription::class, 'package_id');
    }

}