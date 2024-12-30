<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        if (!$user || !$user->hasPermission($permission)) {
            abort(403, 'Bạn không có quyền truy cập.');
        }
    }
}
