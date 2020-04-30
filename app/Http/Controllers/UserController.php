<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    //
    public function login(UserRequest $request){
        $requestData = $request->all();
        $data = User::login($request,$requestData['name'],$requestData['pass']);
    }

    public function register(UserRequest $request){
        $requestData = $request->all();
        User::register($requestData);
    }

    public function allUsers(){
        return User::getAll();
    }
}
