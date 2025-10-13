<?php

namespace App\Http\Controllers\pkg_Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Reviews\AgencyReviewRequest;
use App\Repositories\pkg_Reviews\AgencyReviewRepository;
use Illuminate\Http\Request;

class AgencyReviewController extends Controller
{
    //
    protected $agencyReviewRepository;

    public function __construct(AgencyReviewRepository $agencyReviewRepository)
    {
        $this->agencyReviewRepository = $agencyReviewRepository;
    }

    public function index()
    {
        return $this->agencyReviewRepository->getAllData();
    }

    public function pagination()
    {
        return $this->agencyReviewRepository->getDataByPages();
    }

    public function find()
    {
        return $this->agencyReviewRepository->findData(request('agency_review_id'));
    }

    public function store(AgencyReviewRequest $request)
    {
        return $this->agencyReviewRepository->createData($request);
    }

    public function update(AgencyReviewRequest $request)
    {
        return $this->agencyReviewRepository->updateData(request('agency_review_id'), $request);
    }

    public function destroy()
    {
        return $this->agencyReviewRepository->deleteData(request('agency_review_id'));
    }
}