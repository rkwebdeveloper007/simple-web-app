<?php 

namespace App\Repositaries;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserRegisterRepository {

    public function register($request){
        try {

            $user = new User;
            $user->name     = $request['name'];
            $user->email    = $request['email'];
            $user->password = $request['password'];
            $user->password = Hash::make($request['password']);
            $user->save(); 

            return response()->json(['success' => 'User Registered Successfully']);

        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        }
      
    }
}