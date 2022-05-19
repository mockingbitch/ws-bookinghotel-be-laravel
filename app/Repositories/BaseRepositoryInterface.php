<?php

namespace App\Repositories;

Interface BaseRepositoryInterface
{
    /**
     * get all
     * @return mixed
     */
    public function getAll();

    /**
     * get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * paginate
     * @param
     * @return mixed
     */
    public function paginate($int);
}
