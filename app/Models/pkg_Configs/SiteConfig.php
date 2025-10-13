<?php

namespace App\Models\pkg_Configs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    //
    use HasFactory;

    protected $table = 'site_config';
    protected $primaryKey = 'config_id';
    public $timestamps = true;

    protected $fillable = [
        'site_name',
        'site_description',
        'site_logo',
        'site_logo_dark',
        'favicon_url',
        'site_primary_color',
        'meta_title',
        'meta_description',
        'site_email',
        'contact_form_email',
        'support_email',
        'contact_phone',
        'address',
        'map_url',
        'social_media_facebook',
        'social_media_instagram',
        'social_media_twitter',
        'default_language',
        'site_status',
    ];
}
