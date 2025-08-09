<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\danhgia;
use App\Models\chitietdonhang;
use App\Models\donhang;


class ChitietsanphamController extends Controller
{
    public function detail($id){
        $sanpham = sanpham::where('idsanpham',$id)->first();
        $dssp = sanpham::inRandomOrder()->limit(5)->get();
        $dsdg = danhgia::all();
        return view('customer.chitietsanpham',compact('sanpham','dssp','dsdg'));
    }

    public function handleCreate(Request $request){
    $donhangs = donhang::where('idkhachhang', $request->idnguoidung)
                        ->where('trangthaidh', 'HT')
                        ->pluck('iddonhang');

    $exists = chitietdonhang::whereIn('iddonhang', $donhangs)
                            ->where('idsanpham', $request->idsanpham)
                            ->exists();
    if ($exists) {
        $danhgia = new danhgia();
        $danhgia->danhgia = $request->danhgia;
        $danhgia->sodiem = $request->sodiem;
        $danhgia->ngaydanhgia = now();
        $danhgia->trangthaidg = 0;
        $danhgia->idkhachhang = $request->idnguoidung;
        $danhgia->idsanpham = $request->idsanpham;
        $danhgia->save();

        session()->flash('success', 'Chúng tôi đã nhận được đánh giá của bạn. Đánh giá của bạn sẽ được kiểm tra và hiển thị sau');
        return redirect()->back();
    } else {
        session()->flash('error', 'Bạn chưa hoàn tất việc mua sản phẩm này. Không thể đánh giá');
        return redirect()->back();
    }
}
}
