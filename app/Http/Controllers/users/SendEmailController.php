<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    //function index()
    //{
    // return view('send_email');
    //}
    function send()
    {
        $data = array(
            'name'      =>  "name",
            'message'   =>   "testmessage"
        );
        
     Mail::to('milewskimateusz28@gmail.com')->send(new SendMail($data));
     return back()->with('success', 'Thanks for contacting us!');

    }
}