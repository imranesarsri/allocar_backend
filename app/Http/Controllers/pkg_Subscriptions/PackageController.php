<?php

namespace App\Http\Controllers\pkg_Subscriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\pkg_Subscriptions\PackageRequest;
use App\Repositories\pkg_Subscriptions\PackageRepository;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected $packageRepository;

    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function index()
    {
        return $this->packageRepository->getAllData();
    }

    public function pagination()
    {
        return $this->packageRepository->getDataByPages();
    }

    public function find()
    {
        return $this->packageRepository->findData(request('package_id'));
    }

    public function store(PackageRequest $request)
    {
        return $this->packageRepository->createData($request);
    }

    public function update( PackageRequest $request)
    {
        return $this->packageRepository->updateData(request('package_id'), $request);
    }

    public function destroy()
    {
        return $this->packageRepository->deleteData(request('package_id'));
    }

   public function analyzeAgencyConditions(Request $request)
    {
        $agencyId = $request->input('agency_id');
        
        if (!$agencyId) {
            return response()->json([
                'message' => 'ID de l\'agence requis'
            ], 400);
        }

        $analysis = $this->packageRepository->analyzeAgencyConditions($agencyId);
        
        return response()->json($analysis);
    }

    /**
     * Mettre à niveau le package (avec conditions)
     */
    public function upgradePackage(Request $request)
    {
        $request->validate([
            'agency_id' => 'required|integer',
            'new_package_id' => 'required|integer'
        ]);

        $result = $this->packageRepository->executePackageUpgrade(
            $request->input('agency_id'),
            $request->input('new_package_id')
        );

        // Retourner différents codes selon le résultat
        if (isset($result['warning'])) {
            // Mise à niveau possible mais pas recommandée
            return response()->json($result, 202); // Accepted but with warning
        }

        $statusCode = $result['success'] ? 200 : 400;
        return response()->json($result, $statusCode);
    }

    /**
     * Forcer la mise à niveau (sans conditions d'usage)
     */
    public function forceUpgradePackage(Request $request)
    {
        $request->validate([
            'agency_id' => 'required|integer',
            'new_package_id' => 'required|integer'
        ]);

        $result = $this->packageRepository->forcePackageUpgrade(
            $request->input('agency_id'),
            $request->input('new_package_id')
        );

        $statusCode = $result['success'] ? 200 : 400;
        
        return response()->json($result, $statusCode);
    }

    /**
     * Obtenir les limites actuelles (lecture seule)
     */
    public function getCurrentLimits(Request $request)
    {
        $agencyId = $request->input('agency_id');
        
        if (!$agencyId) {
            return response()->json([
                'message' => 'ID de l\'agence requis'
            ], 400);
        }

        $analysis = $this->packageRepository->analyzeAgencyConditions($agencyId);
        
        // Retourner seulement les informations de base
        return response()->json([
            'current_package' => $analysis['current_package'] ?? null,
            'usage' => $analysis['usage'] ?? null,
            'status' => $analysis['status'] ?? null,
            'message' => $analysis['message'] ?? null
        ]);
    }
}