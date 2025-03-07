<?php

namespace App\Http\Controllers\Server\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        return view('home.customer.dashboard');
    }

    public function showMyProfile()
    {
        $user = auth()->User();
        // dd($user);
        return view('home.customer.my_profile', ['user' => $user]);
    }

    public function editMyProfile(Request $request, $id)
    {
        //dd($id);
        $user = User::find($id);
        //dd($user);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->description = $request->input('description');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        $user->save();

        $res['success'] = true;
        $res['message'] = 'Profile Updated successfully!';

        return response($res);
    }

    public function showMyBooking()
    {
        return view('home.customer.my_booking');
    }

    public function ShowSavedItems()
    {
        return view('home.customer.saved_item');
    }

    public function showChangePassword()
    {
        return view('home.customer.change_password');
    }
}
