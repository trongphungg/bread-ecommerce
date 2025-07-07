<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nguoidung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function index(){
        $nguoidung = nguoidung::where('idnguoidung',Auth::user()->idnguoidung)->first();
        return view('customer.profile',compact('nguoidung'));
    }

    public function update(){
        $user = nguoidung::where('idnguoidung',Auth::user()->idnguoidung)->first();
        return view('customer.updateProfile',compact('user'));
    }

    public function handleUpdate(Request $request){
        if($request->diachimoi)
            $diachi = $request->diachimoi;
        else $diachi = $request->diachi;
        $nguoidung = nguoidung::where('idnguoidung',Auth::user()->idnguoidung)
                            ->update([
                                'tennguoidung' => $request->tennguoidung,
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
