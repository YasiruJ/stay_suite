<?php

namespace App\Http\Middleware;

use App\Enums\RoleType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $role = Auth::user()->getRoleNames()->first();

                switch ($role) {
                    case RoleType::SUPER_ADMIN():
                        return redirect('/super-admin/dashboard');
                        break;
                    case RoleType::ADMIN():
                        return redirect('/admin/dashboard');
                        break;
                    case RoleType::PROPERTY_OWNER():
                        return redirect('/property-owner/dashboard');
                        break;
                    case RoleType::CUSTOMER():
                        return redirect('/customer/dashboard');
                        break;
                    case RoleType::REFERRAL_USER():
                        return redirect('/referral-user/dashboard');
                        break;

                    default:
                        return '/';
                        break;
                }
            }
        }

        return $next($request);
    }
}
