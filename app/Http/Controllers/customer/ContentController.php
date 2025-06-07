<?php
namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tintuc;

class ContentController extends Controller
{
    public function index(){
        $dstt = tintuc::all();
        return view('customer.content',compact('dstt'));
    }
}
