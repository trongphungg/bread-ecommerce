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
        return view('customer.updateProfile',compact('user','dsquan'));
    }

    public function handleUpdate(Request $request){
        $diachi = $request->diachi.'-'.$request->quan;
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
