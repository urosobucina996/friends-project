<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;

class AccessMidleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header();
        if(isset($token['token'][0]))
        $tokenExists = User::getUserByToken($token['token'][0]);
        else return response()->json(['message' => 'Send token.']);
        $tokenValidate = $tokenExists->first();
        //dd($tokenValidate,strtotime($tokenValidate->expires_at),strtotime(date("Y-m-d H:i:s")));
        if($tokenValidate && strtotime(date("Y-m-d H:i:s"))<strtotime($tokenValidate->expires_at)){
            return $next($request);
        }
        else {
            return response()->json(['message' => 'Your token has expired.']);
        }
    }
}
