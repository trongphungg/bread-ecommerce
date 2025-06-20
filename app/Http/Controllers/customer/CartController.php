<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart(){
        return view('customer.cart');
    }


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
        ]);
    }

    public function update(Request $request)
{
    $cart = session()->get('cart', new \stdClass());


    if (property_exists($cart, $request->idsanpham)) {

        $cart->{$request->idsanpham}->soluongsp = $request->quantity;
    } else {
        return response()->json([
            'message' => 'Product not found in cart!'
        ], 404);
    }


    session()->put('cart', $cart);

    return response()->json([
        'message' => 'Product quantity updated!',
        'cart' => $cart
    ]);
}

    public function delete($id){
        $cart = session()->get('cart',new \StdClass());
        if (property_exists($cart, $id)) {
        unset($cart->{$id});

        session()->put('cart', $cart);
    }
        return response()->json([
            'message' => 'Product removed!',
            'cart' => $cart
        ]);
    }
}
