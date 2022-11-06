<?php

namespace App;
use App\User;
use App\Firm;
use App\Task;
use App\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;
    protected $fillable= [
        'id', 'user_id', 'vacation_date','type_vacation'
     ];
     public function user(){
         return $this->belongsTo(User::class,'user_id');
     }
     public $timestamps = false;

}
