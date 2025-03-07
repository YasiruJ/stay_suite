<?php

namespace App\Http\Controllers\Server\CallCenter;

use App\Http\Controllers\Controller;

class CallCenterController extends Controller
{
    public function index()
    {
        return view('account.callcenter.dashboard');
    }
}
