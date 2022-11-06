<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\FirmRepository;
use App\User;
use App\Firm;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->permissions != 'Administrator' ){
            return redirect()->route('login');
        }
        $users=User::orderBy('surname','asc')->get(); 
          
                return View('auth.register',["pracownicylist"=>$users]);
            }
            public function show($id){
                if(Auth::user()->permissions != 'Administrator' ){
                    return redirect()->route('login');
                }
                $pracownicy=User::find($id);        
                        return View('pracownicy.show',["pracownicy"=>$pracownicy]);
                    }
        

                    public function dodaj_pracownika()
                    {
                        if(Auth::user()->permissions != 'Administrator' ){
                            return redirect()->route('login');
                        }
                        return view('pracownicy.create');
                    }
                    
                    
                    
                    public function delete($id)
                    {
                        if(Auth::user()->permissions != 'Administrator' ){
                            return redirect()->route('login');
                        }
                        $users = User::find($id);
                        $users->delete();
                        return redirect()->action('UserController@index')->with('success', 'Dane zostały usunięte');
                    }
public function edit($id)
{
    if(Auth::user()->permissions != 'Administrator' ){
        return redirect()->route('login');
    }
$user = User::find($id);
$pracownicy=User::find($id);   
return view('pracownicy.edit', compact('user','pracownicy', 'id'));
}
public function update(Request $request, $id)
{
    if(Auth::user()->permissions != 'Administrator' ){
        return redirect()->route('login');
    }
    $this->validate($request, [
'name' => 'required',
'surname' => 'required',
'email' => 'required',
'permissions' => 'required'


    ]);
    $user = User::find($id);
   
    $user ->name=$request->get('name');
    $user ->surname=$request->get('surname');
    $user ->email=$request->get('email');
    $user ->permissions=$request->get('permissions');

   
    
    $user ->save();
    return redirect()->action('UserController@index');
}
}
