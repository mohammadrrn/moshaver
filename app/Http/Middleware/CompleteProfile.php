<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AssistantController;
use Closure;
use Illuminate\Http\Request;

class CompleteProfile
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->profileStatus != 1 && AssistantController::getUserRole() != 'admin')
            return redirect(route('panel.profile'))->withErrors('ابتدا پروفایل کاربری خود را تکمیل کنید');
        return $next($request);
    }
}
