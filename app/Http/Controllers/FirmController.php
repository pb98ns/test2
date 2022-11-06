<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use App\Repositories\FirmRepository;
use Illuminate\Http\Request;
use App\Firm;
use App\User;
use Illuminate\Support\Facades\Auth;

use DB;
class FirmController extends Controller

{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->permissions != 'Użytkownik' && Auth::user()->permissions != 'Administrator'){
            return redirect()->route('login');
        }
$firms=Firm::orderBy('name', 'asc')->get(); 
$totalfirms=Firm::orderBy('name', 'asc')->count(); 
return View('firm.list',["firmlist"=>$firms], compact('totalfirms'));
}
public function index2(){
    if(Auth::user()->permissions != 'Użytkownik' && Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $firms=Firm::orderBy('name', 'asc')->get(); 
    $totalfirms=Firm::orderBy('name', 'asc')->count();
return View('firm.list2',["firmlist"=>$firms], compact('totalfirms'));
}
public function dodaj_firm()
{
    if(Auth::user()->permissions != 'Użytkownik' && Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    return view('firm.create');
}

public function store(Request $request)
{
    if(Auth::user()->permissions != 'Użytkownik' && Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'place' => ['max:255'],
        'nip' => ['max:12'],
    ]);
    $firm = new Firm;
    $firm ->name=$request->input('name');
    $firm ->place=$request->input('place');
    $firm ->nip=$request->input('nip');
    
    $firm ->save();

    return redirect()->action('FirmController@index');

}
public function edit($id)
{
    if(Auth::user()->permissions != 'Użytkownik' && Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
$firm = Firm::find($id);
return view('firm.edit', compact('firm', 'id'));
}
public function update(Request $request, $id)
{
    if(Auth::user()->permissions != 'Użytkownik' && Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'place' => ['max:255'],
            'nip' => ['max:12'],
        
    ]);
        
    $firm = Firm::find($id);
   
    $firm ->name=$request->get('name');
    $firm ->place=$request->get('place');
    $firm ->nip=$request->get('nip');
    $firm ->save();
    return redirect()->action('FirmController@index');
}
public function delete($id)
{
    if(Auth::user()->permissions != 'Użytkownik' && Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $firm = Firm::find($id);
    $firm->delete();
    return redirect()->action('FirmController@index')->with('success', 'Dane zostały usunięte');
}
}
