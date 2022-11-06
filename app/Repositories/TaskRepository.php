<?php

namespace App\Repositories;
use App\Task;
use DB;

class TaskRepository extends BaseRepository{
    public function __construct(Task $model)
    {
        $this->model = $model;
    }
    public function getAllTasks()
    {
        return $this->model->orderBy('name', 'asc')->get();
    }
   
}
?>