<?php

namespace App\Repositories;
use App\Firm;
use DB;

class FirmRepository extends BaseRepository{
    public function __construct(Firm $model)
    {
        $this->model = $model;
    }
    public function getAllFirms()
    {
        return $this->model->all();
    }
   
}
?>