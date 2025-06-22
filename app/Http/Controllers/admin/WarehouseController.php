<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kho;
use App\Models\nguyenlieu;
use App\Services\PublicService;


class WarehouseController extends Controller
{
    public function index(){
        $dskho = kho::paginate(5);
        return view('admin.warehouse.index',compact('dskho'));
    }

    public function create(){
        $dsnl = nguyenlieu::all();
        return view('admin.warehouse.create',compact('dsnl'));
    }

    public function apiNguyenlieu(){
        $dsnl = nguyenlieu::all();
        return response()->json([
            'dsnl' =>$dsnl
        ]);
    }

    public function handleCreate(Request $request, PublicService $pub){
        $validated = $request->validate([
            'idnguyenlieu' => 'required|array',  // Mảng các id nguyên liệu
            'soluong' => 'required|array',  // Mảng số lượng
            'soluong.*' => 'required|numeric|min:1',  // Kiểm tra số lượng hợp lệ
            'donvitinh' => 'required|array',  // Mảng đơn vị
            'donvitinh.*' => 'required|string',  // Kiểm tra đơn vị là chuỗi
            'tongtien' => 'required|array'
        ]);
        // Lưu dữ liệu vào bảng kho
        foreach ($validated['idnguyenlieu'] as $index => $idnguyenlieu) {
            Kho::create([
                'idnguyenlieu' => $idnguyenlieu,
                'soluong' => $validated['soluong'][$index],
                'donvitinh' => $validated['donvitinh'][$index],
                'tongtien' => $validated['tongtien'][$index],
                'ngaynhap' =>now(),
                'ghichu'=>''
            ]);
            $nguyenlieu = nguyenlieu::where('idnguyenlieu',$idnguyenlieu)->first();
            $nguyenlieu->soluongton += $validated['soluong'][$index];
            $nguyenlieu->dongia = round($validated['tongtien'][$index]/$validated['soluong'][$index]);
            $nguyenlieu->update(); 
        }

        $pub->tinhSoLuongBanhMi();
        // Trả về phản hồi khi lưu thành công
        return redirect('/warehouse');
    }
}
