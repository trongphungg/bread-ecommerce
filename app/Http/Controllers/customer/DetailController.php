<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\danhgia;


class DetailController extends Controller
{
    public function detail($id){
        $sanpham = sanpham::where('idsanpham',$id)->first();
        $dssp = sanpham::inRandomOrder()->limit(5)->get();
        return view('customer.detail',compact('sanpham','dssp'));
    }

    
}
