<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\danhgia;
use App\Models\chitietdonhang;
use App\Models\donhang;


class DetailController extends Controller
{
    public function detail($id){
        $sanpham = sanpham::where('idsanpham',$id)->first();
        $dssp = sanpham::inRandomOrder()->limit(5)->get();
        $dsdg = danhgia::all();
        return view('customer.detail',compact('sanpham','dssp','dsdg'));
    }

    public function handleCreate(Request $request){
    $donhangs = donhang::where('idnguoidung', $request->idnguoidung)
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
        $danhgia->idnguoidung = $request->idnguoidung;
        $danhgia->idsanpham = $request->idsanpham;
        $danhgia->save();

        return redirect()->back()->with('success', 'Chúng tôi đã nhận được đánh giá của bạn. Đánh giá của bạn sẽ được kiểm tra và hiển thị sau');
    } else {
        return back()->withErrors([
            'thongbao' => 'Bạn chưa tiến hành mua sản phẩm này. Không thể đánh giá',
        ])->withInput();
    }
}
}
