<?php

namespace App\Repositories\pkg_Configs;

use App\Models\pkg_Configs\SiteConfig;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SiteConfigRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new SiteConfig());
    }

    /**
     * Retrieve all site configurations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConfig()
    {
        try {
            $SiteConfig = $this->getAll();
            return response()->json(['success' => true, $SiteConfig], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all site configs: ' . $exception->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }
    /**
     * Retrieve paginated site configurations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        Log::info('Retrieving all site config with pagination');
        try {
            $siteConfig = $this->paginate();

            Log::info('Retrieved ' . $siteConfig->total() . ' site config');

            return response()->json(['success' => true, $siteConfig], 200);
        } catch (Exception $exception) {
            Log::error('Error retrieving all site config with pagination: ' . $exception->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }
    /**
     * Find and retrieve a site configuration by its ID.
     *
     * @param int $id The ID of the site configuration.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        Log::info('Finding site config with ID: ' . $id);

        try {
            $siteConfig = $this->find($id);

            Log::info('site config found: ' . json_encode($siteConfig));

            return response()->json(['success' => true, $siteConfig], 200);
        } catch (\Exception $e) {
            Log::error('Error finding site config with ID: ' . $id . ', Error: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'site config not found'], 404);
        }
    }
    /**
     * Create a new site configuration.
     *
     * @param Request $request The request object containing configuration data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        Log::info('Creating new site config: ' . json_encode($request->all()));

        try {
            $validatedData = $request->validated();
            Log::info('Creating site config with validated data: ' . json_encode($validatedData));
            $newsiteConfig = $this->create($validatedData);
            Log::info('Car city created: ' . json_encode($newsiteConfig));
            return response()->json(['success' => true, $newsiteConfig], 201);
        } catch (\Exception $e) {
            Log::error('Error creating site config: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update a site configuration by its ID.
     *
     * @param int $id The ID of the site configuration to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateConfig($id, Request $request)
    {
        Log::info('Updating site config with ID: ' . $id);

        try {
            $siteConfig = SiteConfig::find($id);
            $validatedData = $request->validated();
            Log::info('Validated data for site config update: ' . json_encode($validatedData));
            $siteConfig->update($validatedData);
            Log::info('site config updated successfully: ' . json_encode($siteConfig));
            return response()->json(['success' => true, 'message' => 'site config updated successfully', 'data' => $siteConfig], 200);
        } catch (\Exception $e) {
            Log::error('Error updating site config with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }
    /**
     * Delete a site configuration by its ID.
     *
     * @param int $id The ID of the site configuration to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        Log::info('Deleting site config with ID: ' . $id);

        try {
            $this->destroy($id);
            Log::info('site config deleted successfully: ' . $id);
            return response()->json(['success' => true, 'message' => 'site config deleted successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting site config with ID: ' . $id . ', Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong', 'error' => $e->getMessage()], 500);
        }
    }
}
