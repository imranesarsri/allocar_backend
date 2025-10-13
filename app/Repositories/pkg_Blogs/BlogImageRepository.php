<?php

namespace App\Repositories\pkg_Blogs;

use App\Models\pkg_Blogs\BlogPost;
use App\Repositories\BaseImagesRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;


class BlogImageRepository extends BaseImagesRepository
{
    public function __construct()
    {
        parent::__construct(new BlogPost());
    }

    public function uploadSingleImage(Request $request, $blogPostId)
    {
        try {
            $blog = BlogPost::findOrFail($blogPostId);

            // Validate the incoming file
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the validated file
            $image = $request->file('image');

            // Process the image using the uploadSingle method
            return $this->uploadSingle($image, $blogPostId, "blogs_featured_images", "featured_image");

        } catch (ModelNotFoundException $exception) {
            Log::error('Error finding blog with ID: ' . $blogPostId . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Blog not found'], 404);
        } catch (ValidationException $exception) {
            return response()->json(['field' => false, 'message' => 'Invalid image', 'errors' => $exception->errors()], 422);
        } catch (Exception $exception) {
            Log::error('Error uploading image for blog ID: ' . $blogPostId . ' - ' . $exception->getMessage());
            return response()->json(['field' => false, 'message' => 'Error uploading image'], 500);
        }
    }

    public function updateImage(Request $request, $blogPostId)
    {
        // dd($request->file('image'));
        try {
            // Validate the request
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Extract data
            $image = $request->file('image');

            // Call the reusable update function
            return $this->update($image, $blogPostId, "blogs_featured_images", "featured_image");

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
            return $this->deleteColumn($id, "featured_image");

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
