<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\ykien;


class HomeController extends Controller
{
    public function index(){
        $dssanpham = sanpham::all();
        $dssp = sanpham::inRandomOrder()
                        ->get();
        $dsbm = sanpham::where('idloaisanpham',1)
                        ->inRandomOrder()
                        ->take(6)
                        ->get();
        $dsbb = sanpham::where('idloaisanpham',2)
                        ->inRandomOrder()
                        ->take(3)
                        ->get();
        $dsyk = ykien::all();
        return view('customer.home',compact('dssanpham','dsbm','dsbb','dsyk'));
    }
}
