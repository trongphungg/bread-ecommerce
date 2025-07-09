<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nguoidung;
use App\Models\donhang;
use App\Models\chitietdonhang;

class OrderController extends Controller
{
    public function index(){
        $dsdh = donhang::where('trangthaidh','!=','')
        ->orderBy('ngaylapdh', 'desc')
        ->paginate(5);
        return view('admin.order.index',compact('dsdh'));
    }

    public function detail($id){
        $ctdh = chitietdonhang::where('iddonhang',$id)->get();
        $dh = donhang::where('iddonhang',$id)->first();
        return view('admin.order.detail',compact('ctdh','dh'));
    }


    public function update($id, Request $request){
        $sp = donhang::where('iddonhang',$id)
                ->update([
                    'trangthaidh' => $request->trangthaidh
                ]);
        return redirect('/orders');
    }
}
