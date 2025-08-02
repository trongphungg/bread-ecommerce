<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\khachhang;
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
        ], [
            'email.required' => 'Bạn cần nhập địa chỉ email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'password.required' => 'Bạn cần nhập mật khẩu'
]);

        $user = khachhang::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email không tồn tại trong hệ thống.',
            ])->withInput();
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Mật khẩu không chính xác.',
            ])->withInput();
        }
        Auth::login($user);
        if ($user->role == 1) {
            return redirect('/dashboard');
        } else {
            return redirect('/');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register(){
        return view('customer.components.register');
    }

    public function handleCreate(Request $request){
        $credentials = $request->validate([
            'email' => 'unique:khachhang,email',
            'sodienthoai' => 'unique:khachhang,sodienthoai',
            'matkhau' => 'min:3|confirmed'
        ],[
            'email.unique' => 'Bạn đã có tài khoản rồi. Hãy tiến hành đăng nhập',
            'sodienthoai.unique' => 'Số điện thoại đã được sử dụng',
            'matkhau.confirmed' => 'Mật khẩu xác nhận không khớp',
            'matkhau.min' => 'Mật khẩu phải lớn hơn 3 kí tự'
        ]);

        $diachi = $request->diachimoi;

        if($credentials){
            $khachhang = new khachhang();
        $khachhang->tenkhachhang = $request->input('tennguoidung');
        $khachhang->ngaysinh = $request->input('ngaysinh');
        $khachhang->diachi = $diachi;
        $khachhang->gioitinh = $request->input('gioitinh');
        $khachhang->sodienthoai = $request->input('sodienthoai');
        $khachhang->email = $request->input('email');
        $khachhang->password = Hash::make($request->input('matkhau'));
        $khachhang->role = 0;

        $khachhang->save();
        return redirect('/login');
        }
        else return redirect()->back();
    }
}
