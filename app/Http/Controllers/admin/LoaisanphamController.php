<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\loaisanpham;

class LoaisanphamController extends Controller
{
    public function index(){
        $dslsp = loaisanpham::paginate(5);
        return view('admin.loaisanpham.index',compact('dslsp'));
    }


    public function create(){
        return view('admin.loaisanpham.create');
    }

    public function handleCreate(Request $request){
        $loaisanpham = new loaisanpham();
        $loaisanpham->tenloai = $request->tenloai;
        $loaisanpham->save();
        session()->flash('success','Thêm loại sản phẩm thành công!');
        return redirect('/category');
    }

    public function update($id){
        $loaisanpham = loaisanpham::where('idloaisanpham',$id)->first();

        return view('admin.category.update',compact('loaisanpham'));
    }

    public function handleUpdate(Request $request,$id){
        try{
            $loaisanpham = loaisanpham::where('idloaisanpham',$id)
                                    ->update(
                                        ['tenloai'=>$request->tenloai]
                                    );
        session()->flash('success','Chỉnh sửa loại sản phẩm thành công!');
        return redirect('/category');
        }catch(\Exception $e){
            session()->flash('error','Chỉnh sửa loại sản phẩm thất bại!');
        return redirect('/category');
        }
    }

    public function delete($id){
        try{
            $loaisanpham = loaisanpham::where('idloaisanpham',$id);
        $loaisanpham->delete();
        session()->flash('success','Xoá loại sản phẩm thành công!');
        return redirect('/category');
        }catch(\Exception $e){
            return redirect('/category')->with('error', 'Không thể xoá loại sản phẩm này.');
        }
    }
}
