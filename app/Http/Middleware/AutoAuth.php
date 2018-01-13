<?php

namespace App\Http\Middleware;

use App\Http\Traits\Authorize;
use Closure;

class AutoAuth
{
    use Authorize;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $router = $request->route();
        if($router && $router->action) {
            $action = explode('@',$router->action['controller'])[1];
            $resource = $request->attributes->get('rigger_entity');
            $this->auth($request, $action, $resource);
        }
        return $next($request);
    }
}
