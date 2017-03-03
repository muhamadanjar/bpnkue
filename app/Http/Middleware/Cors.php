<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        /*$headers = [
          'Access-Control-Allow-Origin' => '*',
             'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
        ];
        if($request->getMethod() == "OPTIONS") {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return Response::make('OK', 200, $headers);
        }

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

        $response = $next($request);
        foreach($headers as $key => $value) 
            $response->header($key, $value);
        return $response;*/
        return $next($request);
            //->header('Access-Control-Allow-Origin', '*')
            //->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            //->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Request-With,x-xsrf-token, x-csrf-token');
        /*return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            ->header('Access-Control-Allow-Headers' 'Origin, Content-Type, Accept, Authorization, X-Request-With, x-xsrf-token, x-csrf-token');*/
    }
    
}
