<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\nguyenlieu;

class kho extends Model
{
    protected $table = 'kho';
    public $timestamps = false;
    protected $primaryKey = 'idkho';        
    public $incrementing = true;                 
    protected $keyType = 'int';
    protected $fillable = [
        'idnguyenlieu', 'soluong', 'donvitinh', 'tongtien','ngaynhap','ghichu' 
    ];
    public function nguyenlieu(){
        return $this->belongsTo(nguyenlieu::class, 'idnguyenlieu', 'idnguyenlieu');
    }
}
