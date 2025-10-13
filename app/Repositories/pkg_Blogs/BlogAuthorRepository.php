<?php

namespace App\Repositories\pkg_Blogs;

use App\Models\pkg_Blogs\BlogAuthor;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;


class BlogAuthorRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new BlogAuthor());
    }

    /**
     * Retrieve all blog authors.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        try {
            $BlogAuthor = $this->getAll();
            return response()->json(['success' => true, $BlogAuthor], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all BlogAuthor: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Retrieve paginated blog authors.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        Log::info('Retrieving all BlogAuthor with pagination');
        try {
            $BlogAuthor = $this->paginate();

            Log::info('Retrieved ' . $BlogAuthor->total() . ' Blog Author');

            return response()->json(['success' => true, $BlogAuthor], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all Blog Author with pagination: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Find a blog author by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        Log::info('Finding Blog Author with ID: ' . $id);

        try {
            // Attempt to find the Blog Author by ID
            $BlogAuthor = $this->find($id);

            // Log the successful find operation
            Log::info('Blog Author found: ' . json_encode($BlogAuthor));

            // Return the found BlogAuthor data with a 200 OK status code
            return response()->json(['success' => true, $BlogAuthor], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the find operation
            Log::error('Error finding Blog Author with ID: ' . $id . ', Error: ' . $e->getMessage());

            // Return a 404 Not Found response with an error message
            return response()->json(['success' => false, 'message' => 'Blog Author not found'], 404);
        }
    }

    /**
     * Create a new blog author.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        Log::info('Creating new BlogAuthor: ' . json_encode($request->all()));

        try {
            // Validate the request
            $validatedData = $request->validated();

            // Log the validated data
            Log::info('Creating Blog Author with validated data: ' . json_encode($validatedData));

            // Attempt to create the BlogAuthor
            $BlogAuthor = $this->create($validatedData); // Assuming `create` is defined in BaseRepository

            // Log the successful create operation
            Log::info('BlogAuthor created: ' . json_encode($BlogAuthor));

            // Return the created BlogAuthor data with a 201 Created status code
            return response()->json(['success' => true, $BlogAuthor], 201);
        } catch (\Exception $e) {
            // Log the error encountered during the create operation
            Log::error('Error creating Blog Author: ' . $e->getMessage());

            // Return a 500 Internal Server Error response with an error message
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update an existing blog author.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateData($id, Request $request)
    {
        Log::info('Updating BlogAuthor with ID: ' . $id);

        try {
            // Find the BlogAuthor by its ID
            $BlogAuthor = BlogAuthor::find($id);

            // Get the validated data from the request
            $validatedData = $request->validated();
            Log::info('Validated data for Blog Author update: ' . json_encode($validatedData));

            // Update the BlogAuthor with the validated data
            $BlogAuthor->update($validatedData);

            // Log the successful update operation
            Log::info('Blog Author updated successfully: ' . json_encode($BlogAuthor));

            // Return the updated BlogAuthor
            return response()->json(['success' => true, 'message' => 'Blog Author updated successfully', 'data' => $BlogAuthor], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the update operation
            Log::error('Error updating Blog Author with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Delete a blog author by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        Log::info('Deleting Blog Author with ID: ' . $id);

        try {
            // Delete the Blog Author
            $this->destroy($id);

            // Log the successful delete operation
            Log::info('Blog Author deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Blog Author deleted successfully'], 200);

        } catch (\Exception $e) {
            // Log the error encountered during the delete operation
            Log::error('Error deleting Blog Author with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}