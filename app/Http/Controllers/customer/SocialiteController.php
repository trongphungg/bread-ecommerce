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
                'facebook_id' => '',
                'password' => '',
                'google_id'=> $googleUser->id,
                'email' => $googleUser->email
            ]);
            DB::commit();
            }
            
            Auth::login($khachhang);
            return redirect('/');
        }
         catch (\Exception $e) {
            DB::rollBack();
            return redirect('/login')->withErrors(['google_login' => 'Đăng nhập Google thất bại.']);
        } 
    }
}
