<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\khachhang;
use Illuminate\Support\Facades\DB;

class DangnhapController extends Controller
{
    public function index(){
        return view('customer.components.dangnhap');
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
            ]);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Mật khẩu không chính xác.',
            ]);
        }
        if ($user->trangthai == 0) {
                session()->flash('error','Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.');
        return back()->withErrors([
            'email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.',
        ]);
    }
        Auth::login($user);
        if ($user->role == 1) {
            session()->flash('success', 'Đăng nhập thành công !');
            return redirect('/dashboard');
        } else {
            session()->flash('success', 'Đăng nhập thành công !');
            return redirect('/');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flash('success', 'Đăng xuất thành công');
        return redirect('/');
    }

    public function register(){
        return view('customer.components.dangky');
    }

    public function handleCreate(Request $request){
        $credentials = $request->validate([
            'email' => 'unique:khachhang,email',
            'sodienthoai' => 'unique:khachhang,sodienthoai|digits_between:10,11',
            'matkhau' => 'min:6|confirmed'
        ],[
            'email.unique' => 'Bạn đã có tài khoản rồi. Hãy tiến hành đăng nhập',
            'sodienthoai.unique' => 'Số điện thoại đã được sử dụng',
            'sodienthoai.digits_between' => 'Số điện thoại phải có từ 10 đến 11 chữ số',
            'matkhau.confirmed' => 'Mật khẩu xác nhận không khớp',
            'matkhau.min' => 'Mật khẩu phải lớn hơn 6 kí tự'
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
        $khachhang->trangthai = 1;
        $khachhang->role = 0;

        $khachhang->save();
        session()->flash('success', 'Đăng ký thành công. Mời bạn đăng nhập vào cửa hàng nhé !');
        return redirect('/login');
        }
        else {
            session()->flash('error', 'Đăng ký thất bại. Mời bạn kiểm lại các trường dữ liệu');
            return redirect()->back();
        }
    }
}
