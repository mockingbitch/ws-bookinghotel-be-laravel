<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    //Model muốn tương tác
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    //Lấy Model tương ứng
    abstract public function getModel();

    /**
     *set Model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll() 
    {
        return $this->model->all(); // tương tự Model::all()
    }

    public function find($id)
    {
        $result = $this->model->find($id); //gọi đến hàm find từ model

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes); //gọi đến hàm tạo của model vd:Amount::create($data[]);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if($result){
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete($id): bool
    {
        $result = $this->find($id);
        if($result){
            $result->delete();
            return true;
        }
        return false;
    }
    public function paginate($int){
        return $this->model->paginate($int);
    }
    public function count(){
        return $this->model->count();
    }
}
