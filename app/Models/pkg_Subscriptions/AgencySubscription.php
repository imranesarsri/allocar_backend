<?php

namespace App\Models\pkg_Subscriptions;

use App\Models\pkg_Agencies\Agency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencySubscription extends Model
{
    //
    use HasFactory;

    protected $table = 'agency_subscriptions';
    protected $primaryKey = 'subscription_id';
    public $timestamps = true;

    protected $fillable = [
        'agency_id',
        'package_id',
        'start_date',
        'end_date',
        'is_active',
        'current_car_count'
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'agency_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'package_id');
    }
}
