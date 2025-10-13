<?php

namespace App\Repositories\pkg_Parameters;

use App\Models\pkg_Parameters\CarCity;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarCityRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new CarCity());
    }


    /**
     * Get all car cities
     *
     * @return Illuminate\Http\Response
     */
    public function getAllCarCities()
    {
        try {
            // Retrieve all car cities
            $carCities = $this->getAll();
            // Return the car cities with a 200 OK status code
            return response()->json(['success' => true, $carCities], 200);
        } catch (Exception $exception) {
            // Log the error
            Log::error('Error retrieving all car cities: ' . $exception->getMessage());
            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Get paginated car cities
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedCarCities()
    {
        // Log the start of pagination retrieval
        Log::info('Retrieving all car cities with pagination');
        try {
            // Retrieve car cities with pagination
            $carCities = $this->paginate();

            // Log the total number of car cities retrieved
            Log::info('Retrieved ' . $carCities->total() . ' car cities');

            // Return the car cities with a 200 OK status code
            return response()->json(['success' => true, $carCities], 200);
        } catch (Exception $exception) {
            // Log the error in case of exception
            Log::error('Error retrieving all car cities with pagination: ' . $exception->getMessage());

            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Find and retrieve a car city by its ID.
     *
     * @param int $id The ID of the car city to find.
     * @return \Illuminate\Http\JsonResponse The response containing car city data or an error message.
     */
    public function findCarCityById($id)
    {
        Log::info('Finding car city with ID: ' . $id);

        try {
            $carCity = $this->find($id);

            Log::info('Car city found: ' . json_encode($carCity));

            return response()->json(['success' => true, $carCity], 200);
        } catch (\Exception $e) {
            Log::error('Error finding car city with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Car city not found'], 404);
        }
    }


    /**
     * Create a new car city.
     *
     * @param CarCityRequest $data The request object containing car city data.
     * @return \Illuminate\Http\JsonResponse The response with created car city data or an error message.
     */
    public function createCarCity(Request $data)
    {
        Log::info('Creating new car city: ' . json_encode($data->all()));

        try {
            $validatedData = $data->validated();

            Log::info('Creating car city with validated data: ' . json_encode($validatedData));

            $newCarCity = $this->create($validatedData); // Assuming `create` is defined in BaseRepository

            Log::info('Car city created: ' . json_encode($newCarCity));

            return response()->json(['success' => true, $newCarCity], 201);
        } catch (\Exception $e) {
            Log::error('Error creating car city: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Update a car city by its ID.
     *
     * @param int $id The ID of the car city to be updated.
     * @param Request $request The request object containing the updated data.
     * @return \Illuminate\Http\JsonResponse The response with the updated car city data or an error message.
     */
    public function updateCarCity($id, Request $request)
    {
        Log::info('Updating car city with ID: ' . $id);

        try {
            $carCity = CarCity::find($id);

            $validatedData = $request->validated();
            Log::info('Validated data for car city update: ' . json_encode($validatedData));

            $carCity->update($validatedData);

            Log::info('Car city updated successfully: ' . json_encode($carCity));

            return response()->json(['success' => true, 'message' => 'Car City updated successfully', 'data' => $carCity], 200);
        } catch (\Exception $e) {
            Log::error('Error updating car city with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Delete a car city by its ID.
     *
     * @param int $id The ID of the car city to be deleted.
     * @return \Illuminate\Http\JsonResponse The response with success message or an error message.
     */
    public function deleteCarCity($id)
    {
        Log::info('Deleting car city with ID: ' . $id);

        try {
            $this->destroy($id);

            Log::info('Car city deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Car city deleted successfully'], 200);

        } catch (\Exception $e) {
            Log::error('Error deleting car city with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

}
