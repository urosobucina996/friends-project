<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{

    protected $table = "users";

    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static function login($name,$password)
    {
        //dd(Hash::make($password));
        $user = self::getOne($name);
        if(!empty($user)){
            dd(Hash::check($password,$user['password']));
        }
        //dd(Hash::check($password,$user['password']));
        return '';
    }

    public static function getOne($name){
        return User::where('name',$name)->first();
    }

}
