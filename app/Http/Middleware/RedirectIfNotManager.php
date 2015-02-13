<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfNotManager {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (! $request->user()->can('manage_shops')) {
			return abort(403, '没有权限');
		}

		return $next($request);
	}

}
