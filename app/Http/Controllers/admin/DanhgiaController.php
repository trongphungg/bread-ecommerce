<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\danhgia;

class DanhgiaController extends Controller
{
    public function index(){
        $dsdg = danhgia::orderBy('ngaydanhgia','desc')
        ->paginate(5);
        $dgHT = danhgia::where('trangthaidg',1)->get();
        $dgAn = danhgia::where('trangthaidg',0)->get();
        return view('admin.danhgia.index',compact('dsdg','dgHT','dgAn'));
    }

    public function handleUpdate($id){
        $danhgia = danhgia::where('iddanhgia',$id)->first();
        if ($danhgia) {
            $danhgia->update([
                'trangthaidg' => $danhgia->trangthaidg == 0 ? 1 : 0,
            ]);
        }
        session()->flash('success','Cập nhật đánh giá thành công!');
        return redirect()->route('reviewIndex');
    }
}
