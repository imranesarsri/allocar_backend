<?php

namespace App\Http\Controllers\pkg_Configs;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Configs\SiteConfigImageRepository;
use Illuminate\Http\Request;

class SiteConfigImageController extends Controller
{
    protected $siteConfigImageRepository;

    public function __construct(SiteConfigImageRepository $siteConfigImageRepository)
    {
        $this->siteConfigImageRepository = $siteConfigImageRepository;
    }

    /**
     * Light logo
     * functions: uploadLightLogo, updateLightLogo, deleteLightLogo
     */

    public function uploadLightLogo(Request $request)
    {
        return $this->siteConfigImageRepository->uploadLightLogo($request, request('site_config_id'));
    }

    public function updateLightLogo(Request $request)
    {
        return $this->siteConfigImageRepository->updateLightLogo($request, request('site_config_id'));
    }

    public function deleteLightLogo()
    {
        return $this->siteConfigImageRepository->deleteLightLogo(request('site_config_id'));
    }


    /**
     * Dark logo
     * functions: uploadDarkImage, updateDarkImage, deleteDarkImage
     */

    public function uploadDarkImage(Request $request)
    {
        return $this->siteConfigImageRepository->uploadDarkImage($request, request('site_config_id'));
    }

    public function updateDarkImage(Request $request)
    {
        return $this->siteConfigImageRepository->updateDarkImage($request, request('site_config_id'));
    }

    public function deleteDarkImage()
    {
        return $this->siteConfigImageRepository->deleteDarkImage(request('site_config_id'));
    }

}
