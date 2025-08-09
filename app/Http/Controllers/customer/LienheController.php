<?php

namespace App\Http\Controllers\customer;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\LienheMail;

use Mail;

class LienheController extends Controller
{
    public function index(){
        return view('customer.lienhe');
    }

    public function sendMail(Request $request){
        Mail::to($request->email)->send(new LienheMail($request->name,$request->content));
        session()->flash('success', 'Cảm ơn quý khách đã phản hồi! Chúng tôi sẽ liên hệ cách sớm nhất');
        return redirect('/');
    }
}
