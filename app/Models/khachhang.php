<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
class khachhang extends Model implements AuthenticatableContract 
{

    use Authenticatable; 
    protected $table = 'khachhang';
    public $timestamps = false;
    protected $fillable = [
        'email', 'password', 'tenkhachhang', 'role','ngaysinh','diachi','gioitinh','sodienthoai','facebook_id','google_id'
    ];
    protected $primaryKey = 'idkhachhang';        
    public $incrementing = true;                 
    protected $keyType = 'int'; 
}
