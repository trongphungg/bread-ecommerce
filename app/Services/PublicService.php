<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\sanpham;


class PublicService
{
    function tinhSoLuongBanhMi()
{
    $data = DB::table('congthuc')
        ->join('nguyenlieu', 'congthuc.idnguyenlieu', '=', 'nguyenlieu.idnguyenlieu')
        ->select(
            'congthuc.idsanpham',
            'congthuc.idnguyenlieu',
            'nguyenlieu.soluongton as so_luong_kho',
            'congthuc.soluong as so_luong_can'
        )
        ->get();
    $ketQua = [];

    foreach ($data->groupBy('idsanpham') as $idsanpham => $nguyenlieus) {
        $soLuongToiDa = [];

        foreach ($nguyenlieus as $item) {
            if ($item->so_luong_can == 0) continue;

            $coTheLam = floor($item->so_luong_kho / $item->so_luong_can);
            $soLuongToiDa[] = $coTheLam;
        }

        $ketQua[$idsanpham] = count($soLuongToiDa) ? min($soLuongToiDa) : 0;
    }

foreach ($ketQua as $idsanpham => $soluong) {
    DB::table('sanpham')
            ->where('idsanpham', $idsanpham)
            ->update(['soluong' => $soluong]);
        }

//     foreach ($ketQua as $idsanpham => $soluong) {
        
//     $currentStatus = DB::table('sanpham')
//         ->where('idsanpham', $idsanpham)
//         ->value('trangthai');

//     if ($soluong > 0 && $currentStatus == 0) {
//         DB::table('sanpham')
//             ->where('idsanpham', $idsanpham)
//             ->update([
//                 'soluong' => $soluong,
//                 'trangthai' => 1
//             ]);
//     } else {
//         DB::table('sanpham')
//             ->where('idsanpham', $idsanpham)
//             ->update(['soluong' => $soluong]);
//     }
// }

}

function xoaNguyenlieu($item){

    $ct = DB::table('congthuc')
    ->where('idsanpham', $item->idsanpham)
    ->get();

    foreach ($ct as $a) {
    $tongLuong = $item->soluongsp * $a->soluong; 

    DB::table('nguyenlieu')
        ->where('idnguyenlieu', $a->idnguyenlieu)
        ->decrement('soluongton', $tongLuong);

        // $nlTon = DB::table('nguyenlieu')
        //     ->where('idnguyenlieu', $a->idnguyenlieu)
        //     ->value('soluongton');

        // if ($nlTon <= 0) {
        //     $hetNguyenLieu = true;
        // }
        }
    //     if ($hetNguyenLieu) {
    //         DB::table('sanpham')
    //             ->where('idsanpham', $item->idsanpham)
    //             ->update(['trangthai' => 0]);
    // }

    $this->tinhSoLuongBanhMi();
}

function themNguyenlieu($item){
    $ct = DB::table('congthuc')
    ->where('idsanpham', $item->idsanpham)
    ->get();

    foreach ($ct as $a) {
    $tongLuong = $item->soluongsp * $a->soluong; 

    DB::table('nguyenlieu')
        ->where('idnguyenlieu', $a->idnguyenlieu)
        ->increment('soluongton', $tongLuong);
    }
    $this->tinhSoLuongBanhMi();
}

}
