<?php

namespace App\Http\Controllers\Server\ReferralUser;

use App\Http\Controllers\Controller;

class ReferralUserDashboardController extends Controller
{
    public function index()
    {
        return view('account.referralUser.dashboard');
    }
}
