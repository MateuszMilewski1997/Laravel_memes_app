<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Mail;

class SendEmailController extends Controller
{
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