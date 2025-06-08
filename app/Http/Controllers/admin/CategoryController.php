<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\loaisanpham;

class CategoryController extends Controller
{
    public function index(){
        $dslsp = loaisanpham::paginate(5);
        return view('admin.category.index',compact('dslsp'));
    }


    public function create(){
        return view('admin.category.create');
    }

    public function handleCreate(Request $request){
        $loaisanpham = new loaisanpham();
        $loaisanpham->tenloai = $request->tenloai;
        $loaisanpham->save();
        return redirect('/category');
    }

    public function update($id){
        $loaisanpham = loaisanpham::where('idloaisanpham',$id)->first();

        return view('admin.category.update',compact('loaisanpham'));
    }

    public function handleUpdate(Request $request,$id){
        $loaisanpham = loaisanpham::where('idloaisanpham',$id)
                                    ->update(
                                        ['tenloai'=>$request->tenloai]
                                    );
        return redirect('/category');
    }

    public function delete($id){
        $loaisanpham = loaisanpham::where('idloaisanpham',$id);
        $loaisanpham->delete();
        return redirect('/category');
    }
}
