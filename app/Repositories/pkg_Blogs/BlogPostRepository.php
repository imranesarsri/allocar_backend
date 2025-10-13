<?php

namespace App\Repositories\pkg_Blogs;

use App\Models\pkg_Blogs\BlogPost;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class BlogPostRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new BlogPost());
    }

    /**
     * Retrieve all blog posts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        try {
            $BlogPost = BlogPost::with([
                'author',
                'category',
                'tags',
                'comments'
            ])->get();
            return response()->json(['success' => true, $BlogPost], 200);
        } catch (Exception $exception) {
            // Log the error
            Log::error('Error retrieving all BlogPost: ' . $exception->getMessage());
            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }
    public function getRecentBlogsWithPagination($perPage = 5)
{
    try {
        $recentBlogs = BlogPost::with([
            'author',
            'category',
            'tags',
            'comments'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);

        return response()->json([
            'success' => true, 
            'data' => $recentBlogs->items(),
            'pagination' => [
                'current_page' => $recentBlogs->currentPage(),
                'last_page' => $recentBlogs->lastPage(),
                'per_page' => $recentBlogs->perPage(),
                'total' => $recentBlogs->total()
            ]
        ], 200);
        
    } catch (Exception $exception) {
        // Log the error
        Log::error('Error retrieving recent BlogPosts with pagination: ' . $exception->getMessage());
        
        // Return a 500 Internal Server Error response
        return response()->json([
            'success' => false, 
            'message' => 'Internal Server Error'
        ], 500);
    }
}
    /**
     * Retrieve paginated blog posts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        Log::info('Retrieving all BlogPost with pagination');
        try {
            $BlogPost = BlogPost::with([
                'author',
                'category',
                'tags',
                'comments'
            ])->paginate($this->paginationLimit);

            Log::info('Retrieved ' . $BlogPost->total() . ' Blog Post');

            return response()->json(['success' => true, $BlogPost], 200);
        } catch (Exception $exception) {
            // Log the error in case of exception
            Log::error('Error retrieving all Blog Post with pagination: ' . $exception->getMessage());

            // Return a 500 Internal Server Error response
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Find a blog post by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function findData($id)
    {
        Log::info('Finding Blog Post with ID: ' . $id);

        try {
            // Attempt to find the Blog Post by ID
            $BlogPost = BlogPost::with([
                'author',
                'category',
                'tags',
                'comments'
            ])->where('blog_post_id', $id)->firstOrFail();

            // Log the successful find operation
            Log::info('Blog Post found: ' . json_encode($BlogPost));

            // Return the found BlogPost data with a 200 OK status code
            return response()->json(['success' => true, $BlogPost], 200);
        } catch (\Exception $e) {
            // Log the error encountered during the find operation
            Log::error('Error finding Blog Post with ID: ' . $id . ', Error: ' . $e->getMessage());

            // Return a 404 Not Found response with an error message
            return response()->json(['success' => false, 'message' => 'Blog Post not found'], 404);
        }
    }


    /**
     * Create a new blog post.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function createData(Request $request)
    {
        try {
            $validatedData = $request->validated();

            // Extract tags from validated data
            $tagIds = isset($validatedData['tags']) ? $validatedData['tags'] : [];

            // Remove tags from the data to create the blog post
            if (isset($validatedData['tags'])) {
                unset($validatedData['tags']);
            }

            // Create the blog post
            $blogPost = $this->create($validatedData);

            // Attach tags to the blog post
            if (!empty($tagIds)) {
                $blogPost->tags()->attach($tagIds);
            }

            // Load relationships to return complete data
            $blogPost->load(['author', 'category', 'tags']);

            return response()->json([
                'success' => true,
                'message' => 'Blog post created successfully',
                'data' => $blogPost
            ], 201);


        } catch (Exception $exception) {
            // Log the error
            Log::error('Error creating BlogPost: ' . $exception->getMessage());

            // Return a 500 Internal Server Error response
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }



    /**
     * Update a blog post.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateData($id, Request $request)
    {

        try {
            // Validate the provided data
            $validatedData = $request->validated();

            // Extract tag IDs if provided
            $tagIds = $validatedData['tags'] ?? [];

            // Remove tags from the main data
            unset($validatedData['tags']);

            // Find the blog post to update
            $blogPost = $this->find($id);

            // Update the blog post fields
            $blogPost->update($validatedData);

            // Sync tags if provided
            if (!empty($tagIds)) {
                // Sync tags with the blog post
                $blogPost->tags()->sync($tagIds);
            }

            // Load relationships to return updated data
            $blogPost->load(['author', 'category', 'tags']);

            // Return a 200 OK response with the updated data
            return response()->json([
                'success' => true,
                'message' => 'Blog post updated successfully',
                'data' => $blogPost
            ], 200);

        } catch (Exception $exception) {
            // Roll back the database transaction if an error occurs
            DB::rollBack();

            // Log the error
            Log::error('Error updating BlogPost: ' . $exception->getMessage());

            // Return a 500 Internal Server Error response
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }


    /**
     * Delete a blog post by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {

        try {
            // Find the blog post or throw 404 if not found
            $blogPost = $this->find($id);

            // Detach all related tags (clean up pivot table)
            $blogPost->tags()->detach();

            // Delete the blog post
            $blogPost->delete();

            return response()->json([
                'success' => true,
                'message' => 'Blog post deleted successfully'
            ], 200);

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Error deleting BlogPost: ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

}