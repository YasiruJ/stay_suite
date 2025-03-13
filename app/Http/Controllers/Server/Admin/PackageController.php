<?php

namespace App\Http\Controllers\Server\Admin;

use App\Enums\PackageTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function viewAllPackages() {

        $packages = Package::all();
        return view('account.admin.packages.all',['packages'=> $packages]);
    }

    public function viewAddPackages() {
        $packageTypes = PackageTypeEnum::getAll();
        // dd($packageTypes[0]);
        return view('account.admin.packages.add',['packageTypes' => $packageTypes]);
    }

    public function savePackage(Request $request) {
        $name = $request->input('name');
        $type = $request->input('type');

        $package = new Package();
        $package->name = $name;
        $package->type = $type;
        $package->save();

        $res['success'] = true;
        $res['message'] = 'package added successfully!';
        return response($res);
    }
}
