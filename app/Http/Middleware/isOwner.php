<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isOwner
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à cette section.');
        }

        if (Auth::user()->role !== 'owner') {
            return redirect()->route('become-an-owner')
                ->with('warning', 'Cette section est réservée aux propriétaires. Devenez propriétaire pour y accéder.');
        }

        return $next($request);
    }
}
