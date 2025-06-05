<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sanpham;

class ShopController extends Controller
{
    public function index(){
        $dssp = sanpham::all();
        $dssp = sanpham::paginate(6);
        return view('customer.shop',compact('dssp'));
    }
}
