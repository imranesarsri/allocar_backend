<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeatureCarLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $agencyId = $request->input('agency_id');
        $isFeatureCar = $request->input('feature_car', false);

        // Si ce n'est pas une feature car, passer au middleware suivant
        if (!$isFeatureCar) {
            return $next($request);
        }

        // Vérifier si l'agence ID est fourni
        if (!$agencyId) {
            return response()->json([
                'message' => 'ID de l\'agence requis'
            ], 400);
        }

        // Effectuer toutes les validations dans le middleware
        $validationResult = $this->validateFeatureCarLimits($agencyId);

        if (!$validationResult['can_add']) {
            return response()->json($validationResult, 403);
        }

        return $next($request);
    }

    /**
     * Valider les limites de feature cars
     *
     * @param int $agencyId
     * @return array
     */
    private function validateFeatureCarLimits($agencyId)
    {
        // Récupérer le package actuel
        $currentPackage = $this->getAgencyCurrentPackage($agencyId);
        
        if (!$currentPackage) {
            return [
                'can_add' => false,
                'error' => 'NO_PACKAGE_FOUND',
                'message' => 'Aucun package trouvé pour cette agence'
            ];
        }

        // Compter les feature cars actuelles
        $currentFeatureCars = $this->countAgencyFeatureCars($agencyId);
        $maxFeatureCars = $currentPackage->max_feature_cars;
        $remainingSlots = max(0, $maxFeatureCars - $currentFeatureCars);

        // Si il reste des slots, autoriser l'ajout
        if ($remainingSlots > 0) {
            return [
                'can_add' => true,
                'message' => "Vous pouvez ajouter {$remainingSlots} voiture(s) avec feature",
                'remaining_slots' => $remainingSlots
            ];
        }

        // Limite atteinte - vérifier s'il existe un package supérieur
        $nextPackage = $this->getNextAvailablePackage($currentPackage);
        
        if ($nextPackage) {
            return [
                'can_add' => false,
                'error' => 'FEATURE_CAR_LIMIT_EXCEEDED',
                'message' => "Limite atteinte ({$currentFeatureCars}/{$maxFeatureCars}). Mise à niveau disponible.",
                'current_package' => [
                    'name' => $currentPackage->package_name,
                    'max_feature_cars' => $maxFeatureCars,
                    'current_feature_cars' => $currentFeatureCars
                ],
                'upgrade_available' => true,
                'next_package' => [
                    'id' => $nextPackage->package_id,
                    'name' => $nextPackage->package_name,
                    'max_feature_cars' => $nextPackage->max_feature_cars,
                    'additional_slots' => $nextPackage->max_feature_cars - $maxFeatureCars
                ],
                'suggestion' => "Passez au package '{$nextPackage->package_name}' pour {$nextPackage->max_feature_cars} feature cars"
            ];
        }

        // Aucun package supérieur disponible
        return [
            'can_add' => false,
            'error' => 'MAX_PACKAGE_REACHED',
            'message' => "Limite maximale atteinte ({$currentFeatureCars}/{$maxFeatureCars}). Aucun package supérieur disponible.",
            'current_package' => [
                'name' => $currentPackage->package_name,
                'max_feature_cars' => $maxFeatureCars,
                'current_feature_cars' => $currentFeatureCars
            ],
            'upgrade_available' => false
        ];
    }

    /**
     * Récupérer le package actuel d'une agence
     */
    private function getAgencyCurrentPackage($agencyId)
    {
        return DB::table('agency_subscriptions as agencies')
            ->join('packages', 'agencies.package_id', '=', 'packages.package_id')
            ->where('agencies.agency_id', $agencyId)
            ->where('agencies.status', 'active')
            ->select('packages.*')
            ->orderBy('agencies.created_at', 'desc')
            ->first();
    }

    /**
     * Compter les feature cars d'une agence
     */
    private function countAgencyFeatureCars($agencyId)
    {
        return DB::table('cars')
            ->where('agency_id', $agencyId)
            ->where('feature_car', 1)
            ->count();
    }

    /**
     * Récupérer le prochain package disponible
     */
    private function getNextAvailablePackage($currentPackage)
    {
        return DB::table('packages')
            ->where('max_feature_cars', '>', $currentPackage->max_feature_cars)
            ->orderBy('max_feature_cars', 'asc')
            ->first();
    }
}