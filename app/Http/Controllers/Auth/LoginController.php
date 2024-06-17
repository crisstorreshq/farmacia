<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\ValidacionLogin;
use App\Models\User;

class LoginController extends Controller
{
    public function username()
    {
        return 'name';
    }

    public function __construct()
    {
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(ValidacionLogin $request)
    {
        $userName = $request->input('user');
        $data=DB::select('exec login ?,?',[$userName, $request->input('password')]);

        if(!empty($data)){
            if($data[0]->clave == 1){
                if(User::getAuth($userName, 30))
                {
                    Auth::loginUsingId($data[0]->principal_id, false);
                    return redirect('/home');
                } else {
                    return back()->withErrors(['password'=>'No tienes Privilegios'])->withInput(request(['user']));
                }
            } else {
                return back()->withErrors(['password'=>'Clave Incorrecta'])->withInput(request(['user']));
            }
        } else {
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
