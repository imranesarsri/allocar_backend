<?php

namespace App\Http\Controllers\pkg_Subscriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Subscriptions\AgencySubscriptionRequest;
use App\Repositories\pkg_Subscriptions\AgencySubscriptionRepository;
use Illuminate\Http\Request;

class AgencySubscriptionController extends Controller
{
    protected $agencySubscriptionRepository;

    public function __construct(AgencySubscriptionRepository $agencySubscriptionRepository)
    {
        $this->agencySubscriptionRepository = $agencySubscriptionRepository;
    }

    public function index()
    {
        return $this->agencySubscriptionRepository->getAllData();
    }

    public function pagination()
    {
        return $this->agencySubscriptionRepository->getDataByPages();
    }

    public function find()
    {
        return $this->agencySubscriptionRepository->findData(request('subscription_id'));
    }

    public function store(AgencySubscriptionRequest $request)
    {
        return $this->agencySubscriptionRepository->createData($request);
    }

    public function update( AgencySubscriptionRequest $request)
    {
        return $this->agencySubscriptionRepository->updateData(request('subscription_id'), $request);
    }

    public function destroy()
    {
        return $this->agencySubscriptionRepository->deleteData(request('subscription_id'));
    }
}