<?php

namespace App\Repositories\pkg_Parameters;

use App\Http\Requests\pkg_Parameters\CarBrandRequest;
use App\Models\pkg_Parameters\CarBrand;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarBrandRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new CarBrand());
    }

    /**
     * Retrieve all car brands.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCarBrands()
    {
        try {
            $carBrands = $this->getAll();

            return response()->json(['success' => true, $carBrands], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car brands: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    public function getTopCarBrands()
    {
        try {
            $carBrands = CarBrand::withCount('cars')
                ->orderBy('cars_count', 'desc')
                ->get()
                ->map(function ($brand) {
                    return [
                        'car_brand_id' => $brand->car_brand_id,
                        'brand_name' => $brand->brand_name,
                        'description' => $brand->description,
                        'logo_url' => $brand->logo_url,
                        'cars_count' => $brand->cars_count,
                        'created_at' => $brand->created_at,
                        'updated_at' => $brand->updated_at
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $carBrands
            ], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving top car brands: ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }


    /**
     * Retrieve paginated car brands.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedCarBrands()
    {
        Log::info('Retrieving all car brands with pagination');

        try {
            $carBrands = CarBrand::paginate($this->paginationLimit);

            Log::info('Retrieved ' . $carBrands->total() . ' car brands');

            return response()->json(['success' => true, $carBrands], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car brands with pagination: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Find and retrieve a car brand by its ID.
     *
     * @param int $id The ID of the car brand to find.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCarBrandById($id)
    {
        Log::info('Finding car brand with ID: ' . $id);

        try {
            $carBrand = $this->find($id);

            Log::info('Car brand found: ' . json_encode($carBrand));

            return response()->json(['success' => true, $carBrand], 200);
        } catch (Exception $e) {
            Log::error('Error finding car brand with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Car brand not found'], 404);
        }
    }


    /**
     * Create a new car brand.
     *
     * @param Request $request The request object containing car brand data.
     * @return \Illuminate\Http\JsonResponse
     */
    //you should use the CarBrandRequest class for validation
    public function createCarBrand(CarBrandRequest $request)
    {

        Log::info('Creating new car brand: ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();
            Log::info('Creating car brand with validated data: ' . json_encode($validatedData));

            $newBrand = $this->create($validatedData);

            Log::info('Car brand created: ' . json_encode($newBrand));

            return response()->json(['success' => true, $newBrand], 201);
        } catch (Exception $e) {
            Log::error('Error creating car brand: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Update a car brand by its ID.
     *
     * @param int $id The ID of the car brand to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCarBrand($id, Request $request)
    {
        Log::info('Updating car brand with ID: ' . $id);

        try {
            $carBrand = CarBrand::find($id);

            if (!$carBrand) {
                Log::warning('Car brand not found with ID: ' . $id);
                return response()->json(['success' => false, 'message' => 'Car brand not found'], 404);
            }

            $validatedData = $request->validated();
            Log::info('Validated data for car brand update: ' . json_encode($validatedData));

            $carBrand->update($validatedData);

            Log::info('Car brand updated successfully: ' . json_encode($carBrand));

            return response()->json(['success' => true, 'message' => 'Car brand updated successfully', 'data' => $carBrand], 200);
        } catch (Exception $e) {
            Log::error('Error updating car brand with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Delete a car brand by its ID.
     *
     * @param int $id The ID of the car brand to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCarBrand($id)
    {
        Log::info('Deleting car brand with ID: ' . $id);

        try {
            $this->destroy($id);

            Log::info('Car brand deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Car brand deleted successfully'], 200);
        } catch (Exception $e) {
            Log::error('Error deleting car brand with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
    // get brands count
    public function getBrandsCount()
    {
        try {
            $count = CarBrand::count();
            return response()->json(['success' => true, 'count' => $count], 200);
        } catch (Exception $e) {
            Log::error('Error retrieving car brands count: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }
}
