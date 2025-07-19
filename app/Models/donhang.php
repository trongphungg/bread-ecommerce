<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\khachhang;

class donhang extends Model
{
    protected $table = 'donhang';
    public $timestamps = false;
    protected $primaryKey = 'iddonhang';        
    public $incrementing = true;                 
    protected $keyType = 'int';

    public function khachhang()
    {
        return $this->belongsTo(khachhang::class, 'idkhachhang', 'idkhachhang');
    }
}
