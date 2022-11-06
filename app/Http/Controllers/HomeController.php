<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\FirmRepository;
use App\Repositories\TaskRepository;
use App\Project;
use App\User;
use App\Firm;
use DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo)
    {
        $user = $userRepo->getAllUsers();
        $firm = $firmRepo->getAllFirms();
        $task = $taskRepo->getAllTasks();

        $auth_user_id = Auth::id();
        $today=date('Y-m-d');

$showuserproject=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                ->select("firms.*", "projects.*", "users.*")
                ->where("projects.date", "=",  $today)
                ->where("projects.user_id", "=", $auth_user_id)
                ->orderby('firms.name',"asc")
                ->orderby('tasks.name',"asc")
                ->get();

                $showsum=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                ->select("firms.*", "projects.*", "users.*",DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                ->where("projects.date", "=",  $today)
                ->where("projects.user_id", "=", $auth_user_id)
                ->orderby('firms.name',"asc")
                ->orderby('tasks.name',"asc")
                ->get();


        return view('home', compact('user','firm','task','showuserproject','showsum','today'));
    }
    public function index2()
    {
        return view('index2');
    }
    public function store(Request $request)
{
    $auth_user_id = Auth::id();
        $today=date('Y-m-d');
    $showsum=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
    ->select("firms.*", "projects.*", "users.*",DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
    ->where("projects.date", "=",  $today)
    ->where("projects.user_id", "=", $auth_user_id)
    ->orderby('firms.name',"asc")
    ->orderby('tasks.name',"asc")
    ->get();
  
    $request->validate([
        'user_id'=> ['required'],
        'firm_id' => ['required'],
        'task_id' => ['required'],
        'time' => ['required'],
        'date' => ['required'],
    
       
    ]);
    
    $project = new Project;
    $project->user_id=$request->input('user_id');
    $project->firm_id=$request->input('firm_id');
    $project->task_id=$request->input('task_id');
    $project->description=$request->input('description');
    $project->time=$request->input('time');
    $project->date=$request->input('date');

    $project->save();
    
    return redirect()->action('HomeController@index');
   
}

public function searchday2(Request $request, UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo){
        
    $start_date = $request->input('start_date');
    $today=$request->input('start_date');
    if(empty($start_date)){
        $today = date('Y-m-d');
    }
    
   
    $user = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirms();
    $task = $taskRepo->getAllTasks();

    $auth_user_id = Auth::id();
  

$showuserproject=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
            ->select("firms.*", "projects.*", "users.*")
            ->where("projects.date", "=",  $today)
            ->where("projects.user_id", "=", $auth_user_id)
            ->orderby('firms.name',"asc")
            ->orderby('tasks.name',"asc")
            ->get();

            $showsum=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
            ->select("firms.*", "projects.*", "users.*",DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
            ->where("projects.date", "=",  $today)
            ->where("projects.user_id", "=", $auth_user_id)
            ->orderby('firms.name',"asc")
            ->orderby('tasks.name',"asc")
            ->get();


    return view('home', compact('user','firm','task','showuserproject','showsum','today'));
    
  
}
}
