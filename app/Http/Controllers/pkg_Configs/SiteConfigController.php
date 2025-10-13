<?php

namespace App\Http\Controllers\pkg_Configs;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Configs\SiteConfigRequest;
use App\Repositories\pkg_Configs\SiteConfigRepository;
use Illuminate\Http\Request;

class SiteConfigController extends Controller
{
    protected $siteConfigRepository;

    public function __construct(SiteConfigRepository $siteConfigRepository)
    {
        $this->siteConfigRepository = $siteConfigRepository;
    }
    public function index()
    {
        return $this->siteConfigRepository->getConfig();
    }
    public function pagination()
    {
        return $this->siteConfigRepository->getDataByPages();
    }

    public function find()
    {
        return $this->siteConfigRepository->findData(request('config_id'));
    }

    public function store(SiteConfigRequest $request)
    {
        return $this->siteConfigRepository->createData($request);
    }

    public function update(SiteConfigRequest $request)
    {
        return $this->siteConfigRepository->updateConfig(request('config_id'), $request);
    }

    public function destroy()
    {
        return $this->siteConfigRepository->deleteData(request('config_id'));
    }
}