<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nguyenlieu;

class IngredientController extends Controller
{
    public function index(){
        $dsnl = nguyenlieu::paginate(5);
        return view('admin.ingredient.index',compact('dsnl'));
    }

    public function create(){
        return view('admin.ingredient.create');
    }

    public function handleCreate(Request $request){
        $nguyenlieu = new nguyenlieu();
        $nguyenlieu->tennguyenlieu = $request->tennguyenlieu;
        $nguyenlieu->donvitinh = $request->donvitinh;
        $nguyenlieu->save();
        return redirect('/ingredients');
    }

    public function update($id){
        $nguyenlieu = nguyenlieu::where('idnguyenlieu',$id)->first();
        return view('admin.ingredient.update',compact('nguyenlieu'));
    }

    public function handleUpdate(Request $request,$id){
        $nguyenlieu = nguyenlieu::where('idnguyenlieu',$id)
                                    ->update([
                                        'tennguyenlieu'=>$request->tennguyenlieu,
                                        'donvitinh'=>$request->donvitinh
                                    ]);
        return redirect('/ingredients');
    }

    public function delete($id){
        $nguyenlieu = nguyenlieu::where('idnguyenlieu',$id)->first();
        $nguyenlieu->delete();
        return redirect('/ingredients');
    }
}
