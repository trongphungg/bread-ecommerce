<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nguoidung;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $dsuser = nguoidung::paginate(5);
        return view('admin.user.index',compact('dsuser'));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function handleCreate(Request $request){
        $diachi = $request->diachi.'-'.$request->quan;
        $nguoidung = new nguoidung();
        $nguoidung->tennguoidung = $request->input('tennguoidung');
        $nguoidung->ngaysinh = $request->input('ngaysinh');
        $nguoidung->diachi = $diachi;
        $nguoidung->gioitinh = $request->input('gioitinh');
        $nguoidung->sodienthoai = $request->input('sodienthoai');
        $nguoidung->email = $request->input('email');
        $nguoidung->password = Hash::make($request->input('password'));
        $nguoidung->role = $request->input('role');
        $nguoidung->save();

        return redirect('/users');
    }

    public function update($id){
        $user = nguoidung::where('idnguoidung',$id)->first();
        return view('admin.user.update',compact('user'));
    }

    public function handleUpdate(Request $request, $id){
        $nguoidung = nguoidung::where('idnguoidung',$id)
                            ->update([
                                'tennguoidung' => $request->input('tennguoidung'),
                                'ngaysinh' => $request->input('ngaysinh'),
                                'diachi' =>$request->input('diachi'),
                                'gioitinh'=>$request->input('gioitinh'),
                                'sodienthoai' => $request->input('sodienthoai'),
                                'role' => $request->input('role'),
                                'email' => $request->input('email')
                            ]);
        return redirect('/users');
    }

    public function delete($id){
        $user = nguoidung::where('idnguoidung',$id);
        $user->delete();
        return redirect('/users');
    }
}
