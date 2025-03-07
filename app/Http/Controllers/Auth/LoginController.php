<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleType;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $role = Auth::user()->getRoleNames()->first();
        switch ($role) {
            case RoleType::SUPER_ADMIN():
                return '/super-admin/dashboard';
                break;
            case RoleType::ADMIN():
                return '/admin/dashboard';
                break;
            case RoleType::PROPERTY_OWNER():
                return '/property-owner/dashboard';
                break;
            case RoleType::REFERRAL_USER():
                return '/referral-user/dashboard';
                break;
            case RoleType::CUSTOMER():
                return '/customer/dashboard';
                break;
            case RoleType::CALL_CENTER():
                return '/call-center/dashboard';
                break;

            default:
                return '/';
                break;
        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return string
     */
    protected function authenticated($request, $user)
    {
        //  dd($request->all());
        if ($request->has('returnURL')) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // $role = Auth::user()->getRoleNames()->first();
                // dd( $role);
                return redirect()->intended($request->returnURL);
            }
        } else {
            $this->redirectTo();
        }
    }
}
