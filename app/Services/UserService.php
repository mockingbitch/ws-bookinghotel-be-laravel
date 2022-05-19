<?php

namespace App\Services;

use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mail;
use Str;

class UserService
{
    /**
     * @param mixed $request
     * 
     * @return object
     */
    public function create($request) : object
    {
        $data = $request->only('name','email','password', 'phone', 'cccd');
        $password_hashed = Hash::make($request->password);
        $data['password']=$password_hashed;
        $token = strtoupper(Str::random(10));
        $data['token']=$token;
        $user = User::create($data);
        
        return $user;
    }
}
