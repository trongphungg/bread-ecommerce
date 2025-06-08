<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\sanpham;
use App\Models\loaisanpham;

class ProductController extends Controller
{
    public function index(){
        $dssp = sanpham::paginate(5);
        return view('admin.product.index',compact('dssp'));
    }

    public function create(){
        $loaisp = loaisanpham::all();
        return view('admin.product.create',compact('loaisp'));
    }

    public function handleCreate(Request $request){
        $sanpham = new sanpham();
        $sanpham->tensanpham = $request->input('tensanpham');
        $sanpham->motasanpham = $request->input('motasanpham');
        $sanpham->donvitinh = $request->input('dvt');
        if($request->hasFile('hinh')){
            $file = $request->file('hinh');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('customer/assets/img'),$fileName);
            $sanpham->hinh = $fileName;
        }
        $sanpham->trangthai = $request->input('trangthai');
        $sanpham->dongia = $request->input('dongia');
        $sanpham->idloaisanpham = $request->input('loaisanpham');
        $sanpham->save();
        return redirect('/products');
    }

    public function update($id){
        $sp = sanpham::where('idsanpham',$id)->first();
        $dslsp = loaisanpham::all();
        return view('admin.product.update',compact('sp','dslsp'));
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
        $sanpham = sanpham::where('idsanpham',$id)
                            ->update([
                                'tensanpham' => $request->input('tensanpham'),
                                'motasanpham' => $request->input('motasanpham'),
                                'donvitinh' =>$request->input('dvt'),
                                'hinh'=>$fileName,
                                'trangthai'=>$request->input('trangthai'),
                                'dongia' => $request->input('dongia'),
                                'idloaisanpham' => $request->input('loaisanpham')
                            ]);
        return redirect('/products');
    }

    public function delete($id){
        $sp = sanpham::where('idsanpham',$id)->first();
        $sp->delete();
        return redirect('/products');
    }
}
