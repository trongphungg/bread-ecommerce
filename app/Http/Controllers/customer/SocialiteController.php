<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\khachhang;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        DB::beginTransaction();

        try{
            $googleUser = Socialite::driver('google')
            ->with(['verify' => false])
                    ->stateless()
                    ->user();

            $khachhang = khachhang::where('email',$googleUser->email)->first();
            if(!$khachhang){
                $khachhang = khachhang::create([
                'tenkhachhang' => $googleUser->name,
                'gioitinh' => 0,
                'ngaysinh' => date('Y-m-d'),
                'sodienthoai' => ' ',
                'diachi' => ' ',
                'role'=>0,
                'trangthai'=>1,
                'facebook_id' => '',
                'password' => Hash::make(123456),
                'google_id'=> $googleUser->id,
                'email' => $googleUser->email
            ]);
            DB::commit();
            }
            if ($khachhang->trangthai == 0) {
                session()->flash('error','Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.');
        return redirect('/login');
    }
            Auth::login($khachhang);
            session()->flash('success','Đăng nhập thành công!');
            return redirect('/');
        }
         catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error','Đăng nhập thất bại!');
            return redirect('/login')->withErrors(['google_login' => 'Đăng nhập Google thất bại.']);
        } 
    }



    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        try{
	DB::beginTransaction();
        $facebookUser = Socialite::driver('facebook')
        ->with(['verify' => false])
                ->stateless()
                ->user();

        
         $khachhang = khachhang::where('email',$facebookUser->email)->first();
            if(!$khachhang){
                $khachhang = khachhang::create([
                'tenkhachhang' => $facebookUser->name,
                'gioitinh' => 0,
                'ngaysinh' => date('Y-m-d'),
                'sodienthoai' => ' ',
                'diachi' => ' ',
                'role'=>0,
                'trangthai' => 1,
                'facebook_id' => $facebookUser->id,
                'password' => Hash::make(123456),
                'google_id'=> '',
                'email' => $facebookUser->email
            ]);
            DB::commit();
            }
            if ($khachhang->trangthai == 0) {
                session()->flash('error','Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.');
        return redirect('/login');
    }
        Auth::login($khachhang);
	session()->flash('success','Đăng nhập thành công!');
        return redirect('/');
	}catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error','Đăng nhập thất bại!');
            return redirect('/login')->withErrors(['facebook_login' => 'Đăng nhập Facebook thất bại.']);
        } 
    }

    public function logout(){

    }
}
