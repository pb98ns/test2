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
use Illuminate\Support\Facades\Auth;

use DB;
class TaskController extends Controller

{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->permissions != 'Administrator'){
            return redirect()->route('login');
        }
$tasks=Task::orderBy('name', 'asc')->get(); 
$totaltasks=Task::orderBy('name', 'asc')->count(); 
return View('task.list',["tasklist"=>$tasks], compact('totaltasks'));
}
public function index2(){
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $tasks=Task::orderBy('name', 'asc')->get(); 
$totaltasks=Task::orderBy('name', 'asc')->count(); 
return View('task.list2',["tasklist"=>$tasks], compact('totaltasks'));
}
public function dodaj_task()
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    return view('task.create');
}

public function store(Request $request)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
       
    ]);
    $task = new Task;
    $task ->name=$request->input('name');

    $task ->save();

    return redirect()->action('TaskController@index');

}
public function edit($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
$task = Task::find($id);
return view('task.edit', compact('task', 'id'));
}
public function update(Request $request, $id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            
        
    ]);
        
    $task = Task::find($id);
   
    $task ->name=$request->get('name');
    $task ->save();
    return redirect()->action('TaskController@index');
}
public function delete($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $task = Task::find($id);
    $task->delete();
    return redirect()->action('TaskController@index')->with('success', 'Dane zostały usunięte');
}
}
