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
        return view('customer.checkout',compact('dsct'));
    }

    public function finish(Request $request,PublicService $pub){
        if($request->diachigiao) 
            $diachi = $request->diachigiao;
        else 
            $diachi = $request->diachi;
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
