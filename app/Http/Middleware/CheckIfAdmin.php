<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class CheckIfAdmin
{
    /**
     * Checked that the logged in user is an administrator.
     *
     * --------------
     * VERY IMPORTANT
     * --------------
     * If you have both regular users and admins inside the same table, change
     * the contents of this method to check that the logged in user
     * is an admin, and not a regular user.
     *
     * Additionally, in Laravel 7+, you should change app/Providers/RouteServiceProvider::HOME
     * which defines the route where a logged in user (but not admin) gets redirected
     * when trying to access an admin route. By default it's '/home' but Backpack
     * does not have a '/home' route, use something you've built for your users
     * (again - users, not admins).
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable|null  $user
     * @return bool
     */
    private function checkIfUserIsAdmin($user)
    {
        return $user && $user->getAttribute('role') == 'admin';
    }

    /**
     * Answer to unauthorized access request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    private function respondToUnauthorizedRequest($request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        } else {
            if (backpack_user()) {
                Session::forget('user');
                Auth::logout();
                backpack_auth()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                \Alert::add('error', 'Unauthorized!')->flash();
            }

            return redirect()->guest(backpack_url('login'));
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (backpack_auth()->guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }
        if (! $this->checkIfUserIsAdmin(backpack_user())) {
            return $this->respondToUnauthorizedRequest($request);
        }

        // Disable customer logged still login with admin account.
        if ($this->checkIfUserIsAdmin(backpack_user()) && auth()->user()) {
            if (backpack_user()) {
                backpack_auth()->logout();
                \Alert::add('error', 'You are logged in as user role, please logout and login again!')->flash();
            }
            return redirect()->guest(backpack_url('login'));
        }

        return $next($request);
    }
}
