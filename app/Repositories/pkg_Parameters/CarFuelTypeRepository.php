<?php

namespace App\Repositories\pkg_Parameters;

use App\Models\pkg_Parameters\CarFuelType;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarFuelTypeRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new CarFuelType());
    }

    /**
     * Retrieve all car fuel types.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCarFuelTypes()
    {
        try {
            $CarFuelTypes = $this->getAll();
            return response()->json(['success' => true, $CarFuelTypes], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car cities: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Retrieve paginated car fuel types.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedCarFuelTypes()
    {
        Log::info('Retrieving all car Fuel Types with pagination');
        try {
            $CarFuelTypes = $this->paginate();

            Log::info('Retrieved ' . $CarFuelTypes->total() . ' car FuelTypes');

            return response()->json(['success' => true, $CarFuelTypes], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car Fuel Types with pagination: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Find and retrieve a car fuel type by its ID.
     *
     * @param int $id The ID of the car fuel type to find.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCarFuelTypeById($id)
    {
        Log::info('Finding car Fuel Types with ID: ' . $id);

        try {
            $CarFuelTypes = $this->find($id);

            Log::info('CarFuelTypes found: ' . json_encode($CarFuelTypes));

            return response()->json(['success' => true, $CarFuelTypes], 200);
        } catch (\Exception $e) {
            Log::error('Error finding CarFuelTypes with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'CarFuelTypes not found'], 404);
        }
    }


    /**
     * Create a new car fuel type.
     *
     * @param Request $request The request object containing car fuel type data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCarFuelType(Request $request)
    {
        Log::info('Creating new car fuel type: ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();

            Log::info('Creating car fuel type with validated data: ' . json_encode($validatedData));

            $newFuelType = $this->create($validatedData); // Assuming `create` is defined in BaseRepository

            Log::info('Car fuel type created: ' . json_encode($newFuelType));

            return response()->json(['success' => true, $newFuelType], 201);
        } catch (\Exception $e) {
            Log::error('Error creating car fuel type: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Update a car fuel type by its ID.
     *
     * @param int $id The ID of the car fuel type to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCarFuelType($id, Request $request)
    {
        Log::info('Updating car fuel type with ID: ' . $id);

        try {
            $fuelType = $this->find($id);

            $validatedData = $request->validated();
            Log::info('Validated data for car fuel type update: ' . json_encode($validatedData));

            $fuelType->update($validatedData);

            Log::info('Car fuel type updated successfully: ' . json_encode($fuelType));

            return response()->json(['success' => true, 'message' => 'Car fuel type updated successfully', 'data' => $fuelType], 200);
        } catch (\Exception $e) {
            Log::error('Error updating car fuel type with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Delete a car fuel type by its ID.
     *
     * @param int $id The ID of the car fuel type to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCarFuelType($id)
    {
        Log::info('Deleting car fuel type with ID: ' . $id);

        try {
            // Delete the car fuel type
            $this->destroy($id);

            // Log the successful delete operation
            Log::info('Car fuel type deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Car fuel type deleted successfully'], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the delete operation
            Log::error('Error deleting car fuel type with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}