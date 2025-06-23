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

class CheckoutController extends Controller
{
    public function index(){
        $cart = session()->get('cart', new \stdClass());
        $dsct = $cart;
        $dsquan = [
            "Quận 1", 
            "Quận 3", 
            "Quận 4", 
            "Quận 5", 
            "Quận 6", 
            "Quận 7", 
            "Quận 8", 
            "Quận 10", 
            "Quận 11", 
            "Quận 12", 
            "Quận Tân Bình", 
            "Quận Tân Phú", 
            "Quận Bình Tân", 
            "Quận Bình Thạnh", 
            "Quận Gò Vấp", 
            "Quận Phú Nhuận"
        ];
        return view('customer.checkout',compact('dsct','dsquan'));
    }

    public function finish(Request $request,PublicService $pub){
        if($request->diachigiao != null){
            $diachi = $request->diachigiao.'-'.$request->quangiao;
        }
        else $diachi = $request->diachi.'-'.$request->quan;
        if(Auth::user()){
            $id=Auth::user()->idnguoidung;
            $id_dh = donhang::where('idnguoidung',$id)
                            ->where('trangthaidh','')
                            ->first();
            $dh = donhang::where('idnguoidung',$id)
                            ->where('trangthaidh','')
                            ->update([
                                'ngaylapdh' => now(),
                                'trangthaidh' => "CXN",
                                'tongtien' => $request->input('Tongtien'),
                                'diachi' => $diachi,
                            ]);
        }
        else{
                $nguoidung = new nguoidung();
                $nguoidung->tennguoidung = $request->tennguoidung;
                $nguoidung->diachi = $diachi;
                $nguoidung->sodienthoai = $request->sodienthoai;
                $nguoidung->email = $request->email;
                $nguoidung->role = 1;
                $nguoidung->save();
    
                $dh = new donhang();
                $dh->idnguoidung = $nguoidung->idnguoidung;
                $dh->ngaylapdh= now();
                $dh->trangthaidh = 'CXN';
                $dh->tongtien = $request->input('Tongtien');
                $dh->diachi = $diachi;
                $dh->save();
    
    
                $cart = session()->get('cart', new \stdClass());
                foreach ($cart as $item) {
                    DB::table('chitietdonhang')->updateOrInsert(
                                   ['idsanpham' => $item->idsanpham, 'iddonhang' => $dh->iddonhang], 
                                   [
                                       'soluongsp' => $item->soluongsp,
                                       'ghichu'=>$item->ghichu
                                   ]
                               );
                // $pub->xoaNguyenlieu($item);
               }
        }
        session()->put('cart', new \stdClass()); 
        return redirect('/');
    }
}
