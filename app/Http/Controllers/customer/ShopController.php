<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\loaisanpham;

class ShopController extends Controller
{
    public function index(){
        $dsspp = sanpham::all();
        $dssp = sanpham::paginate(6);
        $dslsp = loaisanpham::all();
        return view('customer.shop',compact('dssp','dslsp','dsspp'));
    }
}
