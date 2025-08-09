<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\sanpham;


class chitietdonhang extends Model
{
    protected $table = 'chitietdonhang';
    public $timestamps = false;

    public function sanpham()
    {
        return $this->belongsTo(sanpham::class, 'idsanpham', 'idsanpham');
    }
}
