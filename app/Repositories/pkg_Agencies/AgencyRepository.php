<?php

namespace App\Repositories\pkg_Agencies;

use App\Exceptions\pkg_Agencies\AgenceException;
use App\Models\pkg_Agencies\Agency;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgencyRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Agency());
    }

    /**
     * Retrieve all agencies.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        try {
            // For public access (homepage), return all agencies
            // Check if user is authenticated, but don't fail if not
            $user = null;
            try {
                $user = auth()->user();
            } catch (Exception $e) {
                // Authentication failed, continue as public user
                Log::info('Public access to agencies endpoint');
            }

            // For now, always return all agencies for public access
            // This can be refined later with proper authentication
            $agencies = Agency::select([
                'agency_id',
                'agency_name', 
                'city',
                'logo_url',
                'cover_image_url',
                'address',
                'phone_number_1',
                'email',
                'website'
            ])->get();

            return response()->json([
                'success' => true,
                'data' => $agencies
            ], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving agencies: ' . $exception->getMessage());
            Log::error('Stack trace: ' . $exception->getTraceAsString());
            return response()->json([
                'success' => false, 
                'message' => 'Internal Server Error',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function getCount()
    {
        return Agency::count();
    }

    /**
     * Retrieve paginated list of agencies.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        Log::info('Retrieving agencies with pagination');

        try {
            $user = auth()->user();

            if (!$user) {
                $agencies = Agency::paginate($this->paginationLimit);
            } else if ($user->hasRole('super admin')) {
                $agencies = Agency::paginate($this->paginationLimit);
            } else {
                $agencies = Agency::where('user_id', $user->user_id)->paginate($this->paginationLimit);
            }

            Log::info('Retrieved ' . $agencies->total() . ' agencies');

            return response()->json(['success' => true, 'data' => $agencies], 200);
        } catch (AgenceException $exception) {
            Log::error('Error retrieving agencies with pagination: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Find and retrieve an agency by its ID.
     *
     * @param int $id The ID of the agency.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        Log::info('Finding agency with ID: ' . $id);

        try {
            $agency = $this->find($id);
            Log::info('Agency found: ' . json_encode($agency));

            return response()->json(['success' => true, $agency], 200);
        } catch (Exception $exception) {
            Log::error('Error finding agency with ID: ' . $id . ', Error: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Agency not found'], 404);
        }
    }

    /**
     * Create a new agency.
     *
     * @param Request $request The request object containing agency data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        Log::info('Creating new agency : ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();
            Log::info('Creating agency with validated data: ' . json_encode($validatedData));
            $newAgency = $this->create($validatedData);
            Log::info('Agency created: ' . json_encode($newAgency));
            return response()->json(['success' => true, $newAgency], 201);
        } catch (\Exception $e) {
            Log::error('Error creating Agency: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update an existing agency by its ID.
     *
     * @param int $id The ID of the agency.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateData($id, Request $request)
    {
        Log::info('Updating agency with ID: ' . $id);

        try {
            $agency = Agency::find($id);
            $validatedData = $request->validated();
            Log::info('Validated data for agency update: ' . json_encode($validatedData));
            $agency->update($validatedData);
            Log::info('agency updated successfully: ' . json_encode($agency));
            return response()->json(['success' => true, 'message' => 'agency updated successfully', 'data' => $agency], 200);
        } catch (\Exception $e) {
            Log::error('Error updating agency with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Delete an agency by its ID.
     *
     * @param int $id The ID of the agency.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        Log::info('Deleting agency with ID: ' . $id);

        try {
            $this->destroy($id);

            Log::info('agency deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'agency deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting agency with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }

}
