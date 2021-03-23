<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Request;

class LastUserActivity
{
    /**
     * @param Request $request
     */
    public function handle($request, \Closure $next)
    {
        if (\Auth::check()) {
            $expiresAt = Carbon::now()->addWeek();
            \Cache::put('user-' . auth()->id() . '-last-activity', Carbon::now(), $expiresAt);
        }
        return $next($request);
    }
}
