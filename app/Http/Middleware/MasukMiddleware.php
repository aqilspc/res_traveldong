<?php
 
namespace App\Http\Middleware;
 
use Closure;
use App\User;
 
class MasukMiddleware
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
        $key ='1612289214-SulOrxGL35baTPnGOxgwXmFCRQYsotdFAqil'; //API KEY
        // header("APIKEY: 1612289214-SulOrxGL35baTPnGOxgwXmFCRQYsotdFAqil");
        $data = apache_request_headers(); //
        if ($data['APIKEY']!=$key) {
             return response()->json(['status' => 'error api key'], 500);
        } else {
            return $next($request);
        }
    }
}