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
use Illuminate\Support\Facades\Http;
use Mail;
use App\Mail\CheckoutSuccess;



class DathangController extends Controller
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
                                'tongtien' => $request->input('tongcong'),
                                'diachi' => $diachi,
                                'tenkhachhang'=> $request->tennguoidung,
                                'sodienthoai'=> $request->sodienthoai
                            ]);
        }
        else{
                $dh = new donhang();
                $dh->ngaylapdh= now();
                $dh->trangthaidh = 'CXN';
                $dh->tongtien = $request->input('tongcong');
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
        $tongtien = $request->tongcong;
        Mail::to($request->email)->send(new CheckoutSuccess($ten,$ctdh,$diachi,$tongtien));

        session()->put('cart', new \stdClass()); 

        DB::commit();
        session()->flash('success', 'Đơn hàng của bạn đã được đặt thành công!');
        return redirect('/');
    }
    catch(\Exception $e){
         DB::rollBack();
        return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
    }
    
    }

public function vnpay_payment(Request $request)
{
    $cart = session()->get('cart', new \stdClass());
    if (empty((array) $cart)) {
        session()->flash('error','Giỏ hàng đang trống. Vui lòng chọn sản phẩm trước khi đặt.');
        return redirect()->back();
    }

    foreach ($cart as $item) {
        $sanpham = sanpham::find($item->idsanpham);
        if (!$sanpham) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }
    }

    // Lấy các tham số từ form thanh toán
    $tongtien = $request->input('tongcong');
    $tennguoidung = $request->input('tennguoidung');
    $diachi = $request->input('diachigiao') ?: $request->input('diachi');
    $email = $request->input('email');
    $sdt = $request->input('sodienthoai');

    // Kiểm tra người dùng đã đăng nhập hay chưa
    if (!Auth::user()) {
        $donhang = new Donhang();
        $donhang->ngaylapdh = now();
        $donhang->trangthaidh = 'HD';
        $donhang->tongtien = $tongtien;
        $donhang->diachi = $diachi;
        $donhang->tenkhachhang = $tennguoidung;
        $donhang->sodienthoai = $sdt;
        $donhang->save();

        $id_dh = $donhang->iddonhang;
    } else {
        $id_dh = $request->iddonhang;
        $dh = donhang::where('iddonhang', $id_dh)->update([
            'tenkhachhang' => $tennguoidung,
            'tongtien' => $tongtien,
            'diachi' => $diachi,
            'sodienthoai' => $sdt,
            'ngaylapdh' => now()
        ]);
    }

    // URL thanh toán của VNPAY
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = route('vnpay.return');  // Đường dẫn trả về sau khi thanh toán thành công
    $vnp_TmnCode = "39Q5WUEP";
    $vnp_HashSecret = "4OYHJRSPWAWH8VQFN9QOT248ELUAC8V0";

    $vnp_TxnRef = $id_dh;
    $vnp_OrderInfo = "Đơn hàng của $tennguoidung - $email";
    $vnp_Amount = $tongtien * 100;  // Số tiền phải thanh toán (VND)
    $vnp_Locale = "vn";
    $vnp_IpAddr = $request->ip();

    // Lấy mã ngân hàng (nếu có)
    $vnp_BankCode = $request->input('vnp_BankCode');  // Người dùng chọn ngân hàng (nếu có)

    // Tạo tham số cho request
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
    ];

    // Nếu người dùng chọn ngân hàng, thêm mã ngân hàng vào inputData
    if ($vnp_BankCode) {
        $inputData["vnp_BankCode"] = $vnp_BankCode;
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

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    // Redirect người dùng đến VNPAY để chọn ngân hàng và thực hiện thanh toán
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
            $maDonHang = $request->input('vnp_TxnRef');
        if ($request->input('vnp_ResponseCode') === '00') {
            $soTien = $request->input('vnp_Amount') / 100;
            $dh = donhang::where('iddonhang',$maDonHang)->first();
            $diachi = $dh->diachi;
            $ten = $dh->tenkhachhang;
            $orderInfo = $request->input('vnp_OrderInfo'); 
            $parts = explode('-', $orderInfo);
            $email = isset($parts[1]) ? $parts[1] : null;
            Donhang::where('iddonhang', $maDonHang)->update(
                ['trangthaidh' => 'DTT'],
                ['tongtien' => $soTien]
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
               $ctdh = chitietdonhang::where('iddonhang',$maDonHang)->get();
        foreach($cart as $item){
            $pub->xoaNguyenlieu($item);
        }
        $tongtien = $soTien;
        Mail::to($email)->send(new CheckoutSuccess($ten,$ctdh,$diachi,$tongtien));

        session()->put('cart', new \stdClass()); 
        session()->flash('success', 'Đơn hàng của bạn đã được đặt thành công!');
        return redirect('/');
        } else {
            foreach ($cart as $item) {
                    DB::table('chitietdonhang')->updateOrInsert(
                                   ['idsanpham' => $item->idsanpham, 'iddonhang' => $maDonHang], 
                                   [
                                       'soluongsp' => $item->soluongsp,
                                       'ghichu'=>$item->ghichu
                                   ]
                               );
               }
            session()->flash('error','Thanh toán thất bại !');
            return redirect()->route('checkout');
        }
    }
    session()->flash('error','Xác thực không hợp lệ !');
    return redirect()->route('checkout');
    }



    public function calculateShippingCost(Request $request)
    {
        $kg = $request->soluongsp * 500;
    $data = [
        'pick_province' => 'TP. Hồ Chí Minh',
        'pick_district' => 'Quận 8',
        'province' => 'TP. Hồ Chí Minh',
        'district' => $request->district,
        'weight' => $request->soluongsp * 300,
        'transport' => 'road',  
        'deliver_option'=>$request->deliver_option
    ];
    $token = '2HP3OPZj2OsW9ikqGCHNmgDcoluZQEEmba653K6'; 

    $response = Http::withHeaders([
    'Token' => $token
])->withOptions([
    'verify' => false
])->get('https://services.giaohangtietkiem.vn/services/shipment/fee', $data);
    if ($response->successful()) {
        $result = $response->json();

        if (isset($result['fee']['fee'])) {
            $shippingCost = $result['fee']['fee'];
        }
        return response()->json([
            'fee' => $shippingCost
        ]);
    }
    return response()->json([
    'error' => true,
    'message' => 'Không thể kết nối đến GHTK hoặc API trả về lỗi.',
    'status_code' => $response->status(),
    'body' => $response->body()
], 500);
}




public function test(Request $request)
    {
    $data = [
        'pick_province' => 'TP. Hồ Chí Minh',
        'pick_district' => 'Quận 8',
        'province' => 'TP. Hồ Chí Minh',
        'district' => 'Quận 3',
        'weight' => 500,
        'transport' => 'road',  
        'deliver_option'=>'none'
    ];

    $token = '2HP3OPZj2OsW9ikqGCHNmgDcoluZQEEmba653K6'; 

    $response = Http::withHeaders([
    'Token' => $token
])->withOptions([
    'verify' => false
])->get('https://services.giaohangtietkiem.vn/services/shipment/fee', $data);
    if ($response->successful()) {
        $result = $response->json();

        if (isset($result['fee']['fee'])) {
            $shippingCost = $result['fee']['fee'];
        }

        return response()->json([
            'fee' => $shippingCost
        ]);
    }
    return response()->json([
    'error' => true,
    'message' => 'Không thể kết nối đến GHTK hoặc API trả về lỗi.',
    'status_code' => $response->status(),
    'body' => $response->body()
], 500);
}
}
