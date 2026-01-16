<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1️⃣ Pastikan sudah login
        if (! auth()->check()) {
            abort(403);
        }

        // 2️⃣ Ambil role user
        $userRole = auth()->user()->role->name;

        // 3️⃣ Cek apakah role user diizinkan
        if (! in_array($userRole, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
