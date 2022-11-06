<?php

namespace App;
use App\User;
use App\Firm;
use App\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable= [
       'id', 'user_id', 'firm_id', 'task_id', 'description', 'time', 'date'
     ];
     public function user(){
         return $this->belongsTo(User::class,'user_id');
     }
     public function firm(){
        return $this->belongsTo(Firm::class,'firm_id');
    }
    public function task(){
        return $this->belongsTo(Task::class,'task_id');
    }
    protected $dates = [
        'time','czas3' 
    ];
     public $timestamps = false;

}
