<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\pkg_Agencies\Agency;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Models\pkg_Blogs\BlogComment;
use App\Models\pkg_Reviews\AgencyReview;
use App\Models\pkg_Reviews\CarReview;
use App\Models\pkg_Subscriptions\AgencySubscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Les attributs qui peuvent être remplis via mass assignment.
     *
     * @var array
     */

    //

    protected $table = 'users';
    protected $primaryKey = 'user_id';


    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * Les attributs cachés pour la sérialisation.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts pour convertir les données au bon format.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * Relation avec les avis laissés sur les voitures.
     */
    public function carReviews()
    {
        return $this->hasMany(CarReview::class, 'user_id', 'user_id');
    }

    /**
     * Relation avec les avis laissés sur les agences.
     */
    public function agencyReviews()
    {
        return $this->hasMany(AgencyReview::class, 'user_id', 'user_id');
    }

    /**
     * Relation avec les commentaires sur les articles de blog.
     */
    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'user_id', 'user_id');
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the email address that should be used for password reset.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Get the route key for the password reset notification.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'user_id';
    }
    /**
     * Relation avec les abonnements d'agence.
     */
    public function agencies()
    {
        return $this->hasMany(Agency::class , 'user_id', 'user_id');
    }
}
