<?php
namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tintuc;

class ContentController extends Controller
{
    public function index(){
        $dstt = tintuc::where('idloaitintuc',1)->get();
        return view('customer.content',compact('dstt'));
    }
    
}
