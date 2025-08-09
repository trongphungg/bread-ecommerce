<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ykien;


class YkienController extends Controller
{
    public function index(){
        $dsyk = ykien::paginate(5);
        return view('admin.ykien.index',compact('dsyk'));
    }

    public function create(){
        return view('admin.ykien.create');
    }

    public function handleCreate(Request $request){
        $ykien = new ykien();
        $ykien->tenkhachhang = $request->tenkhachhang;
        $ykien->mota = $request->mota;
        $ykien->nghenghiep = $request->nghenghiep;
        $ykien->sodiem = $request->sodiem;
        if($request->hasFile('hinh')){
            $file = $request->file('hinh');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('customer/assets/img'),$fileName);
            $ykien->hinh = $fileName;
        }
        $ykien->save();
        session()->flash('success','Thêm ý kiến thành công !');
        return redirect('/opinions');
    }

    public function update($id){
        $ykien = ykien::where('idykien',$id)->first();
        return view('admin.ykien.update',compact('ykien'));
    }

    public function handleUpdate(Request $request,$id){
        $fileName='';
        if($request->hasFile('hinh_moi')){
            $file = $request->file('hinh_moi');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('customer/assets/img'),$fileName);
        }
        else{
            $fileName = $request->input('hinh_cu');
        }
        $ykien = ykien::where('idykien',$id)
                            ->update([
                                'tenkhachhang' => $request->tenkhachhang,
                                'mota' => $request->mota,
                                'nghenghiep' =>$request->nghenghiep,
                                'sodiem'=>$request->sodiem,
                                'hinh'=>$fileName,
                            ]);
        session()->flash('success','Chỉnh sửa ý kiến thành công !');
        return redirect('/opinions');
    }

    public function delete($id){
        $ykien = ykien::where('idykien',$id);
        $ykien->delete();
        session()->flash('error','Xoá ý kiến thành công !');
        return redirect('/opinions');
    }
}
