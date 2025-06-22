<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use App\Services\PublicService;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\donhang;

class TestController extends Controller
{
    function test()
{
    $dh = donhang::where('idnguoidung',Auth::user()->idnguoidung)
                        ->where('trangthaidh',"")
                        ->first();

                      $test=  DB::table('chitietdonhang')
                ->where('idsanpham', 1)
                ->where('iddonhang', $dh->iddonhang) 
                ->get();
    dd($test);
}

}
