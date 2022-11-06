<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\FirmRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Firm;
use DB;
use Datatables;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ProjectController extends Controller
{
    protected $variable0;
    protected $variable;
    public function __construct(){
        $this->middleware('auth');
    
    }
    public function index(UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo){
        if(Auth::user()->permissions != 'Administrator'){
            return redirect()->route('login');
        }
    
       $all=Project::join('users','projects.user_id','=','users.id')->select('users.*', 'projects.*')->orderBy('date','desc')->orderBy('surname', 'asc')->get();
       $all10=0;

       $user = $userRepo->getAllUsers();
       $firm = $firmRepo->getAllFirms();
       $task = $taskRepo->getAllTasks();
                return View('project.list',compact('all','user','task','firm','all10'));
            }
            public function edit($id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                
            $project = Project::find($id);
            $user = $userRepo->getAllUsers();
            $firm = $firmRepo->getAllFirms();
            $task = $taskRepo->getAllTasks();
            return view('project.edit',compact('id','project', 'user', 'firm', 'task'));
            }    
            public function delete($id)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                    }
                $project = Project::find($id);
                $project->delete();
                return redirect()->action('ProjectController@index')->with('success', 'Dane zostały usunięte');
            }
     
            public function update(Request $request, $id, UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo, Project $project)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
            $user = $userRepo->getAllUsers();
            $firm = $firmRepo->getAllFirms();
            $task = $taskRepo->getAllTasks();
            $request->validate([
                    
             
                            
               ]);
                $project = Project::where('id', $id)
                ->update([
                    'user_id'=>$request->input('user_id'),
                    'firm_id'=>$request->input('firm_id'),
                    'task_id'=>$request->input('task_id'),
                    'date'=>$request->input('date'),
                    'time'=>$request->input('time'),
                    'description'=>$request->input('description')
                ]);
               
               
               
            
               
            
                return redirect()->action('ProjectController@index')->with('Dane zostały zaktualizowane');
               
            } 
            public function search(Request $request, UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo){
        
                $start_date = $request->input('start_date');
                $end_date = $request->input('end_date');
                $user_id = $request->input('user_id');
                $task_id = $request->input('task_id');
                $firm_id = $request->input('firm_id');

                $all=Project::join('users','projects.user_id','=','users.id')
                ->select('users.*', 'projects.*')
                //->where('date', '>=', $start_date)
                ->when($start_date, function ($all, $start_date) {
                    return $all->where('date', '>=', $start_date);
                })
               // ->where('date', '<=', $end_date)
               ->when($end_date, function ($all, $end_date) {
                return $all->where('date', '<=', $end_date);
            })
               // ->where('user_id', '=', $user_id)
               ->when($user_id, function ($all, $user_id) {
                return $all->where('user_id', '=', $user_id);
            })
            ->when($task_id, function ($all, $task_id) {
                return $all->where('task_id', '=', $task_id);
            })
            ->when($firm_id, function ($all, $firm_id) {
                return $all->where('firm_id', '=', $firm_id);
            })
                ->orderBy('date','desc')
                ->orderBy('surname', 'asc')
                ->get();

                $all10=Project::join('users','projects.user_id','=','users.id')
                ->select('users.*', 'projects.*',DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas10"))
                //->where('date', '>=', $start_date)
                ->when($start_date, function ($all, $start_date) {
                    return $all->where('date', '>=', $start_date);
                })
               // ->where('date', '<=', $end_date)
               ->when($end_date, function ($all, $end_date) {
                return $all->where('date', '<=', $end_date);
            })
               // ->where('user_id', '=', $user_id)
               ->when($user_id, function ($all, $user_id) {
                return $all->where('user_id', '=', $user_id);
            })
            ->when($task_id, function ($all, $task_id) {
                return $all->where('task_id', '=', $task_id);
            })
            ->when($firm_id, function ($all, $firm_id) {
                return $all->where('firm_id', '=', $firm_id);
            })
                ->orderBy('date','desc')
                ->orderBy('surname', 'asc')
                ->get();

                
      
        
                $user = $userRepo->getAllUsers();
                $firm = $firmRepo->getAllFirms();
                $task = $taskRepo->getAllTasks();
                return View('project.list',compact('all','user','task','firm','all10'));
            }
            public function show($id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                $project2=Project::all();       
            $project = Project::find($id);
            $user = $userRepo->getAllUsers();
            $firm = $firmRepo->getAllFirms();
            $task = $taskRepo->getAllTasks();
            return view('project.list2',compact('id','project', 'user', 'firm', 'task'),["projectlist"=>$project2]);
            }    
            public function message($id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
            $project2=Project::all();       
            $project = Project::find($id);
            $user = $userRepo->getAllUsers();
            $firm = $firmRepo->getAllFirms();
            $task = $taskRepo->getAllTasks();
            return view('project.message',compact('id','project', 'user', 'firm', 'task'),["projectlist"=>$project2]);
            }    

            public function index2(UserRepository $userRepo, FirmRepository $firmRepo){
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                $today=date('Y-m-d');
                
               
                $all=Project::join('users','projects.user_id','=','users.id')
                ->select("users.*", "projects.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                ->where("projects.date", "=", $today)
                ->groupBy('user_id')
                ->get();

                $user1=Project::join('users','projects.user_id','=','users.id')
                ->select("projects.user_id")
                ->where("projects.date", "=", $today)
                ->groupBy("user_id")
                ->get();

                $all2=Project::join('users','projects.user_id','=','users.id')
                ->select("users.*", "projects.*")
                ->whereNotIn('projects.user_id', $user1)
                ->groupBy('user_id')
                ->orderBy('users.surname', "asc")
                ->get();

                
                $firm1=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("projects.firm_id")
                ->where("projects.date", "=", $today)
                ->groupBy("firm_id")
                ->orderBy('firms.name', "asc")
                ->get();

                $allfirm2=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("firms.*", "projects.*")
                ->whereNotIn('projects.firm_id', $firm1)
                ->groupBy('firm_id')
                ->orderBy('firms.name', "asc")
                ->get();

            

                $allfirm=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("firms.*", "projects.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas2"))
                ->where("projects.date", "=", $today)
                ->groupBy('firm_id')
                ->get();

                $suma=DB::table("projects")
                ->select(DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas3"))
                ->where("projects.date", "=", $today)
                ->get();
                $user = $userRepo->getAllUsers();
                $firm = $firmRepo->getAllFirms();

               $user = $userRepo->getAllUsers();
                        return View('project.day',compact('all','user', 'today','all2','firm','allfirm','allfirm2','suma'));
                    }



            public function searchday(Request $request, UserRepository $userRepo, FirmRepository $firmRepo){
        
                $start_date = $request->input('start_date');
                if(empty($start_date)){
                    $start_date = date('Y-m-d');
                }
                $today=$request->input('start_date');
               
                $user1=Project::join('users','projects.user_id','=','users.id')
                ->select("projects.user_id")
                ->where("projects.date", "=", $start_date)
                ->groupBy("user_id")
                ->orderBy('users.surname', "asc")
                ->get();

                $all2=Project::join('users','projects.user_id','=','users.id')
                ->select("users.*", "projects.*")
                ->whereNotIn('projects.user_id', $user1)
                ->groupBy('user_id')
                ->orderBy('users.surname', "asc")
                ->get();

            

                $all=Project::join('users','projects.user_id','=','users.id')
                ->select("users.*", "projects.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                ->where("projects.date", "=", $start_date)
                ->groupBy('user_id')
                ->get();

                



                $firm1=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("projects.firm_id")
                ->where("projects.date", "=", $start_date)
                ->groupBy("firm_id")
                ->orderBy('firms.name', "asc")
                ->get();

                $allfirm2=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("firms.*", "projects.*")
                ->whereNotIn('projects.firm_id', $firm1)
                ->groupBy('firm_id')
                ->orderBy('firms.name', "asc")
                ->get();

            

                $allfirm=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("firms.*", "projects.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas2"))
                ->where("projects.date", "=", $start_date)
                ->groupBy('firm_id')
                ->get();

                $user = $userRepo->getAllUsers();
                $firm = $firmRepo->getAllFirms();

                $suma=DB::table("projects")
                ->select(DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas3"))
                ->where("projects.date", "=", $start_date)
                ->get();

                
              
                return View('project.day',compact('all','user','today','all2','allfirm','allfirm2','suma'));
            }
            public function show2($id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                $project2=Project::all();       
            $project = Project::find($id);


            $project5=Project::where("id","=", $id)->first()->user_id;
            $project6=Project::where("id","=", $id)->first()->date;


            $showday=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                ->select("firms.*", "projects.*", "users.*")
                ->where("projects.date", "=",  $project6)
                ->where("projects.user_id", "=", $project5)
                ->orderby('firms.name',"asc")
                ->orderby('tasks.name',"asc")
                ->get();
                $showdayinview=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                ->select("firms.*", "projects.*", "users.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                ->where("projects.date", "=",  $project6)
                ->where("projects.user_id", "=", $project5)
                ->orderby('firms.name',"asc")
                ->orderby('tasks.name',"asc")
                ->get();
            $user = $userRepo->getAllUsers();
            $firm = $firmRepo->getAllFirms();
            $task = $taskRepo->getAllTasks();
            return view('project.list3',compact('id','project', 'user', 'firm', 'task','showday','showdayinview'),["projectlist"=>$project2]);
            }    
            public function show3($id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                $project2=Project::all();       
            $project = Project::find($id);


            $project5=Project::where("id","=", $id)->first()->date;
            $project6=Project::where("id","=", $id)->first()->firm_id;


            $showday=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                ->select("firms.*", "projects.*", "users.*")
                ->where("projects.date", "=",  $project5)
                ->where("projects.firm_id", "=", $project6)
                ->orderby('users.surname',"asc")
                ->orderby('tasks.name',"asc")
                ->get();
                $showdayinview=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                ->select("firms.*", "projects.*", "users.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                ->where("projects.date", "=",  $project5)
                ->where("projects.firm_id", "=", $project6)
                ->orderby('users.surname',"asc")
                ->orderby('tasks.name',"asc")
                ->get();
            $user = $userRepo->getAllUsers();
            $firm = $firmRepo->getAllFirms();
            $task = $taskRepo->getAllTasks();
            return view('project.list4',compact('id','project', 'user', 'firm', 'task','showday','showdayinview'),["projectlist"=>$project2]);
            }    

            public function period2(UserRepository $userRepo, FirmRepository $firmRepo){
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                $today=date('Y-m-d');
                $today2=date('Y-m-01');
                $today3=date('Y-m-d');
                $variable0=$today2;
                $variable=$today3;
                        session()->put('variable0', $variable0);
                        session()->put('variable', $variable);
                $all=Project::join('users','projects.user_id','=','users.id')
                ->select("users.*", "projects.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                ->when($today2, function ($all, $today2) {
                    return $all->where('date', '>=', $today2);
                })
               // ->where('date', '<=', $end_date)
               ->when($today3, function ($all, $today3) {
                return $all->where('date', '<=', $today3);
            })
                ->groupBy('user_id')
                ->get();

                $user1=Project::join('users','projects.user_id','=','users.id')
                ->select("projects.user_id")
                ->when($today2, function ($user1, $today2) {
                    return $user1->where('date', '>=', $today2);
                })
               // ->where('date', '<=', $end_date)
               ->when($today3, function ($user1, $today3) {
                return $user1->where('date', '<=', $today3);
            })
                ->groupBy("user_id")
                ->get();

                $all2=Project::join('users','projects.user_id','=','users.id')
                ->select("users.*", "projects.*")
                ->whereNotIn('projects.user_id', $user1)
                ->groupBy('user_id')
                ->orderBy('users.surname', "asc")
                ->get();

                
                $firm1=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("projects.firm_id")
                ->when($today2, function ($firm1, $today2) {
                    return $firm1->where('date', '>=', $today2);
                })
               // ->where('date', '<=', $end_date)
               ->when($today3, function ($firm1, $today3) {
                return $firm1->where('date', '<=', $today3);
            })
                ->groupBy("firm_id")
                ->orderBy('firms.name', "asc")
                ->get();

                $allfirm2=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("firms.*", "projects.*")
                ->whereNotIn('projects.firm_id', $firm1)
                ->groupBy('firm_id')
                ->orderBy('firms.name', "asc")
                ->get();

            

                $allfirm=Project::join('firms','projects.firm_id','=','firms.id')
                ->select("firms.*", "projects.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas2"))
                ->when($today2, function ($allfirm, $today2) {
                    return $allfirm->where('date', '>=', $today2);
                })
               // ->where('date', '<=', $end_date)
               ->when($today3, function ($allfirm, $today3) {
                return $allfirm->where('date', '<=', $today3);
            })
                ->groupBy('firm_id')
                ->get();

                $suma=DB::table("projects")
                ->select(DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas3"))
                ->when($today2, function ($suma, $today2) {
                    return $suma->where('date', '>=', $today2);
                })
               // ->where('date', '<=', $end_date)
               ->when($today3, function ($suma, $today3) {
                return $suma->where('date', '<=', $today3);
            })
                ->get();
                $user = $userRepo->getAllUsers();
                $firm = $firmRepo->getAllFirms();

               $user = $userRepo->getAllUsers();
                        return View('project.period',compact('all','user', 'today','all2','firm','allfirm','allfirm2','suma','today2','today3'));
                    }
                    public function searchperiod(Request $request, UserRepository $userRepo, FirmRepository $firmRepo){
        
                        $start_date = $request->input('start_date');
                        $end_date = $request->input('end_date');
                        
                        if(empty($start_date)){
                            $start_date = date('Y-m-01');
                        }
                        $today2=$request->input('start_date');
                        $today3=$request->input('end_date');

                        $user1=Project::join('users','projects.user_id','=','users.id')
                        ->select("projects.user_id")
                        ->when($start_date, function ($user1, $start_date) {
                            return $user1->where('date', '>=', $start_date);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($end_date, function ($user1, $end_date) {
                        return $user1->where('date', '<=', $end_date);
                    })
                        ->groupBy("user_id")
                        ->orderBy('users.surname', "asc")
                        ->get();
        
                        $all2=Project::join('users','projects.user_id','=','users.id')
                        ->select("users.*", "projects.*")
                        ->whereNotIn('projects.user_id', $user1)
                        ->groupBy('user_id')
                        ->orderBy('users.surname', "asc")
                        ->get();
        
                    
        
                        $all=Project::join('users','projects.user_id','=','users.id')
                        ->select("users.*", "projects.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                        ->when($start_date, function ($all, $start_date) {
                            return $all->where('date', '>=', $start_date);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($end_date, function ($all, $end_date) {
                        return $all->where('date', '<=', $end_date);
                    })
                        ->groupBy('user_id')
                        ->get();
        
                        
        
        
        
                        $firm1=Project::join('firms','projects.firm_id','=','firms.id')
                        ->select("projects.firm_id")
                        ->when($start_date, function ($all, $start_date) {
                            return $all->where('date', '>=', $start_date);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($end_date, function ($firm1, $end_date) {
                        return $firm1->where('date', '<=', $end_date);
                    })
                        ->groupBy("firm_id")
                        ->orderBy('firms.name', "asc")
                        ->get();
        
                        $allfirm2=Project::join('firms','projects.firm_id','=','firms.id')
                        ->select("firms.*", "projects.*")
                        ->whereNotIn('projects.firm_id', $firm1)
                        ->groupBy('firm_id')
                        ->orderBy('firms.name', "asc")
                        ->get();
        
                    
        
                        $allfirm=Project::join('firms','projects.firm_id','=','firms.id')
                        ->select("firms.*", "projects.*", DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas2"))
                        ->when($start_date, function ($allfirm, $start_date) {
                            return $allfirm->where('date', '>=', $start_date);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($end_date, function ($allfirm, $end_date) {
                        return $allfirm->where('date', '<=', $end_date);
                    })
                        ->groupBy('firm_id')
                        ->get();
        
                        $user = $userRepo->getAllUsers();
                        $firm = $firmRepo->getAllFirms();
        
                        $suma=DB::table("projects")
                        ->select(DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas3"))
                        ->when($start_date, function ($suma, $start_date) {
                            return $suma->where('date', '>=', $start_date);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($end_date, function ($suma, $end_date) {
                        return $suma->where('date', '<=', $end_date);
                    })
                        ->get();

                        $variable0=$start_date;
                        $variable=$end_date;
                        session()->put('variable0', $variable0);
                        session()->put('variable', $variable);
                      
                        return View('project.period',compact('all','user','today2','all2','allfirm','allfirm2','suma','today3'));
                    }
                    public function show4($id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
                    {
                        if(Auth::user()->permissions != 'Administrator'){
                            return redirect()->route('login');
                        }
                        $project2=Project::all();       
                    $project = Project::find($id);
                 
                    $project5=Project::where("id","=", $id)->first()->user_id;
                   $project6=Project::where("id","=", $id)->first()->date;
                    //$project7=Project::where("id","=", $id)->orderBy('id',"desc")->first()->date;
                    $variable = session()->get('variable');
                    if(empty($variable)){
                        $variable = date('Y-m-d');
                    }
                    $variable0 = session()->get('variable0');
                    if(empty($variable0)){
                        $variable0 = date('Y-m-01');
                    }
        
                    $showday=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                        ->select("firms.*", "projects.*", "users.*")
                        ->when($variable0, function ($showday, $variable0) {
                            return $showday->where('date', '>=', $variable0);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($variable, function ($showday, $variable) {
                        return $showday->where('date', '<=', $variable);
                    })
                        ->where("projects.user_id", "=", $project5)
                        ->orderby('date',"asc")
                        ->orderby('firms.name',"asc")
                        ->orderby('tasks.name',"asc")
                        ->get();

                        $showdaysuma=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                        ->select("firms.*", "projects.*", "users.*",DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                        ->when($variable0, function ($showday, $variable0) {
                            return $showday->where('date', '>=', $variable0);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($variable, function ($showday, $variable) {
                        return $showday->where('date', '<=', $variable);
                    })
                        ->where("projects.user_id", "=", $project5)
                        ->orderby('date',"asc")
                        ->orderby('firms.name',"asc")
                        ->orderby('tasks.name',"asc")
                        ->get();
                    $user = $userRepo->getAllUsers();
                    $firm = $firmRepo->getAllFirms();
                    $task = $taskRepo->getAllTasks();
                    return view('project.list5',compact('id','project', 'user', 'firm', 'task','showday','variable0','variable','showdaysuma'),["projectlist"=>$project2]);
                    }    
                    public function show5($id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
                    {
                        if(Auth::user()->permissions != 'Administrator'){
                            return redirect()->route('login');
                        }
                        $project2=Project::all();       
                    $project = Project::find($id);
        
        
                    $project5=Project::where("id","=", $id)->first()->date;
                    $project6=Project::where("id","=", $id)->first()->firm_id;
        
                    $variable = session()->get('variable');
                    if(empty($variable)){
                        $variable = date('Y-m-d');
                    }
                    $variable0 = session()->get('variable0');
                    if(empty($variable0)){
                        $variable0 = date('Y-m-01');
                    }

                    $showday=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                        ->select("firms.*", "projects.*", "users.*")
                         ->when($variable0, function ($showday, $variable0) {
                            return $showday->where('date', '>=', $variable0);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($variable, function ($showday, $variable) {
                        return $showday->where('date', '<=', $variable);
                    })
                        ->where("projects.firm_id", "=", $project6)
                        ->orderby('date',"asc")
                        ->orderby('users.surname',"asc")
                        ->orderby('tasks.name',"asc")
                        ->get();

                        $showdaysuma=Project::join('firms','projects.firm_id','=','firms.id')->join('users','projects.user_id','=','users.id')->join('tasks','projects.task_id','=','tasks.id')
                        ->select("firms.*", "projects.*", "users.*",DB::raw("sec_to_time (sum(time_to_sec(`time`))) as czas"))
                         ->when($variable0, function ($showday, $variable0) {
                            return $showday->where('date', '>=', $variable0);
                        })
                       // ->where('date', '<=', $end_date)
                       ->when($variable, function ($showday, $variable) {
                        return $showday->where('date', '<=', $variable);
                    })
                        ->where("projects.firm_id", "=", $project6)
                        ->orderby('date',"asc")
                        ->orderby('users.surname',"asc")
                        ->orderby('tasks.name',"asc")
                        ->get();
                    $user = $userRepo->getAllUsers();
                    $firm = $firmRepo->getAllFirms();
                    $task = $taskRepo->getAllTasks();
                    return view('project.list6',compact('id','project', 'user', 'firm', 'task','showday','variable0','variable','showdaysuma'),["projectlist"=>$project2]);
                    }
                    public function delete2($id)
                    {
                       
                        $project = Project::find($id);
                        $project->delete();
                        return redirect()->action('HomeController@index')->with('success', 'Dane zostały usunięte');
                    }

}