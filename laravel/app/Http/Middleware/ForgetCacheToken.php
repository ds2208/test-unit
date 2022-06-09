<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Lib\CacheManagement;

class ForgetCacheToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$tableName, $entityName = null)
    {
        CacheManagement::forgetCacheTokenForEntity($tableName);
        return $next($request);
    }
}
