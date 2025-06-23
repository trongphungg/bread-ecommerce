<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\donhang;
use App\Models\sanpham;
use App\Models\chitietdonhang;



class CartController extends Controller
{
    public function showCart(){
        return view('customer.cart');
    }


    public function index(){
        $cart = session()->get('cart',new \stdClass());
            if(Auth::user()){
                $user_id = Auth::user()->idnguoidung;
                $dh = donhang::where('idnguoidung',$user_id)
                                ->where('trangthaidh','')
                                ->first();
                if(!$dh){
                    $dh = new donhang();
                    $dh->idnguoidung=$user_id;
                    $dh->ngaylapdh=now();
                    $dh->trangthaidh='';
                    $dh->tongtien=0;
                    $dh->diachi='';
                    $dh->save();
                }
                foreach($cart as $item){
                    DB::table('chitietdonhang')->updateOrInsert(
                        ['idsanpham'=>$item->idsanpham,'iddonhang'=>$dh->iddonhang],
                        ['soluongsp'=>$item->soluongsp,
                         'ghichu'=>$item->ghichu
                        ]
                );
                }
                $data = chitietdonhang::where('iddonhang',$dh->iddonhang)->get();
                    $dataFormatted = $data->map(function($item) {
                    $sp = sanpham::where('idsanpham', $item->idsanpham)->first();
                    return (object)[
                        'idsanpham' => $item->idsanpham,
                        'tensanpham' => $item->sanpham->tensanpham,
                        'dongia' => $item->sanpham->dongia,
                        'soluongsp' => $item->soluongsp,
                        'hinh' => $item->sanpham->hinh,
                        'ghichu'=> $item->ghichu
                    ];
                    })->keyBy('idsanpham')->toArray();

                    foreach($dataFormatted as $key => $value){
                        $cart->{$key} = $value;
                    }
            }
        session()->put('cart', $cart);
        return response()->json($cart);
    }

    public function add(Request $request){
        $cart = session()->get('cart',new \stdClass());
        if(property_exists($cart,$request->idsanpham))
            $cart->{$request->idsanpham}->soluongsp += $request->soluongsp;
        else{
            $cart->{$request->idsanpham} = (object)[
                'idsanpham' => $request->idsanpham,
                'tensanpham' => $request->tensanpham,
                'dongia' => $request->dongia,
                'soluongsp' => $request->soluongsp,
                'hinh' => $request->hinh,
                'ghichu'=>''
            ];
        }
        session()->put('cart',$cart);

        return response()->json([
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
            'cart'=>$cart,
        ]);
    }

    public function update(Request $request,$id)
{
    $cart = session()->get('cart', new \stdClass());
    if (property_exists($cart, $id)) {
        $cart->{$id}->soluongsp = $request->quantity;
        $cart->{$id}->ghichu = $request->note;
    } else {
        return response()->json([
            'message' => 'Product not found in cart!'
        ], 404);
    }

    session()->put('cart', $cart);

    return response()->json([
        'message' => 'Product quantity updated!',
        'cart' => $cart,
    ]);
}

    public function delete($id){
        $cart = session()->get('cart',new \StdClass());
        if (property_exists($cart, $id)) {
        unset($cart->{$id});
        session()->put('cart', $cart);
        if (Auth::check()) {
            $dh = donhang::where('idnguoidung',Auth::user()->idnguoidung)
                        ->where('trangthaidh',"")
                        ->first();
            DB::table('chitietdonhang')
                ->where('idsanpham', $id)
                ->where('iddonhang', $dh->iddonhang) 
                ->delete();
        }
        
    }
    return response()->json([
            'message' => 'Product removed!',
            'cart' => $cart
        ]);
    }
}
