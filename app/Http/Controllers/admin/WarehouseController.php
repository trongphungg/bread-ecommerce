<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kho;
use App\Models\nguyenlieu;
use App\Models\chitietnhap;
use Illuminate\Support\Facades\DB;
use App\Services\PublicService;


class WarehouseController extends Controller
{
    public function index(){
        $dskho = kho::paginate(5);
        return view('admin.warehouse.index',compact('dskho'));
    }

    public function create(){
        $dsnl = nguyenlieu::all();
        $date = now();
        return view('admin.warehouse.create',compact('dsnl','date'));
    }

    public function apiNguyenlieu(){
        $dsnl = nguyenlieu::all();
        return response()->json([
            'dsnl' =>$dsnl
        ]);
    }

    public function details($id){
        $dschitiet = chitietnhap::where('idkho',$id)->get();
        return view('admin.warehouse.details',compact('dschitiet'));
    }

    public function handleCreate(Request $request, PublicService $pub){
        $validated = $request->validate([
            'idnguyenlieu' => 'required|array',
            'soluong' => 'required|array',  
            'soluong.*' => 'required|numeric|min:1',  
            'donvitinh' => 'required|array',  
            'donvitinh.*' => 'required|string',  
            'tongtien' => 'required|array'
        ]);

        $rawTotal = $request->total;

        $cleanTotal = preg_replace('/[^\d\.]/', '', $rawTotal);
        $cleanTotal = str_replace('.', '', $cleanTotal);


        $tongTien = (double)$cleanTotal;
        DB::beginTransaction();
        try{
            $kho = kho::create([
            'ghichu'=>$request->ghichu,
            'ngaynhap'=>now(),
            'tongtien'=>$tongTien,
        ]);

        foreach ($validated['idnguyenlieu'] as $index => $idnguyenlieu) {
            $rawTotal = $validated['tongtien'][$index];

            $cleanTotal = preg_replace('/[^\d\.]/', '', $rawTotal);
            $cleanTotal = str_replace('.', '', $cleanTotal);


            $tongTien = (double)$cleanTotal;
            chitietnhap::create([
                'idnguyenlieu' => $idnguyenlieu,
                'idkho' => $kho->idkho,
                'soluong' => $validated['soluong'][$index],
                'giatien' => $tongTien,
                
            ]);
            $nguyenlieu = nguyenlieu::where('idnguyenlieu',$idnguyenlieu)->first();
            $nguyenlieu->soluongton += $validated['soluong'][$index];
            $nguyenlieu->dongia = round($tongTien/$validated['soluong'][$index]);
            $nguyenlieu->ngaynhap = now();
            $nguyenlieu->update(); 
        }

        $pub->tinhSoLuongBanhMi();
        DB::commit();
        return redirect('/warehouse');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Lỗi khi nhập kho: ' . $e->getMessage());
        }
        
    }
}
