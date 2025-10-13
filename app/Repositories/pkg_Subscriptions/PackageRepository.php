<?php

namespace App\Repositories\pkg_Subscriptions;

use App\Models\pkg_Subscriptions\Package;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Package());
    }

    /**
     * Retrieve all packages.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        return response()->json($this->getAll(), 200);
    }

    /**
     * Retrieve paginated list of packages.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        return response()->json($this->paginate(), 200);
    }

    /**
     * Find and retrieve a package by its ID.
     *
     * @param int $id The ID of the package to retrieve.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        $package = $this->find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }
        return response()->json($package, 200);
    }

    /**
     * Create a new package.
     *
     * @param Request $request The request object containing package data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        $data = $request->all();

        $newPackage = $this->create($data);

        return response()->json($newPackage, 201);
    }

    /**
     * Update a package by its ID.
     *
     * @param int $id The ID of the package to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateData($id, Request $request)
    {
        $package = $this->find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        $updatedPackage = $this->update($id, $request->all());

        return response()->json($updatedPackage, 200);
    }

    /**
     * Delete a package by its ID.
     *
     * @param int $id The ID of the package to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        $package = $this->find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        $this->destroy($id);
        return response()->json(['message' => 'Package deleted successfully'], 200);
    }



    public function analyzeAgencyConditions($agencyId)
    {
        $currentPackage = $this->getAgencyCurrentPackage($agencyId);
        
        if (!$currentPackage) {
            return [
                'status' => 'no_package',
                'message' => 'Aucun package actif trouvé pour cette agence',
                'action_required' => 'Veuillez souscrire à un package',
                'can_upgrade' => false
            ];
        }

        $currentFeatureCars = $this->countAgencyFeatureCars($agencyId);
        $totalCars = $this->countAgencyCars($agencyId);
        $maxFeatureCars = $currentPackage->max_feature_cars;
        $usagePercentage = $maxFeatureCars > 0 ? ($currentFeatureCars / $maxFeatureCars) * 100 : 0;
        $remainingSlots = max(0, $maxFeatureCars - $currentFeatureCars);

        $nextPackage = $this->getNextAvailablePackage($currentPackage);

        $baseInfo = [
            'current_package' => [
                'id' => $currentPackage->package_id,
                'name' => $currentPackage->package_name,
                'max_feature_cars' => $maxFeatureCars
            ],
            'usage' => [
                'current_feature_cars' => $currentFeatureCars,
                'total_cars' => $totalCars,
                'usage_percentage' => round($usagePercentage, 2),
                'remaining_slots' => $remainingSlots
            ],
            'can_upgrade' => !is_null($nextPackage)
        ];

        // Conditions et messages selon l'usage
        if ($usagePercentage >= 100) {
            return array_merge($baseInfo, [
                'status' => 'limit_exceeded',
                'priority' => 'urgent',
                'message' => "Limite maximale atteinte ! Vous utilisez {$currentFeatureCars}/{$maxFeatureCars} feature cars.",
                'action_required' => $nextPackage ? 
                    "Mise à niveau immédiate requise vers '{$nextPackage->package_name}'" : 
                    'Aucune mise à niveau disponible - contactez le support',
                'upgrade_info' => $nextPackage ? [
                    'next_package' => [
                        'id' => $nextPackage->package_id,
                        'name' => $nextPackage->package_name,
                        'max_feature_cars' => $nextPackage->max_feature_cars,
                        'additional_slots' => $nextPackage->max_feature_cars - $maxFeatureCars
                    ],
                    'benefits' => "Vous aurez " . ($nextPackage->max_feature_cars - $maxFeatureCars) . " feature cars supplémentaires"
                ] : null
            ]);
        } 
        
        elseif ($usagePercentage >= 80) {
            return array_merge($baseInfo, [
                'status' => 'near_limit',
                'priority' => 'high',
                'message' => "Attention ! Vous approchez de la limite ({$currentFeatureCars}/{$maxFeatureCars} - {$usagePercentage}%)",
                'action_required' => $nextPackage ? 
                    "Planifiez une mise à niveau vers '{$nextPackage->package_name}'" : 
                    'Surveillez votre usage - aucun package supérieur disponible',
                'upgrade_info' => $nextPackage ? [
                    'next_package' => [
                        'id' => $nextPackage->package_id,
                        'name' => $nextPackage->package_name,
                        'max_feature_cars' => $nextPackage->max_feature_cars,
                        'additional_slots' => $nextPackage->max_feature_cars - $maxFeatureCars
                    ],
                    'recommendation' => 'Mise à niveau recommandée pour éviter les blocages'
                ] : null
            ]);
        } 
        
        elseif ($usagePercentage >= 50) {
            return array_merge($baseInfo, [
                'status' => 'moderate_usage',
                'priority' => 'medium',
                'message' => "Usage modéré de vos feature cars ({$currentFeatureCars}/{$maxFeatureCars} - {$usagePercentage}%)",
                'action_required' => "Continuez à surveiller votre usage. {$remainingSlots} slots restants",
                'upgrade_info' => $nextPackage ? [
                    'next_package' => [
                        'id' => $nextPackage->package_id,
                        'name' => $nextPackage->package_name,
                        'max_feature_cars' => $nextPackage->max_feature_cars
                    ],
                    'note' => 'Mise à niveau disponible si nécessaire'
                ] : null
            ]);
        } 
        
        else {
            return array_merge($baseInfo, [
                'status' => 'optimal',
                'priority' => 'low',
                'message' => "Excellent ! Usage optimal de vos feature cars ({$currentFeatureCars}/{$maxFeatureCars} - {$usagePercentage}%)",
                'action_required' => "Aucune action requise. Vous avez {$remainingSlots} slots disponibles",
                'upgrade_info' => $nextPackage ? [
                    'next_package' => [
                        'id' => $nextPackage->package_id,
                        'name' => $nextPackage->package_name,
                        'max_feature_cars' => $nextPackage->max_feature_cars
                    ],
                    'note' => 'Mise à niveau disponible pour expansion future'
                ] : null
            ]);
        }
    }

    public function executePackageUpgrade($agencyId, $newPackageId)
    {
        try {
            DB::beginTransaction();

            // Conditions de base
            $currentSubscription = $this->getCurrentActiveSubscription($agencyId);
            if (!$currentSubscription) {
                throw new \Exception('Aucun abonnement actif trouvé pour cette agence');
            }

            $newPackage = $this->getPackageById($newPackageId);
            if (!$newPackage) {
                throw new \Exception('Package de destination introuvable');
            }

            $currentPackage = $this->getPackageById($currentSubscription->package_id);

            // Condition : Le nouveau package doit être supérieur
            if ($newPackage->max_feature_cars <= $currentPackage->max_feature_cars) {
                return [
                    'success' => false,
                    'error' => 'INVALID_UPGRADE',
                    'message' => "Le package '{$newPackage->package_name}' n'est pas supérieur au package actuel '{$currentPackage->package_name}'",
                    'condition_failed' => 'Le nouveau package doit avoir plus de feature cars que l\'actuel',
                    'current_limit' => $currentPackage->max_feature_cars,
                    'target_limit' => $newPackage->max_feature_cars
                ];
            }

            // Condition : Vérifier si l'agence a besoin de cette mise à niveau
            $currentFeatureCars = $this->countAgencyFeatureCars($agencyId);
            if ($currentFeatureCars < $currentPackage->max_feature_cars * 0.8) {
                return [
                    'success' => false,
                    'warning' => 'UPGRADE_NOT_NEEDED',
                    'message' => "Mise à niveau possible mais pas nécessaire. Vous utilisez seulement {$currentFeatureCars}/{$currentPackage->max_feature_cars} feature cars",
                    'recommendation' => 'Attendez d\'atteindre 80% d\'usage avant la mise à niveau',
                    'force_upgrade_available' => true,
                    'usage_percentage' => round(($currentFeatureCars / $currentPackage->max_feature_cars) * 100, 2)
                ];
            }

            // Exécuter la mise à niveau
            $this->deactivateCurrentSubscription($agencyId);
            $newSubscriptionId = $this->createNewSubscription($agencyId, $newPackageId);

            DB::commit();

            return [
                'success' => true,
                'message' => "Mise à niveau réussie de '{$currentPackage->package_name}' vers '{$newPackage->package_name}'",
                'upgrade_details' => [
                    'old_package' => [
                        'name' => $currentPackage->package_name,
                        'max_feature_cars' => $currentPackage->max_feature_cars
                    ],
                    'new_package' => [
                        'name' => $newPackage->package_name,
                        'max_feature_cars' => $newPackage->max_feature_cars
                    ],
                    'additional_slots' => $newPackage->max_feature_cars - $currentPackage->max_feature_cars,
                    'current_usage' => $currentFeatureCars,
                    'new_remaining_slots' => $newPackage->max_feature_cars - $currentFeatureCars
                ],
                'subscription_id' => $newSubscriptionId,
                'upgraded_at' => now()->toDateTimeString()
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            
            return [
                'success' => false,
                'error' => 'UPGRADE_FAILED',
                'message' => 'Échec de la mise à niveau du package',
                'error_detail' => $e->getMessage(),
                'action_required' => 'Contactez le support technique'
            ];
        }
    }

    /**
     * Forcer la mise à niveau (même si pas nécessaire)
     */
    public function forcePackageUpgrade($agencyId, $newPackageId)
    {
        // Même logique que executePackageUpgrade mais sans la condition des 80%
        try {
            DB::beginTransaction();

            $currentSubscription = $this->getCurrentActiveSubscription($agencyId);
            $newPackage = $this->getPackageById($newPackageId);
            $currentPackage = $this->getPackageById($currentSubscription->package_id);

            if ($newPackage->max_feature_cars <= $currentPackage->max_feature_cars) {
                return [
                    'success' => false,
                    'error' => 'INVALID_UPGRADE',
                    'message' => "Impossible de passer à un package inférieur ou égal"
                ];
            }

            $this->deactivateCurrentSubscription($agencyId);
            $newSubscriptionId = $this->createNewSubscription($agencyId, $newPackageId);

            DB::commit();

            return [
                'success' => true,
                'message' => "Mise à niveau forcée réussie vers '{$newPackage->package_name}'",
                'note' => 'Mise à niveau effectuée même si non nécessaire'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'FORCE_UPGRADE_FAILED',
                'message' => $e->getMessage()
            ];
        }
    }
  
/**
 * Récupérer le package actuel d'une agence
 *
 * @param int $agencyId L'ID de l'agence
 * @return mixed Le package de l'agence ou null
 */
private function getAgencyCurrentPackage($agencyId)
{
    
    $subscription = DB::table('agency_subscriptions')
            ->where('agency_id', $agencyId)
            ->where('is_active', 1)
            ->first();

    $package = DB::table('packages')
            ->where('package_id', $subscription->package_id)
            ->first();
        
    return $package;
}

/**
 * Compter le nombre de voitures avec feature d'une agence
 *
 * @param int $agencyId L'ID de l'agence
 * @return int Le nombre de voitures avec feature
 */
private function countAgencyFeatureCars($agencyId)
{
    return DB::table('cars')
        ->where('agency_id', $agencyId)
        ->where('feature_car', 1)
        ->count();
}

private function countAgencyCars($agencyId)
    {
        return DB::table('cars')
            ->where('agency_id', $agencyId)
            ->count();
    }

    private function getNextAvailablePackage($currentPackage)
    {
        return DB::table('packages')
            ->where('max_feature_cars', '>', $currentPackage->max_feature_cars)
            ->orderBy('max_feature_cars', 'asc')
            ->first();
    }

    private function getCurrentActiveSubscription($agencyId)
    {
        return DB::table('agency_subscriptions')
            ->where('agency_id', $agencyId)
            ->where('is_active', 1)
            ->first();
    }

    private function getPackageById($packageId)
    {
        return DB::table('packages')
            ->where('package_id', $packageId)
            ->first();
    }

    private function deactivateCurrentSubscription($agencyId)
    {
        return DB::table('agency_subscriptions')
            ->where('agency_id', $agencyId)
            ->where('is_active', 1)
            ->update([
                'is_active' => 0,
                'end_date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }

    private function createNewSubscription($agencyId, $packageId)
    {
        return DB::table('agency_subscriptions')->insertGetId([
            'agency_id' => $agencyId,
            'package_id' => $packageId,
            'is_active' => 1,
            'end_date' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
