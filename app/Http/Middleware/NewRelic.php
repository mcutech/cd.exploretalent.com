<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class: NewRelic
 */
class NewRelic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Check if we have NEW RELIC
        if (extension_loaded('newrelic') && !\App::runningUnitTests()) {
            // Get the correct app name
            newrelic_set_appname('CD.ET');
        }

        // Next middleware
        return $next($request);
    }
}
