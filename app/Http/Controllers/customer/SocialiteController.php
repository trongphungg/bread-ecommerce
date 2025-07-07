<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\nguoidung;

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

            $nguoidung = nguoidung::updateOrCreate([
                'google_id'=> $googleUser->id,
            ],[
                'tennguoidung' => $googleUser->name,
                'gioitinh' => '',
                'ngaysinh' => date('Y-m-d'),
                'sodienthoai' => ' ',
                'diachi' => ' ',
                'role'=>0,
                'facebook_id' => '',
                'email' => $googleUser->email,
                'password' => '',
            ]);
            DB::commit();
            Auth::login($nguoidung);
            return redirect('/');
        }
         catch (\Exception $e) {
            DB::rollBack();
            return redirect('/login')->withErrors(['google_login' => 'Đăng nhập Google thất bại.']);
        } 
    }
}
