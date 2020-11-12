<?php 

namespace App\Http\Middleware;

class CorsMiddleware {

	public function handle($request, \Closure $next)
	{
		$response = $next($request);
		$response->headers->set('Access-Control-Allow-Methods', 'HEAD, GET, POST, OPTIONS, PUT, PATCH, DELETE');
		$response->headers->set('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
		$response->headers->set('Access-Control-Allow-Origin', '*');
		return $response;
	}

}
