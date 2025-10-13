<?php
namespace App\Repositories\pkg_Cars;

use App\Models\pkg_Cars\Car;
use App\Repositories\BaseImagesRepository;
use App\Models\pkg_Cars\CarImage;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class CarImageRepository extends BaseImagesRepository
{
    /**
     * Get searchable fields array
     *
     * @return array
     */

    public function __construct()
    {
        parent::__construct(new CarImage());
    }


    public function uploadMultipleImages(Request $request, $car_id)
    {
        try {
            $car = Car::findOrFail($car_id);

            // Validate the incoming files
            $validated = $request->validate([
                'images' => 'required|array',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the validated files
            $images = $request->file('images');

            // Process the images (assuming you have an uploadMultiple method)
            return $this->uploadMultiple($images, $car_id, "car_images");

        } catch (ModelNotFoundException $exception) {
            Log::error('Error finding car with ID: ' . $car_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Car not found'], 404);
        } catch (ValidationException $exception) {
            return response()->json(['field' => false, 'message' => 'Invalid images', 'errors' => $exception->errors()], 422);
        } catch (Exception $exception) {
            Log::error('Error uploading images for car ID: ' . $car_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Error uploading images'], 500);
        }
    }


    public function uploadPrimaryImage(Request $request, $car_id)
    {
        try {
            $car = Car::findOrFail($car_id);

            // Validate the incoming file
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the validated file
            $image = $request->file('image');

            // Process the image using the uploadSingle method
            return $this->uploadPrimary($image, $car_id, "car_images");

        } catch (ModelNotFoundException $exception) {
            Log::error('Error finding car with ID: ' . $car_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Car not found'], 404);
        } catch (ValidationException $exception) {
            return response()->json(['field' => false, 'message' => 'Invalid image', 'errors' => $exception->errors()], 422);
        } catch (Exception $exception) {
            Log::error('Error uploading image for car ID: ' . $car_id . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Error uploading image'], 500);
        }
    }


    public function updateImage(Request $request, $car_id)
    {
        try {
            // Validate the request
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Extract data
            $image = $request->file('image');

            // Call the reusable update function
            return $this->update($image, $car_id, "car_images", "image_url");

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


    public function deleteImage($id)
    {
        try {
            // Call the delete method
            return $this->deleteRow($id);

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