<?php

namespace App\Http\Controllers\Server\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function viewAllPackages() {
        return view('account.admin.packages.all');
    }
}
