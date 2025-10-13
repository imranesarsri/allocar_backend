<?php

namespace App\Repositories\pkg_Parameters;

use App\Models\pkg_Parameters\CarModel;
use App\Repositories\BaseRepository;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarModelRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new CarModel());
    }

    /**
     * Retrieve all car models.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCarModels()
    {
        try {
            $carModels = $this->getAll();
            return response()->json(['success' => true, $carModels], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car models: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }



    /**
     * Get all car models by brand ID.
     *
     * @param int $car_brand_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getModelsByBrand($car_brand_id)
    {
        Log::info('Getting car models by brand ID: ' . $car_brand_id);

        try {
            $models = CarModel::where('car_brand_id', $car_brand_id)->get();

            Log::info('Car models retrieved for brand ID ' . $car_brand_id . ': ' . json_encode($models));

            return response()->json(['success' => true, 'data' => $models], 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving car models by brand ID: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Retrieve paginated car models.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedCarModels()
    {
        Log::info('Retrieving all car models with pagination');
        try {
            $carModels = $this->paginate();

            Log::info('Retrieved ' . $carModels->total() . ' car Models');

            return response()->json(['success' => true, $carModels], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car Models with pagination: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Find and retrieve a car model by its ID.
     *
     * @param int $id The ID of the car model to find.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCarModelById($id)
    {
        Log::info('Finding car Models with ID: ' . $id);

        try {
            $carModels = $this->find($id);

            Log::info('Car Models found: ' . json_encode($carModels));

            return response()->json(['success' => true, $carModels], 200);
        } catch (\Exception $e) {
            Log::error('Error finding car Models with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Car Models not found'], 404);
        }
    }


    /**
     * Create a new car model.
     *
     * @param Request $request The request object containing car model data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCarModel(Request $request)
    {
        Log::info('Creating new car Models: ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();

            Log::info('Creating car Models with validated data: ' . json_encode($validatedData));

            $newCarModels = $this->create($validatedData); // Assuming `create` is defined in BaseRepository

            Log::info('Car Models created: ' . json_encode($newCarModels));

            return response()->json(['success' => true, $newCarModels], 201);
        } catch (\Exception $e) {
            Log::error('Error creating car Models: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Update a car model by its ID.
     *
     * @param int $id The ID of the car model to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCarModel($id, Request $request)
    {
        Log::info('Updating car Model with ID: ' . $id);

        try {
            $CarModel = CarModel::find($id);

            $validatedData = $request->validated();
            Log::info('Validated data for car model update: ' . json_encode($validatedData));

            $CarModel->update($validatedData);

            Log::info('Car model updated successfully: ' . json_encode($CarModel));

            return response()->json(['success' => true, 'message' => 'Car model updated successfully', 'data' => $CarModel], 200);
        } catch (\Exception $e) {
            Log::error('Error updating car model with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Delete a car model by its ID.
     *
     * @param int $id The ID of the car model to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCarModel($id)
    {
        Log::info('Deleting car Models with ID: ' . $id);

        try {
            $this->destroy($id);

            Log::info('Car Models deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Car Models deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting car Models with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Filter car models by brand name.
     * * @param string $car_brand_name The name of the car brand.
     * @return \Illuminate\Http\JsonResponse
     */
}


