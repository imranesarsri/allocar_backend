<?php

namespace App\Http\Controllers\pkg_Agencies;

use App\Http\Controllers\Controller;
use App\Repositories\pkg_Agencies\AgencyImageRepository;
use Illuminate\Http\Request;

class AgencyImageController extends Controller
{
    protected $agencyImageRepository;

    public function __construct(AgencyImageRepository $agencyImageRepository)
    {
        $this->agencyImageRepository = $agencyImageRepository;
    }

    /**
     * Logo image
     * functions: uploadLogo, updateLogo, deleteLogo
     */

    public function uploadLogo(Request $request)
    {
        return $this->agencyImageRepository->uploadLogoImage($request, request('agency_id'));
    }

    public function updateLogo(Request $request)
    {
        return $this->agencyImageRepository->updateLogoImage($request, request('agency_id'));
    }

    public function deleteLogo()
    {
        return $this->agencyImageRepository->deleteLogoImage(request('agency_id'));
    }


    /**
     * Cover image
     * functions: uploadCover, updateCover, deleteCover
     */

    public function uploadCover(Request $request)
    {
        return $this->agencyImageRepository->uploadCoverImage($request, request('agency_id'));
    }

    public function updateCover(Request $request)
    {
        return $this->agencyImageRepository->updateCoverImage($request, request('agency_id'));
    }

    public function deleteCover()
    {
        return $this->agencyImageRepository->deleteCoverImage(request('agency_id'));
    }

}