<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\nguoidung;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        return view('customer.components.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 
            if (Auth::user()->role == 1)
                return redirect('/dashboard'); 
            else
                return redirect('/');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function register(){
        return view('customer.components.register');
    }

    public function handleCreate(Request $request){
        $diachi = $request->diachi.' '.$request->quan;
        $nguoidung = new nguoidung();
        $nguoidung->tennguoidung = $request->input('tennguoidung');
        $nguoidung->ngaysinh = $request->input('ngaysinh');
        $nguoidung->diachi = $diachi;
        $nguoidung->gioitinh = $request->input('gioitinh');
        $nguoidung->sodienthoai = $request->input('sodienthoai');
        $nguoidung->email = $request->input('email');
        $nguoidung->password = Hash::make($request->input('matkhau'));
        $nguoidung->role = 0;
        $nguoidung->save();
        return redirect('/login');
    }
}
