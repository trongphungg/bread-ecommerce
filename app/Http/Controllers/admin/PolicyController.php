<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\chinhsach;

class PolicyController extends Controller
{
    public function index(){
        $dscs = chinhsach::paginate(5);
        return view('admin.policy.index',compact('dscs'));
    }

    public function create(){
        return view('admin.policy.create');
    }

    public function view(){
        $dscs = chinhsach::all();
        return view('customer.policy',compact('dscs'));
    }

    public function handleCreate(Request $request){
        $chinhsach = new chinhsach();
        $chinhsach->tenchinhsach = $request->tenchinhsach;
        $chinhsach->mota = $request->mota;
        $chinhsach->ngaytao = $request->ngaytao;
        $chinhsach->loaichinhsach = $request->loaichinhsach;
        $chinhsach->save();
        return redirect('/policy');
    }

    public function update($id){
        $cs = chinhsach::where('idchinhsach',$id)->first();
        return view('admin.policy.update',compact('cs'));
    }

    public function handleUpdate(Request $request,$id){
        $cs = chinhsach::where('idchinhsach',$id)
                        ->update([
                            'tenchinhsach'=>$request->tenchinhsach,
                            'ngaytao' =>$request->ngaytao,
                            'mota' => $request->mota,
                            'loaichinhsach' =>$request->loaichinhsach
                        ]);
        return redirect('/policy');
    }

    public function delete($id){
        $cs = chinhsach::where('idchinhsach',$id)->first();
        $cs->delete();
        return redirect('/policy');
    }
}
