<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\khachhang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index(){
        $khachhang = khachhang::where('idkhachhang',Auth::user()->idkhachhang)->first();
        return view('customer.profile',compact('khachhang'));
    }

    public function update(){
        $user = khachhang::where('idkhachhang',Auth::user()->idkhachhang)->first();
        return view('customer.updateProfile',compact('user'));
    }

    public function handleUpdate(Request $request){
        if($request->diachimoi)
            $diachi = $request->diachimoi;
        else $diachi = $request->diachi;
        $khachhang = khachhang::where('idkhachhang',Auth::user()->idkhachhang)
                            ->update([
                                'tenkhachhang' => $request->tennguoidung,
                                'ngaysinh' => $request->ngaysinh,
                                'diachi' =>$diachi,
                                'gioitinh'=>$request->gioitinh,
                                'sodienthoai' => $request->sodienthoai,
                                'role' => $request->role,
                                'email' => $request->email,
                                'password' => Hash::make($request->password)
                            ]);
        return redirect('/profile');
    }
}
