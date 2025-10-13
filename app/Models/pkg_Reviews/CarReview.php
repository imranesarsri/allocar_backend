<?php

namespace App\Models\pkg_Reviews;

use App\Models\pkg_Cars\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarReview extends Model
{
    //
    use HasFactory;

    protected $table = 'car_reviews';
    protected $primaryKey = 'car_review_id';
    public $timestamps = true;

    protected $fillable = [
        'car_id',
        'user_id',
        'rating',
        'review_text'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
