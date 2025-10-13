<?php

namespace App\Repositories\pkg_Blogs;

use App\Models\pkg_Blogs\BlogComment;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class BlogCommentRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new BlogComment());
    }

    /**
     * Retrieve all blog comments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        try {
            $BlogComment = $this->getAll();
            return response()->json(['success' => true, $BlogComment], 200);
        } catch (Exception $exception) {
            // Log the error
            Log::error('Error retrieving all Blog Comment: ' . $exception->getMessage());
            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Retrieve paginated blog comments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        Log::info('Retrieving all BlogComment with pagination');
        try {
            $BlogComment = $this->paginate();

            Log::info('Retrieved ' . $BlogComment->total() . ' BlogComment');

            return response()->json(['success' => true, $BlogComment], 200);
        } catch (Exception $exception) {
            // Log the error in case of exception
            Log::error('Error retrieving all BlogComment with pagination: ' . $exception->getMessage());

            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Find a blog comment by its ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        Log::info('Finding Blog Comment with ID: ' . $id);

        try {
            // Attempt to find the Blog Comment by ID
            $BlogComment = $this->find($id);

            // Log the successful find operation
            Log::info('Blog Comment found: ' . json_encode($BlogComment));

            // Return the found BlogComment data with a 200 OK status code
            return response()->json(['success' => true, $BlogComment], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the find operation
            Log::error('Error finding Blog Comment with ID: ' . $id . ', Error: ' . $e->getMessage());

            // Return a 404 Not Found response with an error message
            return response()->json(['success' => false, 'message' => 'Blog Comment not found'], 404);
        }
    }

    /**
     * Create a new blog comment.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        Log::info('Creating new BlogComment: ' . json_encode($request->all()));

        try {
            // Validate the request
            $validatedData = $request->validated();

            // Log the validated data
            Log::info('Creating Blog Comment with validated data: ' . json_encode($validatedData));

            // Attempt to create the BlogComment
            $BlogComment = $this->create($validatedData); // Assuming `create` is defined in BaseRepository

            // Log the successful create operation
            Log::info('BlogComment created: ' . json_encode($BlogComment));

            // Return the created BlogComment data with a 201 Created status code
            return response()->json(['success' => true, $BlogComment], 201);
        } catch (\Exception $e) {
            // Log the error encountered during the create operation
            Log::error('Error creating Blog Comment: ' . $e->getMessage());

            // Return a 500 Internal Server Error response with an error message
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update an existing blog comment.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateData($id, Request $request)
    {
        Log::info('Updating BlogComment with ID: ' . $id);

        try {
            // Find the BlogComment by its ID
            $BlogComment = BlogComment::find($id);

            // Get the validated data from the request
            $validatedData = $request->validated();
            Log::info('Validated data for Blog Comment update: ' . json_encode($validatedData));

            // Update the BlogComment with the validated data
            $BlogComment->update($validatedData);

            // Log the successful update operation
            Log::info('Blog Comment updated successfully: ' . json_encode($BlogComment));

            // Return the updated BlogComment
            return response()->json(['success' => true, 'message' => 'Blog Comment updated successfully', 'data' => $BlogComment], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the update operation
            Log::error('Error updating Blog Comment with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Delete a blog comment by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        Log::info('Deleting Blog Comment with ID: ' . $id);

        try {
            // Delete the Blog Comment
            $this->destroy($id);

            // Log the successful delete operation
            Log::info('Blog Comment deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Blog Comment deleted successfully'], 200);

        } catch (\Exception $e) {
            // Log the error encountered during the delete operation
            Log::error('Error deleting Blog Comment with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
