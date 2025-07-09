<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Services\PublicService;
use App\Models\nguoidung;
use App\Models\donhang;
use App\Models\chitietdonhang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\CheckoutSuccess;



class CheckoutController extends Controller
{
    public function index(){
        $cart = session()->get('cart', new \stdClass());
        $dsct = $cart;
        return view('customer.checkout',compact('dsct'));
    }

    public function finish(Request $request,PublicService $pub){
        $cart = session()->get('cart', new \stdClass());

        if (empty((array) $cart)) {
        return redirect()->back()->with('error', 'Giỏ hàng đang trống. Vui lòng chọn sản phẩm trước khi đặt.');
    }

    DB::beginTransaction();
// Bước 1: Kiểm tra tồn kho trước
foreach ($cart as $item) {
    $sanpham = sanpham::find($item->idsanpham);
        if (!$sanpham) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }
    if ($sanpham->soluong < $item->soluongsp) {
        return redirect()->back()->with('error', 'Sản phẩm ' . $sanpham->tensanpham . ' hiện tại đã hết. Mời bạn thay đổi sản phẩm. Chúng tôi xin lỗi vì sự bất tiện này');
    }
}
        if($request->diachigiao) 
            $diachi = $request->diachigiao;
        else 
            $diachi = $request->diachi;
        if(Auth::user()){
            $id=Auth::user()->idnguoidung;
            $id_dh = donhang::where('idnguoidung',$id)
                            ->where('trangthaidh','')
                            ->first();
            $ctdh = chitietdonhang::where('iddonhang',$id_dh->iddonhang)->get();
            $dh = donhang::where('idnguoidung',$id)
                            ->where('trangthaidh','')
                            ->update([
                                'ngaylapdh' => now(),
                                'trangthaidh' => "CXN",
                                'tongtien' => $request->input('Tongtien'),
                                'diachi' => $diachi,
                                'tennguoidung'=> $request->tennguoidung,
                                'sodienthoai'=> $request->sodienthoai
                            ]);
        }
        else{
                $dh = new donhang();
                $dh->ngaylapdh= now();
                $dh->trangthaidh = 'CXN';
                $dh->tongtien = $request->input('Tongtien');
                $dh->diachi = $diachi;
                $dh->tennguoidung = $request->tennguoidung;
                $dh->sodienthoai = $request->sodienthoai;
                $dh->save();
                foreach ($cart as $item) {
                    DB::table('chitietdonhang')->updateOrInsert(
                                   ['idsanpham' => $item->idsanpham, 'iddonhang' => $dh->iddonhang], 
                                   [
                                       'soluongsp' => $item->soluongsp,
                                       'ghichu'=>$item->ghichu
                                   ]
                               );
               }
               $ctdh = chitietdonhang::where('iddonhang',$dh->iddonhang)->get();
        }
        foreach($cart as $item){
            $pub->xoaNguyenlieu($item);
        }
        

        $ten = $request->tennguoidung;
        Mail::to($request->email)->send(new CheckoutSuccess($ten,$ctdh,$diachi));

        session()->put('cart', new \stdClass()); 

        DB::commit();
        
        return redirect('/');
    }
}
