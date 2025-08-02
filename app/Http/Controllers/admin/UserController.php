<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\khachhang;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $dsuser = khachhang::paginate(5);
        return view('admin.user.index',compact('dsuser'));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function handleCreate(Request $request){
        $diachi = $request->diachi;
        $khachhang = new khachhang();
        $khachhang->tenkhachhang = $request->input('tennguoidung');
        $khachhang->ngaysinh = $request->input('ngaysinh');
        $khachhang->diachi = $diachi;
        $khachhang->gioitinh = $request->input('gioitinh');
        $khachhang->sodienthoai = $request->input('sodienthoai');
        $khachhang->email = $request->input('email');
        $khachhang->password = Hash::make($request->input('password'));
        $khachhang->role = $request->input('role');
        $khachhang->save();

        return redirect('/users');
    }

    public function update($id){
        $user = khachhang::where('idkhachhang',$id)->first();
        return view('admin.user.update',compact('user'));
    }

    public function handleUpdate(Request $request, $id){
        if($request->diachimoi)
            $diachi = $request->diachimoi;
        else $diachi = $request->diachi;
        $khachhang = khachhang::where('idkhachhang',$id)
                            ->update([
                                'tenkhachhang' => $request->tennguoidung,
                                'ngaysinh' => $request->ngaysinh,
                                'diachi' =>$diachi,
                                'gioitinh'=>$request->gioitinh,
                                'sodienthoai' => $request->sodienthoai,
                                'role' => $request->role,
                                'email' => $request->email
                            ]);
        return redirect('/users');
    }

    public function delete($id){
        $user = khachhang::where('idkhachhang',$id);
        $user->delete();
        return redirect('/users');
    }
}
