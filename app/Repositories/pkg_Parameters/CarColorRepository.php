<?php

namespace App\Repositories\pkg_Parameters;

use App\Models\pkg_Parameters\CarColor;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CarColorRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new CarColor());
    }


    /**
     * Retrieve all car colors.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCarColors()
    {
        try {
            $carColors = $this->getAll();
            return response()->json(["token"=>csrf_token(), 'success' => true, $carColors], 200);
            Log::info('Retrieved all car colors: ' . json_encode($carColors));
        } catch (Exception $exception) {
            Log::error('Error retrieving all car cities: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }
    /**
     * Retrieve paginated car colors.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function getPaginatedCarColors()
    {

        Log::info('Retrieving all car colors with pagination');
        try {
            $carColors = $this->paginate();

            Log::info('Retrieved ' . $carColors->total() . ' car colors');
            return response()->json(['success' => true, $carColors], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car colors with pagination: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Find and retrieve a car color by its ID.
     *
     * @param int $id The ID of the car color to find.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCarColorById($id)
    {
        Log::info('Finding car color with ID: ' . $id);

        try {
            $carColor = $this->find($id);

            Log::info('Car color found: ' . json_encode($carColor));

            return response()->json(['success' => true, $carColor], 200);
        } catch (\Exception $e) {
            Log::error('Error finding car color with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Car color not found'], 404);
        }
    }


    /**
     * Create a new car color.
     *
     * @param Request $data The request object containing car color data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCarColor(Request $data)
    {
        Log::info('Creating new car Color: ' . json_encode($data->all()));

        try {
            $validatedData = $data->validated();

            Log::info('Creating car Color with validated data: ' . json_encode($validatedData));

            $newCarColor = $this->create($validatedData); // Assuming `create` is defined in BaseRepository

            Log::info('Car Color created: ' . json_encode($newCarColor));

            return response()->json(['success' => true, $newCarColor], 201);
        } catch (\Exception $e) {
            Log::error('Error creating car Color: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Update a car color by its ID.
     *
     * @param int $id The ID of the car color to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCarColor($id, Request $request)
    {
        Log::info('Updating car color with ID: ' . $id);

        try {
            $carColor = CarColor::find($id);

            $validatedData = $request->validated();
            Log::info('Validated data for car color update: ' . json_encode($validatedData));

            $carColor->update($validatedData);

            Log::info('Car color updated successfully: ' . json_encode($carColor));

            return response()->json(['success' => true, 'message' => 'Car Color updated successfully', 'data' => $carColor], 200);
        } catch (\Exception $e) {
            Log::error('Error updating car color with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Delete a car color by its ID.
     *
     * @param int $id The ID of the car color to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCarColor($id)
    {
        Log::info('Deleting car color with ID: ' . $id);

        try {
            $this->destroy($id);

            Log::info('Car color deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Car color deleted successfully'], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting car color with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
