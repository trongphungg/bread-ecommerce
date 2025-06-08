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
        $nguoidung = new nguoidung();
        $nguoidung->tennguoidung = $request->input('tennguoidung');
        $nguoidung->ngaysinh = $request->input('ngaysinh');
        $nguoidung->diachi = $request->input('diachi');
        $nguoidung->gioitinh = $request->input('gioitinh');
        $nguoidung->sodienthoai = $request->input('sodienthoai');
        $nguoidung->email = $request->input('email');
        $nguoidung->matkhau = Hash::make($request->input('matkhau'));
        $nguoidung->role = $request->input('role');
        $nguoidung->save();

        return redirect('/users');
    }

    public function update($id){

    }

    public function handleUpdate(Request $request, $id){

    }

    public function delete($id){

    }
}
