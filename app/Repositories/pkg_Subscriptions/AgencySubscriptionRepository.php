<?php

namespace App\Repositories\pkg_Subscriptions;

use App\Models\pkg_Subscriptions\AgencySubscription;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class AgencySubscriptionRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new AgencySubscription());
    }

    /**
     * Retrieve all agency subscriptions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllData()
    {
        return response()->json($this->getAll(), 200);
    }

    /**
     * Retrieve paginated agency subscriptions.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataByPages()
    {
        // Eager load agency and package relationships
        $subscriptions = AgencySubscription::with(['agency', 'package'])->paginate($this->paginationLimit);
        return response()->json($subscriptions, 200);
    }

    /**
     * Find and retrieve a subscription by its ID.
     *
     * @param int $id The ID of the subscription to retrieve.
     * @return \Illuminate\Http\JsonResponse
     */
    public function findData($id)
    {
        $subscription = $this->find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }
        return response()->json($subscription, 200);
    }

    /**
     * Create a new subscription for an agency.
     *
     * @param Request $request The request object containing subscription data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function createData(Request $request)
    {
        $data = $request->all();

        $newSubscription = $this->create($data);

        return response()->json($newSubscription, 201);
    }

    /**
     * Update an existing agency subscription by its ID.
     *
     * @param int $id The ID of the subscription to update.
     * @param Request $request The request object containing updated data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateData($id, Request $request)
    {
        $subscription = $this->find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $updatedSubscription = $this->update($id, $request->all());

        return response()->json($updatedSubscription, 200);
    }

    /**
     * Delete an agency subscription by its ID.
     *
     * @param int $id The ID of the subscription to delete.
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteData($id)
    {
        $subscription = $this->find($id);
        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $this->destroy($id);
        return response()->json(['message' => 'Subscription deleted successfully'], 200);
    }
}
