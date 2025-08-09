<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\ykien;


class TrangchuController extends Controller
{
    public function index(){
        $dssanpham = sanpham::where('trangthai', '1')
    ->join('chitietdonhang', 'sanpham.idsanpham', '=', 'chitietdonhang.idsanpham')
    ->select('sanpham.idsanpham', 'sanpham.tensanpham', DB::raw('SUM(chitietdonhang.soluongsp) as tong_soluong'))
    ->groupBy('sanpham.idsanpham', 'sanpham.tensanpham')
    ->get();
        $dssp = sanpham::where('trangthai','1')
        ->inRandomOrder()
                        ->get();
        $dsbm = sanpham::where('idloaisanpham',1)
                        ->where('trangthai',1)
                        ->inRandomOrder()
                        ->take(6)
                        ->get();
        $dsbb = sanpham::where('idloaisanpham',2)
                        ->inRandomOrder()
                        ->take(3)
                        ->get();
        $dsyk = ykien::all();
        return view('customer.trangchu',compact('dssanpham','dsbm','dsbb','dsyk'));
    }
}
