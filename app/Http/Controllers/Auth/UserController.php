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
     /**
     * Create a service instance.
     *
     * @return void
     */
    private $userLoginService;

    public function __construct(UserLoginService $userLoginService){

        $this->userLoginService = $userLoginService;

    }

     
    public function register(){

        return view('admin.register');
        
    }

    /**
     * Create a new User
     */
    public function userRegister(StoreRegisterRequest $request){

       return User::register($request);
        
    }


    public function login(){

        return view('admin.login');
    }

    /**
     * if user is valid then accept login
     */
    public function userLogin(checkLoginRequest $request){

        return $this->userLoginService->login($request->all());
       
    }

    public function logout(){

        return $this->userLoginService->logout();
       
    }

    public function verifyEmail(){

        return view('admin.verify-email');

    }

     /**
     * Email Notification to verify user's Account
     */
    public function emailNotification(Request $request){
     
       $userData = User::select('id','email','name')
                        ->where('email',$request->email)->first();
       if($userData){
            dispatch(new VerifyUserEmail($userData));
            return redirect('login')->with('success', 'Email sent successfully');
       } else{
            return redirect('register')->with('error', 'you are not registered');
       }
        
    }

     /**
     * Verify user's account if it's valid then reset password
     *
     * @return void
     */
    public function verifyUserToken($token){
        
        $user = User::select('id','email','name')
                    ->where('remember_token',$token)->first();    
                            
        if(!$user){
            return redirect()->route('verifyEmail')->with(['error'=>'Something went wrong,Please try again']); 
        }
        return view(
            'admin.reset-password',
            [
                'data' => $user
            ]
        );
    }

    public function resetPassword(Request $request){

        return User::updateAccount($request);

    }
}
