<?php

namespace App\Repositories\pkg_Reviews;

use App\Models\pkg_Reviews\CarReview;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarReviewRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new CarReview());
    }

    /**
     * Retrieve all car reviews.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        try {
            $carReview = $this->getAll();
            return response()->json(['success' => true, $carReview], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving Car reviews: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     *   Récupérer les avis paginés
     */
    public function getDataByPages()
    {
        Log::info('Retrieving all Car reviews with pagination');
        try {
            $carReview = $this->paginate();
            Log::info('Retrieved ' . $carReview->total() . ' car reviews');
            return response()->json(['success' => true, $carReview], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all car reviews with pagination: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     *   Trouver un avis par ID
     */
    public function findData($id)
    {
        Log::info('Finding car reviews with ID: ' . $id);

        try {
            $carReview = $this->find($id);
            Log::info('car reviews found: ' . json_encode($carReview));
            return response()->json(['success' => true, $carReview], 200);
        } catch (\Exception $e) {
            Log::error('Error finding car review with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'car review not found'], 404);
        }
    }

    /**
     *   Création d'un avis sur une voiture
     */
    public function createData(Request $request)
    {
        Log::info('Creating new car review: ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();
            Log::info('Creating car review with validated data: ' . json_encode($validatedData));
            $newCarReview = $this->create($validatedData);
            Log::info('car review created: ' . json_encode($newCarReview));
            return response()->json(['success' => true, $newCarReview], 201);
        } catch (\Exception $e) {
            Log::error('Error creating car review: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     *   Mise à jour d'un avis sur une voiture
     */
    public function updateData($id, Request $request)
    {
        Log::info('Updating agencyReview with ID: ' . $id);

        try {
            $carReview = CarReview::find($id);
            $validatedData = $request->validated();
            Log::info('Validated data for car Review update: ' . json_encode($validatedData));
            $carReview->update($validatedData);
            Log::info('car Review updated successfully: ' . json_encode($carReview));
            return response()->json(['success' => true, 'message' => 'car Review updated successfully', 'data' => $carReview], 200);
        } catch (\Exception $e) {
            Log::error('Error updating car Review with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     *   Suppression d'un avis (soft delete)
     */
    public function deleteData($id)
    {
        Log::info('Deleting car review with ID: ' . $id);

        try {
            $this->destroy($id);
            Log::info('car review deleted successfully: ' . $id);
            return response()->json(['success' => true, 'message' => 'car review deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting car review with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
