<?php

namespace App\Repositories\pkg_Blogs;

use App\Models\pkg_Blogs\BlogTag;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogTagRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new BlogTag());
    }

    /**
     * Retrieve all blog tags.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        try {
            $BlogTag = $this->getAll();
            return response()->json(['success' => true, $BlogTag], 200);
        } catch (Exception $exception) {
            // Log the error
            Log::error('Error retrieving all BlogTag: ' . $exception->getMessage());
            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Retrieve paginated blog tags.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        Log::info('Retrieving all BlogTag with pagination');
        try {
            $BlogTag = $this->paginate();

            Log::info('Retrieved ' . $BlogTag->total() . ' BlogTag');

            return response()->json(['success' => true, $BlogTag], 200);
        } catch (Exception $exception) {
            // Log the error in case of exception
            Log::error('Error retrieving all BlogTag with pagination: ' . $exception->getMessage());

            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Find a blog tag by its ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        Log::info('Finding Blog Tag with ID: ' . $id);

        try {
            // Attempt to find the Blog Tag by ID
            $BlogTag = $this->find($id);

            // Log the successful find operation
            Log::info('Blog Tag found: ' . json_encode($BlogTag));

            // Return the found BlogTag data with a 200 OK status code
            return response()->json(['success' => true, $BlogTag], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the find operation
            Log::error('Error finding Blog Tag with ID: ' . $id . ', Error: ' . $e->getMessage());

            // Return a 404 Not Found response with an error message
            return response()->json(['success' => false, 'message' => 'Blog Tag not found'], 404);
        }
    }

    /**
     * Create a new blog tag.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        Log::info('Creating new BlogTag: ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();

            Log::info('Creating Blog Tag with validated data: ' . json_encode($validatedData));

            $BlogTag = $this->create($validatedData); // Assuming `create` is defined in BaseRepository
            Log::info('BlogTag created: ' . json_encode($BlogTag));

            return response()->json(['success' => true, $BlogTag], 201);
        } catch (\Exception $e) {
            Log::error('Error creating Blog Tag: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update an existing blog tag.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateData($id, Request $request)
    {
        Log::info('Updating BlogTag with ID: ' . $id);

        try {
            // Find the BlogTag by its ID
            $BlogTag = BlogTag::find($id);

            // Get the validated data from the request
            $validatedData = $request->validated();
            Log::info('Validated data for Blog Tag update: ' . json_encode($validatedData));

            // Update the BlogTag with the validated data
            $BlogTag->update($validatedData);

            // Log the successful update operation
            Log::info('Blog Tag updated successfully: ' . json_encode($BlogTag));

            // Return the updated BlogTag
            return response()->json(['success' => true, 'message' => 'Blog Tag updated successfully', 'data' => $BlogTag], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the update operation
            Log::error('Error updating Blog Tag with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Delete a blog tag (soft delete).
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        Log::info('Deleting Blog Tag with ID: ' . $id);

        try {
            // Delete the Blog Tag
            $this->destroy($id);

            // Log the successful delete operation
            Log::info('Blog Tag deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Blog Tag deleted successfully'], 200);

        } catch (\Exception $e) {
            // Log the error encountered during the delete operation
            Log::error('Error deleting Blog Tag with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
