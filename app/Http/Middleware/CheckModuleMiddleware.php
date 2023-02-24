<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tenant;
use Auth;
use DB;


class CheckModuleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $tenant_id = Auth::user()->tenant_id;
        $segments = $request->segments();
        $moduleName = null;

        // Extract the module name from the request URL
        if (count($segments) >= 1 && $segments[0] === 'fees') {
            $moduleName = 'fees';
        } elseif (count($segments) >= 1 && $segments[0] === 'user') {
            $moduleName = 'user';
        } elseif (count($segments) >= 1 && $segments[0] === 'module') {
            $moduleName = 'module';
        } elseif (count($segments) >= 1 && $segments[0] === 'tenant') {
            $moduleName = 'tenant';
        }

        $allowedModules = DB::connection('central')->table('modules')->where('tenant_id', $tenant_id)->pluck('name')->toArray();


        // if (!$tenant->allowedModules()->contains($moduleName)) {
        //     abort(403, "Access to module '$moduleName' is not allowed for this tenant.");
        // }

        // ==========================================================================
        // $moduleName = $request->route()->parameter('module_name');
        // $tenantId = Auth::user()->tenant_id;


        // if (!in_array($moduleName, $allowedModules)) {
        //     abort(403, "Access to module '$moduleName' is not allowed for this tenant.");
        // }

        return $next($request);
    }
}
