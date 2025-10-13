<?php

namespace App\Repositories\pkg_Parameters;

use App\Models\pkg_Parameters\CarCategory;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarCategoryRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new CarCategory());
    }

    /**
     * Retrieve all car categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCarCategories()
    {
        try {
            $carCategories = $this->getAll();

            return response()->json(['success' => true, $carCategories], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car categories: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Retrieve paginated car categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaginatedCarCategories()
    {
        Log::info('Retrieving all car categories with pagination');

        try {
            $carCategories = $this->paginate();

            Log::info('Retrieved ' . $carCategories->total() . ' car categories');

            return response()->json(['success' => true, $carCategories], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car categories with pagination: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Find and retrieve a car category by its ID.
     *
     * @param int $id The ID of the car category to find.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findCarCategoryById($id)
    {
        Log::info('Finding car category with ID: ' . $id);

        try {
            $carCategory = $this->find($id);

            Log::info('Car category found: ' . json_encode($carCategory));

            return response()->json(['success' => true, $carCategory], 200);
        } catch (Exception $e) {
            Log::error('Error finding car category with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Car category not found'], 404);
        }
    }

    /**
     * Create a new car category.
     *
     * @param Request $request The request object containing car category data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCarCategory(Request $request)
    {
        Log::info('Creating new car category: ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();
            Log::info('Creating car category with validated data: ' . json_encode($validatedData));

            $newCategory = $this->create($validatedData);

            Log::info('Car category created: ' . json_encode($newCategory));

            return response()->json(['success' => true, $newCategory], 201);
        } catch (Exception $e) {
            Log::error('Error creating car category: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update a car category by its ID.
     *
     * @param int $id The ID of the car category to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCarCategory($id, Request $request)
    {
        Log::info('Updating car category with ID: ' . $id);

        try {
            $carCategory = $this->find($id);

            $validatedData = $request->validated();
            Log::info('Validated data for car category update: ' . json_encode($validatedData));

            $carCategory->update($validatedData);

            Log::info('Car category updated successfully: ' . json_encode($carCategory));

            return response()->json(['success' => true, 'message' => 'Car category updated successfully', 'data' => $carCategory], 200);
        } catch (Exception $e) {
            Log::error('Error updating car category with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Delete a car category by its ID.
     *
     * @param int $id The ID of the car category to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCarCategory($id)
    {
        Log::info('Deleting car category with ID: ' . $id);

        try {
            $this->destroy($id);

            Log::info('Car category deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Car category deleted successfully'], 200);
        } catch (Exception $e) {
            Log::error('Error deleting car category with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
