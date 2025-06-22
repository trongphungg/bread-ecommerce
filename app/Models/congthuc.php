<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class congthuc extends Model
{
    protected $table = 'congthuc';
    public $timestamps = false;
    protected $primaryKey = 'idcongthuc';        
    public $incrementing = true;                 
    protected $keyType = 'int';
    protected $fillable = ['idsanpham'];
    public function sanpham(){
        return $this->belongsTo(sanpham::class, 'idsanpham', 'idsanpham');
    }

    public function nguyenlieu(){
        return $this->belongsTo(nguyenlieu::class, 'idnguyenlieu', 'idnguyenlieu');
    }
}
