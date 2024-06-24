<?php

namespace App\Http\Middleware;

use App\Models\Store;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SetActiveDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $domain=$request->getHost();
        $store=Store::where('domain',$domain)->firstOrFail();
        app()->instance('store.active',$store);
        $db=$store->database_options['dbname'];
        Config::set('database.connections.tenant.database',$db);

        return $next($request);
    }
}
