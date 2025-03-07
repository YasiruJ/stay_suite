<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function showTermsConditions()
    {
        return view('home.terms_and_conditions');
    }

    public function showPrivacyPolicy()
    {
        return view('home.privacy_policy');
    }

    public function contactInfo(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        $data = [

            'Name' => $name,
            'Email' => $email,
            'Subject' => $subject,
            'Message' => $message,
        ];

        Mail::send('home.email.sendEmail', $data, function ($message) use ($data) {
            $message->from('info@whizchain.com', 'Gimanhal');
            $message->to('sulakshanirman97@gmail.com', 'Gimanhal')->subject('Contact Request' . $data['Name']);
        });

        return redirect()->back()->with('success_message', 'Thanks you for contact us');
    }
}
