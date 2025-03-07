<?php

use App\Http\Controllers\Server\ReferralUser\ReferralUserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [ReferralUserDashboardController::class, 'index']);
