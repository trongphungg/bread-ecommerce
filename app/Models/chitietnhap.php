<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chitietnhap extends Model
{
    protected $table = 'chitietnhap';
    protected $primaryKey = 'idchitietnhap';        
    public $incrementing = true;                 
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = ['idnguyenlieu','idkho','soluong','giatien'];


    public function nguyenlieu()
    {
        return $this->belongsTo(nguyenlieu::class, 'idnguyenlieu', 'idnguyenlieu');
    }
}
