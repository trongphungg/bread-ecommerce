<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tintuc;

class TintucController extends Controller
{
    public function index(){
        $tintuc = tintuc::where('idloaitintuc',2)->get();
        return view('customer.news',compact('tintuc'));
    }
}
