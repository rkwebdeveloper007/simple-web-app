<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeRegister($query,$request){
        $user =  $query->create([
                     'name'            => $request->name,
                     'email'           => $request->email,
                     'password'        => Hash::make($request->password),
                 ]);
         return redirect()->route('login')->with(['success'=>'Registered successfully']);
     }
 
     public function scopeUpdateAccount($query,$request){
         $user =  $query->where('email', $request->email)->update([
             'name'                      => $request->name,
             'email'                     => $request->email,
             'remember_token'            => Null,
             'email_verified_at'         => Null,
             'password'                  => Hash::make($request->password),
         ]);
         return redirect()->route('login')->with(['success'=>'new password updated successfully']);
     }
}
