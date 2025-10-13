<?php

namespace App\Models\pkg_Reviews;

use App\Models\pkg_Agencies\Agency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyReview extends Model
{
    //
    use HasFactory;

    protected $table = 'agency_reviews';
    protected $primaryKey = 'agency_review_id';
    public $timestamps = true;

    protected $fillable = [
        'agency_id',
        'user_id',
        'rating',
        'review_text'
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'agency_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}