<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\nguoidung;
use App\Models\sanpham;

class danhgia extends Model
{
    protected $table = 'danhgia';
    public $timestamps = false;
    protected $primaryKey = 'iddanhgia';        
    public $incrementing = true;                 
    protected $keyType = 'int';
    protected $fillable = ['trangthaidg'];

    public function nguoidung()
    {
        return $this->belongsTo(nguoidung::class, 'idnguoidung', 'idnguoidung');
    }

    public function sanpham()
    {
        return $this->belongsTo(sanpham::class, 'idsanpham', 'idsanpham');
    }
}
