<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = session()->get('cart',new \stdClass());
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
                'hinh' => $request->hinh
            ];
        }

        session()->put('cart',$cart);

        return response()->json([
            'message' => 'Thêm sản phẩm vào giỏ hàng thành công',
            'cart'=>$cart,
            'tensanpham'=>$request->tensanpham,
        ]);
    }
}
