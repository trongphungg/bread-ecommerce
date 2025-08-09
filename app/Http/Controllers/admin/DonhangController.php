<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Services\PublicService;


class DonhangController extends Controller
{
    public function index(){
        $dsdh = donhang::where('trangthaidh','!=','')
        ->orderBy('ngaylapdh', 'desc')
        ->paginate(5);
        $tongHT = donhang::where('trangthaidh','HT')->count();
        $tongDG = donhang::where('trangthaidh','DG')->count();
        $tongTT = donhang::where('trangthaidh','DTT')->count();
        $tongCXN = donhang::where('trangthaidh','CXN')->count();
        return view('admin.donhang.index',compact('dsdh','tongHT','tongDG','tongTT','tongCXN'));
    }

    public function detail($id){
        $ctdh = chitietdonhang::where('iddonhang',$id)->get();
        $dh = donhang::where('iddonhang',$id)->first();
        return view('admin.donhang.detail',compact('ctdh','dh'));
    }


    public function update($id, Request $request, PublicService $pub){
        $sp = donhang::where('iddonhang',$id)
                ->update([
                    'trangthaidh' => $request->trangthaidh
                ]);
        if($request->trangthaidh == 'HD'){
            $cart = chitietdonhang::where('iddonhang',$id)->get();
            foreach($cart as $a){
                $pub->themNguyenlieu($a);
            }
        }
        session()->flash('success','Duyệt đơn hàng thành công!');
        return redirect('/orders');
    }


    //Nguoi dung

    public function view(){
        $dsdh = donhang::where('idkhachhang', Auth::user()->idkhachhang)
                            ->where('trangthaidh','!=','')
                            ->whereNotIn('trangthaidh', ['HT', 'HD'])
                            ->orderBy('ngaylapdh', 'desc')
                            ->paginate(10);
        return view('customer.donhang',compact('dsdh'));
    }
    public function detailUser($id){
        $donhang = donhang::where('iddonhang',$id)->first();
        $dsctdh = chitietdonhang::where('iddonhang',$id)->get();
        $tongSoLuong = $dsctdh->sum('soluongsp');
        return view('customer.chitietdonhang',compact('donhang','dsctdh','tongSoLuong'));
    }

    public function history(){
        $dsdh = donhang::where('idkhachhang', Auth::user()->idkhachhang)
                            ->whereIn('trangthaidh', ['HT', 'HD'])
                            ->orderBy('ngaylapdh', 'desc')
                            ->paginate(10);
        return view('customer.lichsudonhang',compact('dsdh'));
    }
}
