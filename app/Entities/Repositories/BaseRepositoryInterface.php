<?php
/**
 * Created by PhpStorm.
 * User: KameR <kashayapk62@gmail.com>
 * Date: 13-05-2018
 * Time: 01:02 AM
 */

namespace App\Entities\Repositories;


interface BaseRepositoryInterface
{
    /**
     * Get all record of model
     *
     * @return array
     */
    public function all();

    /**
     * Create record for model
     *
     * @param array $data
     * @return array
     */
    public function create(array $data);

    /**
     * Update records of given id
     *
     * @param array $data
     * @param integer $id
     * @return array
     */
    public function update(array $data, $id);

    /**
     * Paginate record
     *
     * @param integer $perPage
     * @param array $columns
     * @return array
     */
    public function paginate($perPage = 15, $columns = array('*'));

    /**
     * Delete records of given id
     *
     * @param integer $id
     * @return boolean
     */
    public function delete($id);

    /**
     * Show records of given id
     *
     * @param integer $id
     * @return array
     */
    public function show($id);
}