<?php

namespace App\Repositories\pkg_Agencies;

use App\Models\pkg_Agencies\Agency;
use App\Repositories\BaseImagesRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;


class AgencyImageRepository extends BaseImagesRepository
{
    public function __construct()
    {
        parent::__construct(new Agency());
    }

    public function uploadLogoImage(Request $request, $agency_id)
    {
        try {
            $agency = Agency::findOrFail($agency_id);

            // Validate the incoming file
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the validated file
            $image = $request->file('image');

            // Process the image using the uploadSingle method
            return $this->uploadSingle($image, $agency_id, "logo_agencies", "logo_url");

        } catch (ModelNotFoundException $exception) {
            Log::error('Error finding agency with ID: ' . $agency_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Agency not found'], 404);
        } catch (ValidationException $exception) {
            return response()->json(['field' => false, 'message' => 'Invalid image', 'errors' => $exception->errors()], 422);
        } catch (Exception $exception) {
            Log::error('Error uploading image for agency ID: ' . $agency_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Error uploading image'], 500);
        }
    }

    public function updateLogoImage(Request $request, $agency_id)
    {
        try {
            // Validate the request
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Extract data
            $image = $request->file('image');

            // Call the reusable update function
            return $this->update($image, $agency_id, "logo_agencies", "logo_url");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error in updateImage: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    public function deleteLogoImage($id)
    {
        try {

            // Call the delete method
            return $this->deleteColumn($id, "logo_url");

        } catch (Exception $exception) {
            // Log the error for debugging
            Log::error('Error in deleteImage: ' . $exception->getMessage());

            // Return a response with the error message
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $exception->getMessage()
            ], 500);
        }
    }


    // Cover image

    public function uploadCoverImage(Request $request, $agency_id)
    {
        try {
            $agency = Agency::findOrFail($agency_id);

            // Validate the incoming file
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the validated file
            $image = $request->file('image');

            // Process the image using the uploadSingle method
            return $this->uploadSingle($image, $agency_id, "cover_image_agencies", "cover_image_url");

        } catch (ModelNotFoundException $exception) {
            Log::error('Error finding agency with ID: ' . $agency_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Agency not found'], 404);
        } catch (ValidationException $exception) {
            return response()->json(['field' => false, 'message' => 'Invalid image', 'errors' => $exception->errors()], 422);
        } catch (Exception $exception) {
            Log::error('Error uploading image for agency ID: ' . $agency_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Error uploading image'], 500);
        }
    }

    public function updateCoverImage(Request $request, $agency_id)
    {
        try {
            // Validate the request
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Extract data
            $image = $request->file('image');

            // Call the reusable update function
            return $this->update($image, $agency_id, "cover_image_agencies", "cover_image_url");

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error in updateImage: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    public function deleteCoverImage($id)
    {
        try {

            // Call the delete method
            return $this->deleteColumn($id, "cover_image_url");

        } catch (Exception $exception) {
            // Log the error for debugging
            Log::error('Error in deleteImage: ' . $exception->getMessage());

            // Return a response with the error message
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $exception->getMessage()
            ], 500);
        }
    }



}
