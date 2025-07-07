<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\loaisanpham;

class ShopController extends Controller
{
    public function index(){
        $dsspp = sanpham::all();
        $dssp = sanpham::paginate(6);
        $dslsp = loaisanpham::all();
        return view('customer.shop',compact('dssp','dslsp','dsspp'));
    }

    public function search(Request $request){
        $message = null;
        $query = $request->input('query');
        if(empty($request))
            $data = sanpham::all();
        else
        {
        $data = sanpham::where('tensanpham','like','%'.$query.'%')
                        ->orWhere('idloaisanpham','like','%'.$query.'%')
                        ->get();
        if ($data->isEmpty()) {
        $data = sanpham::all();
        }
        }
        return response()->json([
            'data'=>$data
    ]);
    }
}
