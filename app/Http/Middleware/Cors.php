<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request)
        ->header('Access-Control-Allow-Origin' , "*")
        ->header('Access-Control-Allow-Methods', "POST,GET,OPTIONS,PUT,DELETE")
        ->header('Access-Control-Allow-Headers',"Accept,Authorization,Content-Type");

        //ALLOW OPTIONS METHOD
        // $headers = [
        //     'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
        //     'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
        // ];
        // if ($request->getMethod() == "OPTIONS"){
        //     //The client-side application can set only headers allowed in Access-Control-Allow-Headers
        //     return response()->json('OK',200,$headers);
        // }
        // $response = $next($request);
        // foreach ($headers as $key => $value) {
        //     $response->header($key, $value);
        // }
        // return $response;

    }
    
}
