<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Services\PublicService;
use App\Models\khachhang;
use App\Models\donhang;
use App\Models\chitietdonhang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\CheckoutSuccess;



class CheckoutController extends Controller
{
    public function index(){
        $cart = session()->get('cart', new \stdClass());
        $dsct = $cart;
        $iddonhang='';
        if(Auth::user()){
 $donhang = donhang::where('trangthaidh','=','')
                                ->where('idkhachhang',Auth::user()->idkhachhang)
        ->first();
        $iddonhang = $donhang->iddonhang;
        }
        return view('customer.dathang',compact('dsct','iddonhang'));
    }

    public function finish(Request $request,PublicService $pub){
        $cart = session()->get('cart', new \stdClass());
        if (empty((array) $cart)) {
        return redirect()->back()->with('error', 'Giỏ hàng đang trống. Vui lòng chọn sản phẩm trước khi đặt.');
    }

    DB::beginTransaction();
    try{
        foreach ($cart as $item) {
        $sanpham = sanpham::find($item->idsanpham);
        if (!$sanpham) {
             return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }
        if ($sanpham->soluong < $item->soluongsp) {
        return redirect()->back()->with('error', 'Sản phẩm ' . $sanpham->tensanpham . ' hiện tại đã hết. Mời bạn thay đổi sản phẩm. Chúng tôi xin lỗi vì sự bất tiện này');
        }
    }
        if($request->diachigiao) 
            $diachi = $request->diachigiao;
        else 
            $diachi = $request->diachi;
        if(Auth::user()){
            $id=Auth::user()->idkhachhang;
            $id_dh = donhang::where('idkhachhang',$id)
                            ->where('trangthaidh','')
                            ->first();
            $ctdh = chitietdonhang::where('iddonhang',$id_dh->iddonhang)->get();
            $dh = donhang::where('idkhachhang',$id)
                            ->where('trangthaidh','')
                            ->update([
                                'ngaylapdh' => now(),
                                'trangthaidh' => "CXN",
                                'tongtien' => $request->input('Tongtien'),
                                'diachi' => $diachi,
                                'tenkhachhang'=> $request->tennguoidung,
                                'sodienthoai'=> $request->sodienthoai
                            ]);
        }
        else{
                $dh = new donhang();
                $dh->ngaylapdh= now();
                $dh->trangthaidh = 'CXN';
                $dh->tongtien = $request->input('Tongtien');
                $dh->diachi = $diachi;
                $dh->tenkhachhang = $request->tennguoidung;
                $dh->sodienthoai = $request->sodienthoai;
                $dh->save();
                foreach ($cart as $item) {
                    DB::table('chitietdonhang')->updateOrInsert(
                                   ['idsanpham' => $item->idsanpham, 'iddonhang' => $dh->iddonhang], 
                                   [
                                       'soluongsp' => $item->soluongsp,
                                       'ghichu'=>$item->ghichu
                                   ]
                               );
               }
               $ctdh = chitietdonhang::where('iddonhang',$dh->iddonhang)->get();
        }
        foreach($cart as $item){
            $pub->xoaNguyenlieu($item);
        }
        $ten = $request->tennguoidung;
        Mail::to($request->email)->send(new CheckoutSuccess($ten,$ctdh,$diachi));

        session()->put('cart', new \stdClass()); 

        DB::commit();
        
        return redirect('/');
    }
    catch(\Exception $e){
         DB::rollBack();
        return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
    }
    
    }

    public function vnpay_payment(Request $request){
     $cart = session()->get('cart', new \stdClass());
        if (empty((array) $cart)) {
        return redirect()->back()->with('error', 'Giỏ hàng đang trống. Vui lòng chọn sản phẩm trước khi đặt.');
    }

     foreach ($cart as $item) {
        $sanpham = sanpham::find($item->idsanpham);
        if (!$sanpham) {
             return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }
        if ($sanpham->soluong < $item->soluongsp) {
        return redirect()->back()->with('error', 'Sản phẩm ' . $sanpham->tensanpham . ' hiện tại đã hết. Mời bạn thay đổi sản phẩm. Chúng tôi xin lỗi vì sự bất tiện này');
        }
    }

    $tongtien = $request->input('Tongtien');
    $tennguoidung = $request->input('tennguoidung');
    $diachi = $request->input('diachigiao') ?: $request->input('diachi');
    $email = $request->input('email');
    $sdt = $request->input('sodienthoai');
    if(!Auth::user()){
        $donhang = new Donhang();
    $donhang->ngaylapdh = now();
    $donhang->trangthaidh = 'DA_HUY';
    $donhang->tongtien = $tongtien;
    $donhang->diachi = $diachi;
    $donhang->tenkhachhang = $tennguoidung;
    $donhang->sodienthoai = $sdt;
    $donhang->save();

    $id_dh = $donhang->iddonhang;
    }
    else {
        $id_dh = $request->iddonhang;
        $dh = donhang::where(
            'iddonhang',$id_dh
        )->update([
            'tenkhachhang' => $tennguoidung,
            'tongtien' => $tongtien,
            'diachi' => $diachi,
            'sodienthoai' => $sdt
        ]);
    }

    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = route('vnpay.return');
    $vnp_TmnCode = "39Q5WUEP";
    $vnp_HashSecret = "4OYHJRSPWAWH8VQFN9QOT248ELUAC8V0";

    $vnp_TxnRef = $id_dh; 
    $vnp_OrderInfo = "Đơn hàng của $tennguoidung-".$email;
    $vnp_Amount = $tongtien * 100;
    $vnp_Locale = "vn";
    $vnp_BankCode = "NCB";
    $vnp_IpAddr = $request->ip();

    $inputData = [
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => now()->format('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => "other",
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_BankCode" => $vnp_BankCode,
        "vnp_Inv_Customer"=>$tennguoidung,
        "vnp_Inv_Address"=>$diachi,
        "vnp_Inv_Phone" => $sdt,
    ];

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    return redirect($vnp_Url);
}



    public function vnpayReturn(Request $request, PublicService $pub){
    $cart = session()->get('cart', new \stdClass());
   $vnp_HashSecret = "4OYHJRSPWAWH8VQFN9QOT248ELUAC8V0";
    $inputData = [];

    foreach ($request->all() as $key => $value) {
        if ($key != "vnp_SecureHash" && $key != "vnp_SecureHashType") {
            $inputData[$key] = $value;
        }
    }

    ksort($inputData);
 $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    if (isset($vnp_HashSecret))
        $secureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);

    if ($secureHash === $request->input('vnp_SecureHash')) {
        if ($request->input('vnp_ResponseCode') === '00') {
            $maDonHang = $request->input('vnp_TxnRef');
            $soTien = $request->input('vnp_Amount') / 100;
            $dh = donhang::where('iddonhang',$maDonHang)->first();
            $diachi = $dh->diachi;
            $ten = $dh->tenkhachhang;
            $orderInfo = $request->input('vnp_OrderInfo'); 
            $parts = explode('-', $orderInfo);
            $email = isset($parts[1]) ? $parts[1] : null;
            Donhang::where('iddonhang', $maDonHang)->update(
                ['trangthaidh' => 'DTT'],
                ['tongtien' => $soTien],
            );
             foreach ($cart as $item) {
                    DB::table('chitietdonhang')->updateOrInsert(
                                   ['idsanpham' => $item->idsanpham, 'iddonhang' => $maDonHang], 
                                   [
                                       'soluongsp' => $item->soluongsp,
                                       'ghichu'=>$item->ghichu
                                   ]
                               );
               }
               $ctdh = chitietdonhang::where('iddonhang',$dh->iddonhang)->get();
        foreach($cart as $item){
            $pub->xoaNguyenlieu($item);
        }
        $ten = $request->tennguoidung;
        Mail::to($request->email)->send(new CheckoutSuccess($ten,$ctdh,$diachi));

        session()->put('cart', new \stdClass()); 
            return view('customer.thanhtoan', compact('maDonHang', 'soTien'));
        } else {
            return redirect()->route('checkout')->with('error', 'Thanh toán thất bại.');
        }
    }
    return redirect()->route('checkout')->with('error', 'Xác thực không hợp lệ.');
    }
}
