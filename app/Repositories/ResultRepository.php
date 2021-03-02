<?php
namespace App\Repositories;
use App\Models\ResultModel;

class ResultRepository {
    public function getResults()
    {
        return ResultModel::all();
    }

    public function addResult($data)
    {
        $result = new ResultModel();
        $result->name = $data['name'];
        $result->points = $data['points'];
        $result->save();
    }
}