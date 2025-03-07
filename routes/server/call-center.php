<?php

use App\Http\Controllers\Server\CallCenter\CallCenterController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [CallCenterController::class, 'index']);
