<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nguyenlieu;

class NguyenlieuController extends Controller
{
    public function index(){
        $dsnl = nguyenlieu::orderBy('soluongton','asc')
        ->paginate(5);
        return view('admin.nguyenlieu.index',compact('dsnl'));
    }

    public function create(){
        return view('admin.nguyenlieu.create');
    }

    public function handleCreate(Request $request){
        try{
            $nguyenlieu = new nguyenlieu();
        $nguyenlieu->tennguyenlieu = $request->tennguyenlieu;
        $nguyenlieu->donvitinh = $request->donvitinh;
        $nguyenlieu->save();

        session()->flash('success','Thêm nguyên liệu thành công!');
        return redirect('/ingredients');
        }catch(\Exception $e){
            session()->flash('error','Thêm nguyên liệu thất bại!');
        return redirect('/ingredients');
        }
    }

    public function update($id){
        $nguyenlieu = nguyenlieu::where('idnguyenlieu',$id)->first();
        return view('admin.nguyenlieu.update',compact('nguyenlieu'));
    }

    public function handleUpdate(Request $request,$id){
        try{
            $nguyenlieu = nguyenlieu::where('idnguyenlieu',$id)
                                    ->update([
                                        'tennguyenlieu'=>$request->tennguyenlieu,
                                        'donvitinh'=>$request->donvitinh
                                    ]);
        session()->flash('success','Chỉnh sửa nguyên liệu thành công!');
        return redirect('/ingredients');
        }catch(\Exception $e){
            session()->flash('error','Chỉnh sửa nguyên liệu thất bại!');
        return redirect('/ingredients');
        }
    }

    public function delete($id){
        try{
            $nguyenlieu = nguyenlieu::where('idnguyenlieu',$id)->first();
            $nguyenlieu->delete();
            session()->flash('success','Xoá nguyên liệu thành công!');
            return redirect('/ingredients');
        } catch (\Exception $e) {
        return redirect('/ingredients')->with('error', 'Không thể xoá nguyên liệu này.');
    }
    }
}
