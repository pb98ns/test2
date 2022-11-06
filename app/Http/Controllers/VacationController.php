<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use App\Repositories\FirmRepository;
use App\Repositories\TaskRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use App\Firm;
use App\User;
use App\Task;
use App\Project;
use App\Vacation;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;


class VacationController extends Controller

{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $today2 = date('Y-01-01');
        $today3 = date('Y-12-31');
        $auth_user_id = Auth::id();
        $vacations=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->get(); 
        $vacationscount=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->count(); 
        $vacations_ch=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->get(); 
        $vacationscount_ch=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->count(); 

return View('vacation.list', compact('vacations','today2','today3','vacationscount','vacations_ch','vacationscount_ch'));
}
public function index2(){
    $start_date = date('Y-m-d');
    $today = date('Y-m-d');
    $today2 = date('Y-01-01');
    $today3 = date('Y-12-31');
    $variable6=$today2;
                    $variable7=$today3;
                    session()->put('variable6', $variable6);
                    session()->put('variable7', $variable7);
    $vacations=Vacation::join('users','vacations.user_id','=','users.id')->where("vacation_date", "=", $today)->orderBy('users.surname', "asc")->get(); 
    $vacations_uw=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("count(`user_id`) as czas"))->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$today2, $today3])->groupBy('user_id')->get(); 
    $vacations_ch=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("count(`user_id`) as czas"))->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$today2, $today3])->groupBy('user_id')->get(); 

return View('vacation.vacation', compact('vacations','today','vacations_uw','vacations_ch','today2','today3'));
}
public function store(Request $request){
    $auth_user_id = Auth::id();
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $system = $request->input('system');
    $type_vacation = $request->input('type_vacation');

    if ($start_date == null)
    {
        return redirect()->action('VacationController@index')->with('message', 'Niezdefiniowana data początkowa urlopu');
    }
    if ($end_date == null)
    {
        return redirect()->action('VacationController@index')->with('message', 'Niezdefiniowana data końcowa urlopu');
    }
    if ($end_date < $start_date)
{
    return redirect()->action('VacationController@index')->with('message', 'Niepoprawny zakres dat');
}

else{


    if ($system == "1") 
    {
        DB::select('call week(?,?,?,?)',array($auth_user_id,$start_date,$end_date,$type_vacation)); 
    }
 
    if ($system == "2") 
    {
        DB::select('call saturday(?,?,?,?)',array($auth_user_id,$start_date,$end_date,$type_vacation)); 
    }
    if ($system == "3") 
    {
        DB::select('call sunday(?,?,?,?)',array($auth_user_id,$start_date,$end_date,$type_vacation)); 
    }

    
    return redirect()->action('VacationController@index');
    }
}
public function searchvacation(Request $request)
{
    $start_date = $request->input('start_date2');
    $end_date = $request->input('end_date2');
                    
                    if(empty($start_date)){
                        $start_date = date('Y-01-01');
                    }
                    if(empty($end_date)){
                        $end_date = date('Y-12-31');
                    }
                    $today2=$request->input('start_date2');
                    $today3=$request->input('end_date2');
                    $auth_user_id = Auth::id();
                    $vacations=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$start_date, $end_date])->groupBy('vacation_date')->get(); 
                    $vacationscount=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->count(); 
                    $vacations_ch=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$start_date, $end_date])->groupBy('vacation_date')->get(); 
                    $vacationscount_ch=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->count(); 
                    
                    return View('vacation.list', compact('vacations','today2','today3','vacationscount','vacations_ch','vacationscount_ch'));
                }
                public function searchday(Request $request, UserRepository $userRepo, FirmRepository $firmRepo){
        
                    $today = $request->input('start_date');
                    if(empty($today)){
                        $today = date('Y-m-d');
                    }
                    $today2 = date('Y-01-01');
                    $today3 = date('Y-12-31');
                   
                    $vacations=Vacation::join('users','vacations.user_id','=','users.id')->where("vacation_date", "=", $today)->orderBy('users.surname', "asc")->get(); 
                    $vacations_uw=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("count(`user_id`) as czas"))->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$today2, $today3])->groupBy('user_id')->get(); 
                    $vacations_ch=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("count(`user_id`) as czas"))->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$today2, $today3])->groupBy('user_id')->get(); 
                
                  
                    return View('vacation.vacation',compact('vacations','today','today2','today3','vacations_uw','vacations_ch'));
                }
                public function searchperiod(Request $request, UserRepository $userRepo, FirmRepository $firmRepo){
                    $today = date('Y-m-d');
                    $start_date = $request->input('start_date2');
                    $end_date = $request->input('end_date2');
                                    
                                    if(empty($start_date)){
                                        $start_date = date('Y-01-01');
                                    }
                                    if(empty($end_date)){
                                        $end_date = date('Y-12-31');
                                    }
                                    $today2=$request->input('start_date2');
                                    $today3=$request->input('end_date2');

                  $vacations=Vacation::join('users','vacations.user_id','=','users.id')->where("vacation_date", "=", $today)->orderBy('users.surname', "asc")->get(); 
                    $vacations_uw=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("count(`user_id`) as czas"))->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$start_date, $end_date])->groupBy('user_id')->get(); 
                    $vacations_ch=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("count(`user_id`) as czas"))->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$start_date, $end_date])->groupBy('user_id')->get(); 
                    $variable6=$start_date;
                    $variable7=$end_date;
                    session()->put('variable6', $variable6);
                    session()->put('variable7', $variable7);
                    return View('vacation.vacation',compact('vacations','today','today2','today3','vacations_uw','vacations_ch'));
                }
                public function show2($user_id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
                {
                    if(Auth::user()->permissions != 'Administrator'){
                        return redirect()->route('login');
                    }
                    $variable6 = session()->get('variable6');
                    if(empty($variable6)){
                        $variable6 = date('Y-01-01');
                    }
                    $variable7 = session()->get('variable7');
                    if(empty($variable7)){
                        $variable7 = date('Y-12-31');
                    }
                $vacations=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('vacation_date')->get(); 
                $vacations_count=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("count(`user_id`) as czas"))->orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('user_id')->get(); 
                $vacations2=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('vacation_date')->limit(1)->get(); 

               
            

    
                $user = $userRepo->getAllUsers();
                $firm = $firmRepo->getAllFirms();
                $task = $taskRepo->getAllTasks();
                return view('vacation.list3',compact('user_id','vacations', 'user', 'firm', 'task','variable6','variable7','vacations_count','vacations2'));
                }  
                public function delete($id)
                {
                    if(Auth::user()->permissions != 'Administrator'){
                        return redirect()->route('login');
                        }
                    $project = Vacation::find($id);
                    $project->delete();
                    return redirect()->action('VacationController@index2')->with('success', 'Dane zostały usunięte');
                }
                public function show4($user_id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
                {
                    if(Auth::user()->permissions != 'Administrator'){
                        return redirect()->route('login');
                    }
                    $variable6 = session()->get('variable6');
                    if(empty($variable6)){
                        $variable6 = date('Y-01-01');
                    }
                    $variable7 = session()->get('variable7');
                    if(empty($variable7)){
                        $variable7 = date('Y-12-31');
                    }
                $vacations=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('vacation_date')->get(); 
                $vacations_count=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("count(`user_id`) as czas"))->orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('user_id')->get(); 
                $vacations2=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('vacation_date')->limit(1)->get(); 

               
            

    
                $user = $userRepo->getAllUsers();
                $firm = $firmRepo->getAllFirms();
                $task = $taskRepo->getAllTasks();
                return view('vacation.list5',compact('user_id','vacations', 'user', 'firm', 'task','variable6','variable7','vacations_count','vacations2'));
                }  
}
