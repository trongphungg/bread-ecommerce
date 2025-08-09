<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\khachhang;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class KhachhangController extends Controller
{
    public function index(){
        $dsuser = khachhang::paginate(5);
        return view('admin.khachhang.index',compact('dsuser'));
    }

    public function create(){
        return view('admin.khachhang.create');
    }

    public function handleCreate(Request $request){
        $credentials = $request->validate([
            'email' => 'unique:khachhang,email',
            'sodienthoai' => 'unique:khachhang,sodienthoai',
            'password' => 'min:6'
        ],[
            'email.unique' => 'Bạn đã có tài khoản rồi. Hãy tiến hành đăng nhập',
            'sodienthoai.unique' => 'Số điện thoại đã được sử dụng',
            'password.min' => 'Mật khẩu phải lớn hơn 6 kí tự'
        ]);

        
        if($credentials){
            $diachi = $request->diachi;
        $khachhang = new khachhang();
        $khachhang->tenkhachhang = $request->input('tennguoidung');
        $khachhang->ngaysinh = $request->input('ngaysinh');
        $khachhang->diachi = $diachi;
        $khachhang->gioitinh = $request->input('gioitinh');
        $khachhang->sodienthoai = $request->input('sodienthoai');
        $khachhang->email = $request->input('email');
        $khachhang->password = Hash::make($request->input('password'));
        $khachhang->trangthai = 1;
        $khachhang->role = $request->input('role');
        $khachhang->save();

        session()->flash('success','Thêm khách hàng thành công!');
        return redirect('/users');
        }
        else return redirect()->back();
    }

    public function update($id){
        $user = khachhang::where('idkhachhang',$id)->first();
        return view('admin.khachhang.update',compact('user'));
    }

    public function handleUpdate(Request $request, $id){
        if($request->diachimoi)
            $diachi = $request->diachimoi;
        else $diachi = $request->diachi;
    
        if($request->filled('password')){
            $khachhang = khachhang::where('idkhachhang',$id)
            ->update([
                'password' => Hash::make($request->input('password')),
            ]);
        } 
        try{
            $khachhang = khachhang::where('idkhachhang',$id)
                            ->update([
                                'tenkhachhang' => $request->tennguoidung,
                                'ngaysinh' => $request->ngaysinh,
                                'diachi' =>$diachi,
                                'gioitinh'=>$request->gioitinh,
                                'sodienthoai' => $request->sodienthoai,
                                'trangthai' => $request->trangthai,
                                'role' => $request->role,
                                'email' => $request->email
                            ]);
        session()->flash('success','Chỉnh sửa khách hàng thành công!');
        return redirect('/users');
        }catch(\Exception $e){
            session()->flash('error', 'Trùng dữ liệu không thể cập nhật');
            return redirect('/users');
        }
    }

    public function delete($id){
        $user = khachhang::where('idkhachhang',$id)
        ->update([
            'trangthai' => 0
        ]);
        session()->flash('success','Cấm khách hàng thành công!');
        return redirect('/users');
    }


    //Nguoi dung

    public function indexUser(){
        $khachhang = khachhang::where('idkhachhang',Auth::user()->idkhachhang)->first();
        return view('customer.thongtincanhan',compact('khachhang'));
    }

    public function updateUser(){
        $user = khachhang::where('idkhachhang',Auth::user()->idkhachhang)->first();
        return view('customer.chinhsuathongtin',compact('user'));
    }

    public function handleUpdateUser(Request $request)
{
    $request->validate([
        'email' => [
        'email',
        Rule::unique('khachhang')->ignore(Auth::user()->idkhachhang, 'idkhachhang'),
    ],
        'sodienthoai' => [
        'digits_between:10,11',
        Rule::unique('khachhang')->ignore(Auth::user()->idkhachhang, 'idkhachhang'),
    ],
        'password' => 'nullable|min:6|confirmed',
    ], [
        'email' => 'Email đã tồn tại',
        'sodienthoai.unique' => 'Số điện thoại đã tồn tại',
        'sodienthoai.digits_between' => 'Số điện thoại phải thuộc từ 10-11 số',
        'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
    ]);

    $dataUpdate = [
        'tenkhachhang' => $request->tennguoidung,
        'ngaysinh' => $request->ngaysinh,
        'diachi' => $request->filled('diachimoi') ? $request->diachimoi : $request->diachi,
        'gioitinh' => $request->gioitinh,
        'sodienthoai' => $request->sodienthoai,
        'role' => $request->role,
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $dataUpdate['password'] = Hash::make($request->password);
    }

    khachhang::where('idkhachhang', Auth::user()->idkhachhang)
        ->update($dataUpdate);

    return redirect('/profile')->with('success', 'Cập nhật thông tin thành công!');
}
}
