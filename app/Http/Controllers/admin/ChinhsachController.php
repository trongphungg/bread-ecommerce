<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\chinhsach;
use App\Models\loaichinhsach;

class ChinhsachController extends Controller
{
    public function index(){
        $dscs = chinhsach::paginate(5);
        return view('admin.chinhsach.index',compact('dscs'));
    }

    public function create(){
        $dslcs = loaichinhsach::all();
        return view('admin.chinhsach.create',compact('dslcs'));
    }

    public function view(){
        $dscs = chinhsach::all();
        $dslcs = loaichinhsach::all();
        return view('customer.chinhsach',compact('dscs','dslcs'));
    }

    public function handleCreate(Request $request){
        $chinhsach = new chinhsach();
        $chinhsach->tenchinhsach = $request->tenchinhsach;
        $chinhsach->mota = $request->mota;
        $chinhsach->ngaytao = $request->ngaytao;
        $chinhsach->idloaichinhsach = $request->loaichinhsach;
        $chinhsach->save();
        session()->flash('success','Thêm chính sách thành công!');
        return redirect('/policy');
    }

    public function update($id){
        $cs = chinhsach::where('idchinhsach',$id)->first();
        $dslcs = loaichinhsach::all();
        return view('admin.chinhsach.update',compact('cs','dslcs'));
    }

    public function handleUpdate(Request $request,$id){
        $cs = chinhsach::where('idchinhsach',$id)
                        ->update([
                            'tenchinhsach'=>$request->tenchinhsach,
                            'ngaytao' =>$request->ngaytao,
                            'mota' => $request->mota,
                            'loaichinhsach' =>$request->loaichinhsach
                        ]);
        session()->flash('success','Chỉnh sửa chính sách thành công!');
        return redirect('/policy');
    }

    public function delete($id){
        $cs = chinhsach::where('idchinhsach',$id)->first();
        $cs->delete();
        session()->flash('success','Xoá chính sách thành công!');
        return redirect('/policy');
    }
}
