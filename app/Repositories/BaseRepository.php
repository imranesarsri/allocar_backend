<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Abstract class BaseRepository that provides a base implementation
 * for common data manipulation operations.
 */
abstract class BaseRepository implements RepositoryInterface
{

    /**
     * The Eloquent model associated with this repository.
     *
     * @var Model
     */
    protected $model;


    /**
     * Default pagination limit.
     *
     * @var int
     */
    protected $paginationLimit = 7;


    /**
     * Constructor for the BaseRepository class.
     *
     * @param Model $model The Eloquent model associated with the repository.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * Retrieves all records based on search criteria.
     *
     * @param array|string $search Search criteria. If an array, filters by exact match.
     *                             If a string, searches across all searchable fields.
     * @param array $columns Columns to retrieve.
     * @return Collection
     */
    public function getAll(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }
    /**
     * Retrieves all records associated with a specific user ID.
     *
     * @param int $userId The user ID to filter records by.
     * @param array $columns Columns to retrieve.
     * @return Collection
     */
    public function getAllByUserId(int $userId, array $columns = ['*']): Collection
    {
        return $this->model->where('user_id', $userId)->get($columns);
    }


    /**
     * Retrieves paginated records based on search criteria.
     *
     * @param array|string $search Search criteria. If an array, filters by exact match.
     *                             If a string, searches across all searchable fields.
     * @param array $columns Columns to retrieve.
     * @return LengthAwarePaginator
     */
    public function paginate(array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->paginate($this->paginationLimit, $columns);
    }



    /**
     * Retrieves a record by its ID.
     *
     * @param int $id ID of the record to retrieve.
     * @param array $columns Columns to retrieve.
     * @return mixed
     */
    public function find(int $id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }



    /**
     * Creates a new record in the database.
     *
     * @param array $data The data to create the new record with.
     * @return mixed The newly created record.
     */
    public function create(array $data)
    {
        return $this->model->create(attributes: $data);
    }



    /**
     * Updates a record in the database.
     *
     * @param int $id The unique identifier of the record to update.
     * @param array $data The data to update the record with.
     * @return bool True if the record was updated, false if not found.
     */
    public function update($id, array $data): bool
    {
        $record = $this->model->find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }


    /**
     * Deletes a record from the database.
     *
     * @param int $id The unique identifier of the record to delete.
     * @return bool True if the record was deleted, false if not found.
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        if ($model) {
            return $model->delete();
        }
        return false;
    }

}
