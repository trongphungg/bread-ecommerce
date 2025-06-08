<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ykien;


class OpinionController extends Controller
{
    public function index(){
        $dsyk = ykien::paginate(5);
        return view('admin.opinion.index',compact('dsyk'));
    }
}
