<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\donhang;
use App\Models\chitietdonhang;

class OrderUserController extends Controller
{
    public function index(){
        $dsdh = donhang::where('idkhachhang', Auth::user()->idkhachhang)
                            ->where('trangthaidh','!=','')
                            ->whereNotIn('trangthaidh', ['HT', 'HD'])
                            ->orderBy('ngaylapdh', 'desc')
                            ->paginate(10);
        return view('customer.order',compact('dsdh'));
    }
    public function detail($id){
        $donhang = donhang::where('iddonhang',$id)->first();
        $dsctdh = chitietdonhang::where('iddonhang',$id)->get();
        $tongSoLuong = $dsctdh->sum('soluongsp');
        return view('customer.detailOrder',compact('donhang','dsctdh','tongSoLuong'));
    }

    public function history(){
        $dsdh = donhang::where('idkhachhang', Auth::user()->idkhachhang)
                            ->whereIn('trangthaidh', ['HT', 'HD'])
                            ->orderBy('ngaylapdh', 'desc')
                            ->paginate(10);
        return view('customer.historyOrder',compact('dsdh'));
    }
}
