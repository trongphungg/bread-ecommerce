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
}
}
}
