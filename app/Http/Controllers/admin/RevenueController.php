<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Models\sanpham;
use Illuminate\Support\Facades\DB;


class RevenueController extends Controller
{
    public function index(){

        $revenuePerDay = donhang::select(
                DB::raw("DATE_FORMAT(ngaylapdh,'%d/%m/%Y') as date"),
                DB::raw('SUM(tongtien) as total')
            )
            ->where('trangthaidh', 'HT')
            ->groupBy(DB::raw("DATE_FORMAT(ngaylapdh, '%d/%m/%Y')"))
            ->orderBy('date', 'asc')
            ->get();

        $labels = $revenuePerDay->pluck('date');
        $data = $revenuePerDay->pluck('total');


        $revenuePerMonth = donhang::select(
        DB::raw("DATE_FORMAT(ngaylapdh, '%m-%Y') as month"),
        DB::raw('SUM(tongtien) as total')
        )
        ->where('trangthaidh', 'HT')
        ->groupBy(DB::raw("DATE_FORMAT(ngaylapdh, '%m-%Y')"))
        ->orderBy('month', 'asc')
        ->get();

        $labelsMonth = $revenuePerMonth->pluck('month'); 
        $dataMonth = $revenuePerMonth->pluck('total');


        $thongKe = chitietdonhang::join('sanpham', 'chitietdonhang.idsanpham', '=', 'sanpham.idsanpham')
        ->join('donhang','chitietdonhang.iddonhang','=','donhang.iddonhang')
        ->select('sanpham.tensanpham', DB::raw('SUM(chitietdonhang.soluongsp) as tongsoluong'))
        ->where('trangthaidh','HT')
        ->groupBy('sanpham.tensanpham')
        ->get();
        $productLabels = $thongKe->pluck('tensanpham');
        $productData = $thongKe->pluck('tongsoluong');


        $spbc = sanpham::join('chitietdonhang','sanpham.idsanpham', '=','chitietdonhang.idsanpham'
        )
        ->join('donhang','chitietdonhang.iddonhang','=','donhang.iddonhang')
        ->select('sanpham.tensanpham','sanpham.hinh', DB::raw('SUM(chitietdonhang.soluongsp) as tongsoluong'))
        ->where('trangthaidh','HT')
        ->groupBy('sanpham.tensanpham','sanpham.hinh')
        ->orderByDesc('tongsoluong')
        ->limit(5)
        ->get();
        
        //Bộ lọc
        $years = DB::table('donhang')
                ->select(DB::raw('YEAR(ngaylapdh) as year'))
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');


        $colors = [];
        foreach ($productLabels as $label) {
        $colors[] = 'rgba(' . rand(100,255) . ',' . rand(100,255) . ',' . rand(100,255) . ', 1)';
}

        return view('admin.revenue.index',compact('labels','data','productLabels','productData','colors','labelsMonth','dataMonth','spbc','years'));
    }

    public function filter(Request $request){
        $spbc = sanpham::join('chitietdonhang','sanpham.idsanpham', '=','chitietdonhang.idsanpham'
        )
        ->join('donhang','chitietdonhang.iddonhang','=','donhang.iddonhang')
        ->select('sanpham.tensanpham','sanpham.hinh', DB::raw('SUM(chitietdonhang.soluongsp) as tongsoluong'))
        ->where('trangthaidh','HT')
        ->whereMonth('ngaylapdh',$request->thang)
        ->groupBy('sanpham.tensanpham','sanpham.hinh')
        ->orderByDesc('tongsoluong')
        ->limit(5)
        ->get();

        return response()->json([
            'message' => 'success',
            'spbc' => $spbc,
            'thang' =>$request->thang
        ]);
    }


    
}
