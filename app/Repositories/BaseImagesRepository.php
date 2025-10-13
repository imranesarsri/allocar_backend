<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Repositories\Contracts\ImagesInterface;

abstract class BaseImagesRepository implements ImagesInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Upload multiple images for a car
     *
     * @param array $images Array of uploaded image files
     * @param int $car_id The car ID to associate images with
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadMultiple($images, $car_id, $pathName)
    {
        try {
            $uploadedImages = [];

            // Loop through each image
            foreach ($images as $index => $image) {
                // Generate a unique filename
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Store the image in the public/car-images directory (or customize path)
                $path = $image->storeAs("{$pathName}/{$car_id}", $filename, 'public');

                // Full URL for the image (adjust the domain as needed)
                $imageUrl = asset('storage/' . $path);

                // Create an image record in the database
                $carImage = new $this->model([
                    'car_id' => $car_id,
                    'image_url' => $imageUrl,
                    'is_primary' => false // First image is primary by default
                ]);

                $carImage->save();
                $uploadedImages[] = $carImage;
            }

            return response()->json([
                'success' => true,
                'message' => count($uploadedImages) . ' images uploaded successfully',
                'images' => $uploadedImages
            ], 200);

        } catch (Exception $exception) {
            Log::error('Error in uploadMultiple: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload images: ' . $exception->getMessage()
            ], 500);
        }
    }


    public function uploadPrimary($image, $car_id, $pathName)
    {
        try {
            // Generate a unique filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the public/car-images directory (or customize path)
            $path = $image->storeAs("{$pathName}/{$car_id}", $filename, 'public');

            // Full URL for the image (adjust the domain as needed)
            $imageUrl = asset('storage/' . $path);

            // Create an image record in the database
            $carImage = new $this->model([
                'car_id' => $car_id,
                'image_url' => $imageUrl,
                'is_primary' => true
            ]);

            $carImage->save();

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'image' => $carImage
            ], 200);

        } catch (Exception $exception) {
            Log::error('Error in uploadPrimary: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $exception->getMessage()
            ], 500);
        }
    }


    public function uploadSingle($image, $id, $pathName, $attribute)
    {
        try {
            // Generate a unique filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified path
            $path = $image->storeAs("{$pathName}/{$id}", $filename, 'public');

            // Full URL for the image
            $imageUrl = asset('storage/' . $path);

            // Find the model by ID
            $model = $this->model::find($id);

            if (!$model) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
            }

            // Update the specified attribute with the image URL
            $model->$attribute = $imageUrl;
            $model->save();

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'data' => $model
            ], 200);

        } catch (Exception $exception) {
            Log::error('Error in uploadSingle: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $exception->getMessage()
            ], 500);
        }
    }


    public function update($image, $id, $pathName, $attribute)
    {
        try {
            // Find the model by ID
            $model = $this->model::find($id);

            if (!$model) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
            }

            // Delete the old image if it exists
            $oldImagePath = str_replace(asset('storage') . '/', '', $model->$attribute);
            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }

            // Generate a unique filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the new image
            $path = $image->storeAs("{$pathName}/{$id}", $filename, 'public');

            // Full URL for the new image
            $imageUrl = asset('storage/' . $path);

            // Update the model
            $model->$attribute = $imageUrl;
            $model->save();

            return response()->json([
                'success' => true,
                'message' => 'Image updated successfully',
                'data' => $model
            ], 200);

        } catch (Exception $exception) {
            Log::error('Error in updateSingle: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update image: ' . $exception->getMessage()
            ], 500);
        }
    }


    public function deleteColumn($id, $column)
    {
        try {
            // Find the model by ID
            $model = $this->model::find($id);

            if (!$model) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
            }

            // Check if the column exists on the model
            if (!in_array($column, $model->getFillable())) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid column: ' . $column
                ], 400);
            }

            // Get and format the image path
            $imagePath = str_replace(asset('storage') . '/', '', $model->$column);

            // Delete the image from storage if it exists
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Optionally reset the image column
            $model->$column = null;
            $model->save();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully',
                'data' => $model
            ], 200);

        } catch (Exception $exception) {
            Log::error('Error in delete: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $exception->getMessage()
            ], 500);
        }
    }


    public function deleteRow($id)
    {
        try {
            // Find the model by ID
            $model = $this->model::find($id);

            if (!$model) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found'
                ], 404);
            }

            // Delete the record
            $model->delete();

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully'
            ], 200);

        } catch (Exception $exception) {
            Log::error('Error in deleteRow: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete record: ' . $exception->getMessage()
            ], 500);
        }
    }

}