<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ExampleMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$secret = $request->header('secret');
		if (env('SECRET_SERVICE') == $secret) {
			return $next($request);
		}
		abort(Response::HTTP_UNAUTHORIZED);
	}
}
