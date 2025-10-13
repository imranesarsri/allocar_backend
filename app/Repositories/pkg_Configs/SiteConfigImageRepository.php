<?php

namespace App\Repositories\pkg_Configs;

use App\Models\pkg_Configs\SiteConfig;
use App\Repositories\BaseImagesRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;


class SiteConfigImageRepository extends BaseImagesRepository
{
    public function __construct()
    {
        parent::__construct(new SiteConfig());
    }

    public function uploadLightLogo(Request $request, $site_config_id)
    {
        try {
            $siteConfig = SiteConfig::findOrFail($site_config_id);

            // Validate the incoming file
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the validated file
            $image = $request->file('image');

            // Process the image using the uploadSingle method
            return $this->uploadSingle($image, $site_config_id, "configLightLogos", "site_logo");

        } catch (ModelNotFoundException $exception) {
            Log::error('Error finding siteConfig with ID: ' . $site_config_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'siteConfig not found'], 404);
        } catch (ValidationException $exception) {
            return response()->json(['field' => false, 'message' => 'Invalid image', 'errors' => $exception->errors()], 422);
        } catch (Exception $exception) {
            Log::error('Error uploading image for siteConfig ID: ' . $site_config_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Error uploading image'], 500);
        }
    }

    public function updateLightLogo(Request $request, $site_config_id)
    {
        try {
            // Validate the request
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Extract data
            $image = $request->file('image');

            // Call the reusable update function
            return $this->update($image, $site_config_id, "configLightLogos", "site_logo");

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


    public function deleteLightLogo($id)
    {
        try {

            // Call the delete method
            return $this->deleteColumn($id, "site_logo");

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


    // Dark logos

    public function uploadDarkImage(Request $request, $site_config_id)
    {
        try {
            $siteConfig = siteConfig::findOrFail($site_config_id);

            // Validate the incoming file
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the validated file
            $image = $request->file('image');

            // Process the image using the uploadSingle method
            return $this->uploadSingle($image, $site_config_id, "configDarkLogos", "site_logo_dark");

        } catch (ModelNotFoundException $exception) {
            Log::error('Error finding siteConfig with ID: ' . $site_config_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'siteConfig not found'], 404);
        } catch (ValidationException $exception) {
            return response()->json(['field' => false, 'message' => 'Invalid image', 'errors' => $exception->errors()], 422);
        } catch (Exception $exception) {
            Log::error('Error uploading image for siteConfig ID: ' . $site_config_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Error uploading image'], 500);
        }
    }

    public function updateDarkImage(Request $request, $site_config_id)
    {
        try {
            // Validate the request
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Extract data
            $image = $request->file('image');

            // Call the reusable update function
            return $this->update($image, $site_config_id, "configDarkLogos", "site_logo_dark");

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


    public function deleteDarkImage($id)
    {
        try {
            // Call the delete method
            return $this->deleteColumn($id, "site_logo_dark");

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
