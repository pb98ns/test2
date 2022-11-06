<?php

namespace App\Repositories;
use App\User;
use DB;

class UserRepository extends BaseRepository{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function getAllUsers()
    {
        return $this->model->orderBy('surname', 'asc')->get();
    }

    public function getAllUsers3()
    {
        return $this->model->orderBy('date', 'desc')->orderBy('surname', 'asc')->get();
    }
   
}
?>