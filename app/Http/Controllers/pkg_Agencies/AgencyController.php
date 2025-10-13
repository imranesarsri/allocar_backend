<?php

namespace App\Http\Controllers\pkg_Agencies;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Agencies\AgencyRequest;
use App\Repositories\pkg_Agencies\AgencyRepository;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    //
    protected $agencyRepository;

    public function __construct(AgencyRepository $agencyRepository)
    {
        $this->agencyRepository = $agencyRepository;
    }

    public function index()
    {
        return $this->agencyRepository->getAllData();
    }

    public function count()
    {
        return $this->agencyRepository->getCount();
    }

    public function pagination()
    {
        return $this->agencyRepository->getDataByPages();
    }

    public function find()
    {
        return $this->agencyRepository->findData(request('agency_id'));
    }

    public function store(AgencyRequest $request)
    {
        return $this->agencyRepository->createData($request);
    }

    public function update(AgencyRequest $request)
    {
        return $this->agencyRepository->updateData(request('agency_id'), $request);
    }

    public function destroy()
    {
        return $this->agencyRepository->deleteData(request('agency_id'));
    }

}
