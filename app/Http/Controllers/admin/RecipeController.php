<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\congthuc;
use App\Models\sanpham;
use App\Services\PublicService;

class RecipeController extends Controller
{
    public function index(){
        $dssp = sanpham::paginate(5);
        return view('admin.recipe.index',compact('dssp'));
    }


    public function create($id){
        $sanpham = sanpham::where('idsanpham',$id)->first();
        return view('admin.recipe.create',compact('sanpham'));
    }

    public function handleCreate(Request $request,PublicService $pub,$id){
        $validated = $request->validate([
            'idnguyenlieu' => 'required|array',  // Mảng các id nguyên liệu
            'soluong' => 'required|array',  // Mảng số lượng
            'soluong.*' => 'required|numeric|min:1',  // Kiểm tra số lượng hợp lệ
        ]);

        foreach ($validated['idnguyenlieu'] as $index => $idnguyenlieu) {
            $existingRecord = congthuc::where('idsanpham', $id)
                          ->where('idnguyenlieu', $idnguyenlieu)
                          ->first(); 
            if(!$existingRecord){
                $congthuc = new congthuc();
                $congthuc->idsanpham = $id;
                $congthuc->idnguyenlieu = $idnguyenlieu;
                $congthuc->soluong = $validated['soluong'][$index];
                $congthuc->save();
            } else {
            // Nếu đã tồn tại, cộng dồn số lượng nguyên liệu
            $existingRecord->soluong += $validated['soluong'][$index];
            $existingRecord->save();
        }
        }

        $pub->tinhSoLuongBanhMi();
        return redirect()->route('recipeDetail',$id);
    }

    public function detail($id){
        $dsct = congthuc::where('idsanpham',$id)->get();
        $sanpham = sanpham::where('idsanpham',$id)->first();
        return view('admin.recipe.detail',compact('dsct','sanpham'));
    }

    public function update($id){
        $congthuc = congthuc::where('idcongthuc',$id)->first();
        return view('admin.recipe.update',compact('congthuc'));
    }

    public function handleUpdate(Request $request,$id,PublicService $pub){
        $congthuc = congthuc::where('idcongthuc',$id)
                                ->update([
                                    'soluong' => $request->soluong,
                                ]);
        $sanpham = congthuc::find($id);

        $pub->tinhSoLuongBanhMi();
        return redirect()->route('recipeDetail',$sanpham->idsanpham);
    }


    public function delete($id,PublicService $pub){
        $congthuc = congthuc::where('idcongthuc',$id)->first();
        $congthuc->delete();

        $pub->tinhSoLuongBanhMi();
        return redirect()->back();
    }
}
