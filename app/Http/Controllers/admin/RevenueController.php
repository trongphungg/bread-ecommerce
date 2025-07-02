<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\donhang;
use App\Models\chitietdonhang;
use Illuminate\Support\Facades\DB;


class RevenueController extends Controller
{
    public function index(){

        $revenuePerDay = donhang::select(
                DB::raw('DATE(ngaylapdh) as date'),
                DB::raw('SUM(tongtien) as total')
            )
            ->where('trangthaidh', 'HT')
            ->groupBy(DB::raw('DATE(ngaylapdh)'))
            ->orderBy('date', 'asc')
            ->get();

        $labels = $revenuePerDay->pluck('date');
        $data = $revenuePerDay->pluck('total');


        $thongKe = chitietdonhang::join('sanpham', 'chitietdonhang.idsanpham', '=', 'sanpham.idsanpham')
        ->select('sanpham.tensanpham', DB::raw('SUM(chitietdonhang.soluongsp) as tongsoluong'))
        ->groupBy('sanpham.tensanpham')
        ->get();
        $productLabels = $thongKe->pluck('tensanpham');
        $productData = $thongKe->pluck('tongsoluong');


        $colors = [];
        foreach ($productLabels as $label) {
        $colors[] = 'rgba(' . rand(100,255) . ',' . rand(100,255) . ',' . rand(100,255) . ', 1)';
}

        return view('admin.revenue.index',compact('labels','data','productLabels','productData','colors'));
    }
}
