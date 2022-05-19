<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        //valida si existe una sesion 
        if(Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('index');
    }

    public function validateLogin(LoginRequest $request) {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)) {
            toastr()->error('Las credenciales ingresadas son incorrectas. Intentalo de nuevo');
            return redirect()->route('login');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        
        Auth::login($user);//crea la sesion

        return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user) {
        $roles = $user->roles()->get();

        if(count($roles) == 1) {
            $user->setSession($roles->toArray());
        }
        return redirect()->route('dashboard');
    }

    public function logout() {
        Session::flush();

        Auth::logout();

        return redirect()->route('login');
    }
}
