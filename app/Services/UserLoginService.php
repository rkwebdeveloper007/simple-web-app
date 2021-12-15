<?php

namespace App\Services;
use \Auth;


class UserLoginService {
    
    public function login($request){
        if (Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
            ])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->with(['error'=>'Credential does not match']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with(['success'=>'successfully logout']);
    }

}