<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tintuc;
use App\Models\loaitintuc;

class NewsController extends Controller
{
    public function index(){
        $dstt = tintuc::paginate(5);
        return view('admin.news.index',compact('dstt'));
    }

    public function create(){
        $dsltt = loaitintuc::all();
        return view('admin.news.create',compact('dsltt'));
    }

    public function handleCreate(Request $request){
        $tintuc = new tintuc();
        $tintuc->tieude = $request->tieude;
        $tintuc->ngaytao = $request->ngaytao;
        $tintuc->mota = $request->mota;
        if($request->hasFile('hinhanh')){
            $file = $request->file('hinhanh');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('customer/assets/img'),$fileName);
            $tintuc->hinhanh = $fileName;
        }
        if($request->tacgia){
            $tintuc->tacgia = $request->tacgia;
        }
        $tintuc->idloaitintuc = $request->loaitintuc;
        $tintuc->save();
        return redirect('/news');
    }

    public function update($id){
        $tintuc = tintuc::where('idtintuc',$id)->first();
        $dsltt = loaitintuc::all();
        return view('admin.news.update',compact('tintuc','dsltt'));
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
        $tintuc = tintuc::where('idtintuc',$id)
                            ->update([
                                'tieude' => $request->tieude,
                                'ngaytao' =>$request->ngaytao,
                                'mota' => $request->mota,
                                'hinhanh'=>$fileName,
                                'tacgia'=>$request->tacgia,
                                'idloaitintuc' => $request->loaitintuc
                            ]);
        return redirect('/news');
    }

    public function delete($id){
        $tintuc = tintuc::where('idtintuc',$id);
        $tintuc->delete();
        return redirect('/news');
    }
}
