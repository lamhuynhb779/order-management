<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UnsetEmptyReqParamsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request = $this->unsetEmpty($request);

        return $next($request);
    }

    private function unsetEmpty(Request $request): Request
    {
        $reqParams = $request->all();

        // Unset filter params
        $filters = $reqParams['filter'] ?? [];
        if ($filters) {
            foreach ($filters as $key => $value) {
                if (empty($value)) {
                    unset($filters[$key]);
                }
            }
            $request->merge(['filter' => $filters]);
        }

        // Unset Query params
        $queryParams = $request->except('filter', 'search');
        if ($queryParams) {
            foreach ($queryParams as $key => $value) {
                if (empty($value)) {
                    unset($request[$key]);
                }
            }
        }

        return $request;
    }
}
