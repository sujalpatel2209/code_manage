<?php
/**
 * Created by PhpStorm.
 * User: KameR <kashayapk62@gmail.com>
 * Date: 13-05-2018
 * Time: 01:05 AM
 */

namespace App\Entities\Repositories;


use App\AppConstant\AppConstant;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use phpDocumentor\Reflection\Types\String_;

class BaseRepository implements BaseRepositoryInterface
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all record of model
     *
     * @return array
     */
    public function all()
    {
        return $this->model->all();
    }

    public function select($data)
    {
        return $this->model->select($data);
    }


    public function filter($request)
    {

        return $this->model->all()->where('status', $request);
    }

    /**
     * Create record for model
     *
     * @param $data
     * @return array
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function attach()
    {
        return $this->model;
    }

    /**
     * Update records of given id
     *
     * @param array $data
     * @param $id
     * @return array
     */
    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        return $record->update($data);
    }
    public function whereUpdate($column,$value)
    {

        $record = $this->model->where($column,$value);
        return $record;
    }

    /**
     * Delete records of given id
     *
     * @param $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /*
     *  Delete Record with where condition
     */

    public function whereDelete($where)
    {
        $this->model->where($where)->delete();
    }



//    public function sync($id)
//    {
//        return $this->show($id);
//        return $data->recipeTags()->sync($data);
//    }
//
//    public function attach()
//    {
//        return $this->model;
//        return $data->recipeTags()->sync($data);
//    }

    /**
     * Show records of given id
     *
     * @param $id
     * @return array
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }


    /**
     * Get associated model
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set associated model
     *
     * @param $model
     * @return BaseRepository
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Eager loading database connections
     *
     * @param $relations
     * @return Model
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    /**
     * Paginate record
     *
     * @param integer $perPage
     * @param array $columns
     * @return array
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function where(array $where)
    {
        return $this->model->where($where);
    }

    public function has($has)
    {
        return $this->model->has($has);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->model->get();
    }

    public function like($id)
    {
        return $this->model->where('question','like',$id);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->model->firstOrFail();
    }

	/**
	 * Add a relationship count / exists condition to the query with where clauses.
	 *
	 * @param  string  $relation
	 * @param  \Closure|null  $callback
	 * @param  string  $operator
	 * @param  int     $count
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */

	public function whereHas($relation, Closure $callback = null, $operator = '>=', $count = 1)
	{
		return $this->model->has($relation, $operator, $count, 'and', $callback);
	}

	public function groupby($fields)
    {
        $this->model->groupBy($fields)->toArray();
    }
}