<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\BasicRepositoryInterface;

class BasicRepository implements BasicRepositoryInterface 
{
    public function getAll($model) 
    {
        return $model::all();
    }

    public function getById($model, $id) 
    {
        return $model::findOrFail($id);
    }

    public function delete($model, $id) 
    {
        $model::destroy($id);
    }

    public function create($model, array $details) 
    {

        return $model::create($details);
    }

    public function update($model, $id, array $newDetails) 
    {
        $model::whereId($id)->update($newDetails);
        return $model::whereId($id)->first();
    }
}