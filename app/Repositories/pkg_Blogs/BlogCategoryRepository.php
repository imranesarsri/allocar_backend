<?php

namespace App\Repositories\pkg_Blogs;

use App\Models\pkg_Blogs\BlogCategory;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class BlogCategoryRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new BlogCategory());
    }

    /**
     * Retrieve all blog categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        try {
            $BlogCategory = $this->getAll();
            return response()->json(['success' => true, $BlogCategory], 200);
        } catch (Exception $exception) {
            // Log the error
            Log::error('Error retrieving all BlogCategory: ' . $exception->getMessage());
            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Retrieve paginated blog categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        Log::info('Retrieving all BlogCategory with pagination');
        try {
            $BlogCategory = $this->paginate();

            Log::info('Retrieved ' . $BlogCategory->total() . ' Blog Category');

            return response()->json(['success' => true, $BlogCategory], 200);
        } catch (Exception $exception) {
            // Log the error in case of exception
            Log::error('Error retrieving all Blog Category with pagination: ' . $exception->getMessage());

            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Find a blog category by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        Log::info('Finding Blog Category with ID: ' . $id);

        try {
            // Attempt to find the Blog Category by ID
            $BlogCategory = $this->find($id);

            // Log the successful find operation
            Log::info('Blog Category found: ' . json_encode($BlogCategory));

            // Return the found BlogCategory data with a 200 OK status code
            return response()->json(['success' => true, $BlogCategory], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the find operation
            Log::error('Error finding Blog Category with ID: ' . $id . ', Error: ' . $e->getMessage());

            // Return a 404 Not Found response with an error message
            return response()->json(['success' => false, 'message' => 'Blog Category not found'], 404);
        }
    }

    /**
     * Create a new blog category.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        Log::info('Creating new BlogCategory: ' . json_encode($request->all()));

        try {
            // Validate the request
            $validatedData = $request->validated();

            // Log the validated data
            Log::info('Creating Blog Category with validated data: ' . json_encode($validatedData));

            // Attempt to create the BlogCategory
            $BlogCategory = $this->create($validatedData); // Assuming `create` is defined in BaseRepository

            // Log the successful create operation
            Log::info('BlogCategory created: ' . json_encode($BlogCategory));

            // Return the created BlogCategory data with a 201 Created status code
            return response()->json(['success' => true, $BlogCategory], 201);
        } catch (\Exception $e) {
            // Log the error encountered during the create operation
            Log::error('Error creating Blog Category: ' . $e->getMessage());

            // Return a 500 Internal Server Error response with an error message
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update an existing blog category.
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateData($id, Request $request)
    {
        Log::info('Updating BlogCategory with ID: ' . $id);

        try {
            // Find the BlogCategory by its ID
            $BlogCategory = BlogCategory::find($id);

            // Get the validated data from the request
            $validatedData = $request->validated();
            Log::info('Validated data for Blog Category update: ' . json_encode($validatedData));

            // Update the BlogCategory with the validated data
            $BlogCategory->update($validatedData);

            // Log the successful update operation
            Log::info('Blog Category updated successfully: ' . json_encode($BlogCategory));

            // Return the updated BlogCategory
            return response()->json(['success' => true, 'message' => 'Blog Category updated successfully', 'data' => $BlogCategory], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the update operation
            Log::error('Error updating Blog Category with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Delete a blog category by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        Log::info('Deleting Blog Category with ID: ' . $id);

        try {
            // Delete the Blog Category
            $this->destroy($id);

            // Log the successful delete operation
            Log::info('Blog Category deleted successfully: ' . $id);

            return response()->json(['success' => true, 'message' => 'Blog Category deleted successfully'], 200);

        } catch (\Exception $e) {
            // Log the error encountered during the delete operation
            Log::error('Error deleting Blog Category with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}