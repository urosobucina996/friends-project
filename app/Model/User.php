<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public static function login($request,$name,$password)
    {
        $user = User::where(['name'=>$name,'password'=>hash("sha256",$password)])->first();
        if(is_null($user)){
            echo "User no found!";
        }else{
            $user->createToken('authToken')->accessToken;
        }
    }

    public static function getOne($name){
        return User::where('name',$name)->first();
    }

    public static function getAll(){
        return User::all();
    }

    public static function getUserByToken($token){
        return DB::table('oauth_access_tokens')->where('id',$token);
    }

}
