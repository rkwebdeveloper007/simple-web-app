<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\checkLoginRequest;
use App\Repositaries\UserRegisterRepository;
use App\Services\UserLoginService;
use App\Jobs\VerifyUserEmail;
use App\User;
use Auth;

class UserController extends Controller
{
    private $userLoginService;

    public function __construct(UserLoginService $userLoginService){

        $this->userLoginService = $userLoginService;

    }

    public function register(){

        return view('admin.register');
        
    }
    public function userRegister(StoreRegisterRequest $request){

       return User::register($request);
        
    }


    public function login(){

        return view('admin.login');
    }

    public function userLogin(checkLoginRequest $request){

        return $this->userLoginService->login($request->all());
       
    }

    public function verifyEmail(Request $request){

        return view('admin.reset-password');

    }

    public function resetPassword(Request $request){
     
       $userData = User::select('id','email','name')
                        ->where('email',$request->email)->first();
       if($userData){
            dispatch(new VerifyUserEmail($userData));
            return redirect('login')->with('status', 'Email sent successfully');
       } else{
        return redirect('register')->with('status', 'you are not registered');
       }
        
    }
}
