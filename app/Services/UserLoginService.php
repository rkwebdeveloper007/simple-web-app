<?php

namespace App\Services;
use \Auth;


class UserLoginService {
    
    public function login($request){
        if (Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
            ])) {
            $user = Auth()->user();
                return response()->json(['success' => 'Successfully Logged In']);
        } else {
            return response()->json(['error'=> 'Credential does not match']);
        }
    }

}