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
        $tokenExists = User::getUserByToken($token['token'][0]);
        $tokenValidate = $tokenExists->first();
        //dd($tokenValidate,strtotime($tokenValidate->expires_at),strtotime(date("Y-m-d H:i:s")));
        if($tokenValidate && strtotime(date("Y-m-d H:i:s"))<strtotime($tokenValidate->expires_at)){
            return $next($request);
        }
        else {
            return response()->json(['message' => 'You are not authorized to access.']);
        }
    }
}
