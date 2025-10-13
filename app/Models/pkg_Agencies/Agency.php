<?php

namespace App\Models\pkg_Agencies;

use App\Models\pkg_Cars\Car;
use App\Models\pkg_Reviews\AgencyReview;
use App\Models\pkg_Subscriptions\AgencySubscription;
use App\Models\pkg_Subscriptions\Package;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    use HasFactory;

    protected $table = 'agencies';
    protected $primaryKey = 'agency_id';
    public $timestamps = true;

    protected $fillable = [
        'agency_name',
        'description',
        'address',
        'city',
        'phone_fix',
        'phone_number_1',
        'phone_number_2',
        'email',
        'website',
        'logo_url',
        'cover_image_url',
        'facebook_url',
        'instagram_url',
        'other_social_media_url',
        'user_id'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'agency_id');
    }

    public function reviews()
    {
        return $this->hasMany(AgencyReview::class, 'agency_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(AgencySubscription::class, 'agency_id');
    }
    public function packages()
    {
        return $this->belongsToMany(
            Package::class,
            'agency_subscriptions',
            'agency_id',
            'package_id',
            'agency_id',
            'package_id'
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' , 'user_id');
    }
}
