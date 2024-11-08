<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica que el usuario esté autenticado
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Si el usuario es admin, permite el acceso completo
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Si el usuario es user, solo permite acceso a rutas de vista (métodos GET)
        if ($user->role === 'user' && $request->isMethod('get')) {
            return $next($request);
        }

        // Si no tiene permiso, redirige a una página de error o dashboard
        return redirect('/dashboard')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}

