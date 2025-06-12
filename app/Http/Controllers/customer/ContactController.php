<?php

namespace App\Http\Controllers\customer;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\LienheMail;

use Mail;

class ContactController extends Controller
{
    public function index(){
        return view('customer.contact');
    }

    public function sendMail(Request $request){
        Mail::to($request->email)->send(new LienheMail($request->name,$request->content));
        return redirect('/');
    }
}
