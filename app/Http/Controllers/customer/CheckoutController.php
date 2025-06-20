<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\nguoidung;
use App\Models\donhang;
use App\Models\chitietdonhang;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(){
        $cart = session()->get('cart', new \stdClass());
        $data = $cart;
        $dssp = sanpham::all();
        return view('customer.checkout',compact('data','dssp'));
    }

    public function finish(Request $request){
        $nguoidung = new nguoidung();
            $nguoidung->tennguoidung = $request->tennguoidung;
            $nguoidung->diachi = $request->diachi;
            $nguoidung->sodienthoai = $request->sodienthoai;
            $nguoidung->email = $request->email;
            $nguoidung->role = 1;
            $nguoidung->save();


            $dh = new donhang();
            $dh->idnguoidung = $nguoidung->idnguoidung;
	        $dh->ngaylapdh= now();
            $dh->trangthaidh = 'CXN';
            $dh->tongtien = $request->input('Tongtien');
            $dh->diachi = $request->diachi;
            $dh->save();


            $cart = session()->get('cart', new \stdClass());
            foreach ($cart as $item) {
                DB::table('chitietdonhang')->updateOrInsert(
                               ['idsanpham' => $item->idsanpham, 'iddonhang' => $dh->iddonhang], 
                               [
                                   'soluongsp' => $item->soluongsp,
                               ]
                           );
           }
        session()->put('cart', new \stdClass()); 
        return redirect('/');
    }
}
