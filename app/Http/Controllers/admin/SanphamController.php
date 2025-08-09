<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\sanpham;
use App\Models\loaisanpham;

class SanphamController extends Controller
{
    public function index(){
        $dssp = sanpham::where('trangthai','1')
        ->paginate(5);
        return view('admin.sanpham.index',compact('dssp'));
    }

    public function create(){
        $loaisp = loaisanpham::all();
        return view('admin.sanpham.create',compact('loaisp'));
    }

    public function handleCreate(Request $request){

    $sanpham = new sanpham();
    $sanpham->tensanpham = $request->input('tensanpham');
    $sanpham->motasanpham = $request->input('motasanpham');
    $sanpham->donvitinh = $request->input('dvt');
    
    if ($request->hasFile('hinh')) {
        $file = $request->file('hinh');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('customer/assets/img'), $fileName);
        $sanpham->hinh = $fileName;
    }
    
    $sanpham->dongia = $request->input('dongia');
    $sanpham->soluong = 0;
    $sanpham->trangthai=1;
    $sanpham->idloaisanpham = $request->input('loaisanpham');
    $sanpham->save();
    
    session()->flash('success', 'Thêm sản phẩm thành công !');
    return redirect('/products');

    }

    public function update($id){
        $sp = sanpham::where('idsanpham',$id)->first();
        $dslsp = loaisanpham::all();
        return view('admin.sanpham.update',compact('sp','dslsp'));
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
        try{
            $sanpham = sanpham::where('idsanpham',$id)
                            ->update([
                                'tensanpham' => $request->input('tensanpham'),
                                'motasanpham' => $request->input('motasanpham'),
                                'donvitinh' =>$request->input('dvt'),
                                'hinh'=>$fileName,
                                'dongia' => $request->input('dongia'),
                                'idloaisanpham' => $request->input('loaisanpham')
                            ]);
        session()->flash('success','Chỉnh sửa sản phẩm thành công !');
        return redirect('/products');
        }catch(\Exception $e){
            session()->flash('error', 'Chỉnh sửa sản phẩm thất bại');
            return redirect()->back();
        }
    }

    public function delete($id){
        $sp = sanpham::where('idsanpham',$id)
        ->update([
            'trangthai' => 0,
        ]);
        session()->flash('success','Xoá sản phẩm thành công !');
        return redirect('/products');
    }


    //Nguoi dung


    public function view(){
        $dsspp = sanpham::all();
        $dssp = sanpham::where('trangthai','1')
                        ->paginate(6);
        $dslsp = loaisanpham::all();
        return view('customer.sanpham',compact('dssp','dslsp','dsspp'));
    }

    public function search(Request $request){
        $query = $request->input('query');
        if(empty($request))
            $data = [];
        else
        {
        $data = sanpham::where('tensanpham','like','%'.$query.'%')
                        ->orWhere('idloaisanpham','like','%'.$query.'%')
                        ->get();
        }
        return response()->json([
            'data'=>$data
    ]);
    }
}
