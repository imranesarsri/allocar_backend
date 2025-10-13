<?php

namespace App\Repositories\pkg_Reviews;

use App\Models\pkg_Reviews\AgencyReview;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgencyReviewRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new AgencyReview());
    }

    /**
     * Retrieve all agency reviews.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        try {
            $agencyReview = $this->getAll();
            return response()->json(['success' => true, $agencyReview], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving Agency reviews cities: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Retrieve paginated agency reviews.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        Log::info('Retrieving all agency reviews with pagination');
        try {
            $agencyReview = $this->paginate();
            Log::info('Retrieved ' . $agencyReview->total() . ' agency reviews');
            return response()->json(['success' => true, $agencyReview], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all agency reviews with pagination: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Find an agency review by ID.
     *
     * @param int $id The ID of the review to find.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        Log::info('Finding agency reviews with ID: ' . $id);

        try {
            $agencyReview = $this->find($id);
            Log::info('agency reviews found: ' . json_encode($agencyReview));
            return response()->json(['success' => true, $agencyReview], 200);
        } catch (\Exception $e) {
            Log::error('Error finding agency review with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'agency review not found'], 404);
        }
    }

    /**
     * Create a new agency review.
     *
     * @param Request $request The request object containing review data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        Log::info('Creating new agency review: ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();
            Log::info('Creating agency review with validated data: ' . json_encode($validatedData));
            $newAgencyReview = $this->create($validatedData);
            Log::info('agency review created: ' . json_encode($newAgencyReview));
            return response()->json(['success' => true, $newAgencyReview], 201);
        } catch (\Exception $e) {
            Log::error('Error creating agency review: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update an existing agency review.
     *
     * @param int $id The ID of the review to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */

    public function updateData($id, Request $request)
    {
        Log::info('Updating agencyReview with ID: ' . $id);

        try {
            $agencyReview = AgencyReview::find($id);
            $validatedData = $request->validated();
            Log::info('Validated data for agencyReview update: ' . json_encode($validatedData));
            $agencyReview->update($validatedData);
            Log::info('agencyReview updated successfully: ' . json_encode($agencyReview));
            return response()->json(['success' => true, 'message' => 'agencyReview updated successfully', 'data' => $agencyReview], 200);
        } catch (\Exception $e) {
            Log::error('Error updating agencyReview with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Delete an agency review.
     *
     * @param int $id The ID of the review to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        Log::info('Deleting agency review with ID: ' . $id);

        try {
            $this->destroy($id);
            Log::info('agency review deleted successfully: ' . $id);
            return response()->json(['success' => true, 'message' => 'agency review deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting agency review with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
