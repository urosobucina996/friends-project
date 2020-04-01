<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller
{
    //
    public function index(Request $request){
        $requestData = $request->all();
        dump($requestData);
        $data = User::login($requestData['name'],$requestData['pass']);
        
        dd($data);
    }
}
