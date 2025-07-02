<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\danhgia;

class ReviewController extends Controller
{
    public function index(){
        $dsdg = danhgia::paginate(5);
        return view('admin.review.index',compact('dsdg'));
    }

    public function handleUpdate($id){
        $danhgia = danhgia::where('iddanhgia',$id)->first();
        if ($danhgia) {
            $danhgia->update([
                'trangthaidg' => $danhgia->trangthaidg == 0 ? 1 : 0,
            ]);
        }
        
        return redirect()->route('reviewIndex');
    }
}
