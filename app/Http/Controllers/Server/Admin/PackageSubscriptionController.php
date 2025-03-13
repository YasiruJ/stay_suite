<?php

namespace App\Http\Controllers\Server\Admin;

use App\Enums\PackageTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackageSubscriptionController extends Controller
{
    public function viewAllSubscriptions()
    {

        $packageSubscriptions = PackageSubscription::all();
        return view('account.admin.package_subscriptions.all', ['packageSubscriptions' => $packageSubscriptions]);
    }

    public function viewAddSubscription()
    {
        $packages = Package::all();
        $users = User::role('property-owner')->get();

        return view('account.admin.package_subscriptions.add', ['packages' => $packages, 'users' => $users]);
    }

    public function saveSubscription(Request $request)
    {
        $user_id = $request->input('user_id');
        $package_id = $request->input('package_id');

        $package = Package::find($package_id);

        if (!$package) {
            $res['success'] = false;
            $res['message'] = 'Package not found';
            return response($res);
        }

        // Check if user already has a non-expired subscription
        $existingSubscription = PackageSubscription::where('user_id', $user_id)
            ->where('expires_at', '>', Carbon::now()) // Check if not expired
            ->first();

        if ($existingSubscription) {
            $res['success'] = false;
            $res['message'] = 'User already has an active subscription';
            $res['expires_at'] = $existingSubscription->expires_at;
            return response($res);
        }

        $expires_at = Carbon::now(); // Default to today
        if ($package->type == PackageTypeEnum::MONTHLY) {
            $expires_at->addDays(30);
        } elseif ($package->type == PackageTypeEnum::YEARLY) {
            $expires_at->addDays(365);
        }

        // Save the subscription
        $subscription = new PackageSubscription();
        $subscription->user_id = $user_id;
        $subscription->package_id = $package_id;
        $subscription->expires_at = $expires_at;
        $subscription->save();

        $res['success'] = true;
        $res['message'] = 'subscription added successfully!';
        return response($res);
    }
}
