<?php
namespace App\Repositories;

class EloquentRepository
{
    protected $model;

    public function all()
    {
        return $this->model->all();
    }

    /**
     * find
     *
     * @param int $id
     * @return row
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * create
     *
     * @param array $attributes
     * @return row
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * insert
     *
     * @param array $attributes
     * @return void
     */
    public function insert(array $attributes)
    {
        return $this->model->insert($attributes);
    }

    /**
     * findAndUpdate
     *
     * @param int $id
     * @param array $attributes
     * @return row
     */
    public function findAndUpdate($id, array $attributes)
    {
        $this->model->find($id)->update($attributes);
    }

    /**
     * delete
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * firstOrCreate
     *
     * @param array $attributes
     * @return row
     */
    public function firstOrCreate(array $attributes)
    {
        return $this->model->firstOrCreate($attributes);
    }

    /**
     * paginate
     *
     * @param int $page
     * @param int $per_page
     * @param array $columns
     * @return Illuminate\Contracts\Pagination\Paginator
     */
    public function paginate($page, $per_page, $columns = ['*'])
    {
        return $this->model->paginate($per_page, $columns, 'page', $page);
    }

    /**
     * reverse_paginate
     *
     * @param int $page
     * @param int $per_page
     * @param array $columns
     * @return Illuminate\Contracts\Pagination\Paginator
     */
    public function reverse_paginate($page, $per_page, $columns = ['*'])
    {
        return $this->model->latest()->paginate($per_page, $columns, 'page', $page);
    }
}
