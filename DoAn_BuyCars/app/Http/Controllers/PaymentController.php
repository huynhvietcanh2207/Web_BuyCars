<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function index()
    // {
    //     // Xử lý logic thanh toán tại đây
    //     return view('payment');
    // }
    public function vnpay_return(Request $request)
{
    $vnp_SecureHash = $request->vnp_SecureHash;
    $inputData = $request->except(['vnp_SecureHashType', 'vnp_SecureHash']);

    ksort($inputData);
    $hashdata = urldecode(http_build_query($inputData));
    $secureHash = hash_hmac('sha512', $hashdata, "UTFZMU0T1KQVLG5WFAIRN1G09RAG8MQH"); // Secret Key

    if ($vnp_SecureHash === $secureHash) {
        if ($request->vnp_ResponseCode == '00') {
            // Lưu thông tin đơn hàng
            $order = Order::create([
                'order_code' => $request->vnp_TxnRef,
                'total' => $request->vnp_Amount / 100,
                'status' => 'Đã thanh toán',
                'payment_date' => now(),
            ]);

            foreach (session('cart.items', []) as $item) {
                $order->items()->create([
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('cart.index'); // Xóa giỏ hàng sau khi thanh toán

            return redirect()->route('order.info', ['id' => $order->id])
                ->with('success', 'Thanh toán thành công!');
        } else {
            return redirect()->route('cart.index')
                ->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
        }
    } else {
        return redirect()->route('index')
            ->with('error', 'Vui lòng thử lại!');
    }
}

    public function vnpay_payment(Request $request)
    {
        // Retrieve product names and quantities from the cart items in session
        $cartItems = session()->get('cart.items', []);
        $productDetails = implode(", ", array_map(fn($item) => $item['name'] . "\t" . " số lượng: " . $item['quantity'], $cartItems));
 
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return'); // URL callback sau khi thanh toán
        $vnp_TmnCode = "DH781HO6"; // VNPAY Website Code
        $vnp_HashSecret = "UTFZMU0T1KQVLG5WFAIRN1G09RAG8MQH"; // Secret Key

        $vnp_TxnRef =  "\n" . $productDetails; // Unique Order reference code
        $vnp_OrderInfo = "Thanh toán đơn hàng: " . uniqid(); // Include product details here
        $vnp_OrderType = "BuyCars";
        $vnp_Amount = $request->input('total') * 100; // Convert to VND
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        // Prepare the input data
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        // Optional BankCode
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Generate the VNPAY URL with hash
        ksort($inputData);
        $query = "";
        $hashdata = "";
        $i = 0;
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

        $returnData = [
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        ];

        // Redirect to VNPAY
        if (isset($_POST['redirect'])) {
            return redirect()->away($vnp_Url);
        } else {
            return response()->json($returnData);
        }
    }
 
}

// Thông tin cấu hình:
// Terminal ID / Mã Website (vnp_TmnCode): DH781HO6  
// Secret Key / Chuỗi bí mật tạo checksum (vnp_HashSecret): UTFZMU0T1KQVLG5WFAIRN1G09RAG8MQH
//B7K0VU6S
//ULBJKVTTACUUCOQAW111Y2IWGRF3NWAC
// Url thanh toán môi trường TEST (vnp_Url): https://sandbox.vnpayment.vn/paymentv2/vpcpay.html

// Thẻ test 
// Ngân hàngNC	B
// Số thẻ	    9704198526191432198
// Tên chủ thẻ	NGUYEN VAN A
// Ngày phát hành	07/15
// Mật khẩu OTP	123456


//moi truong test
//https://sandbox.vnpayment.vn/apis/vnpay-demo/

// Kiểm tra (test case) – IPN URL: Dùng để tra cứu giao dịch
//     Kịch bản test (SIT): https://sandbox.vnpayment.vn/vnpaygw-sit-testing/user/login
    
//     Tên đăng nhập: quynguoisieunhien2811@gmail.com
//     Mật khẩu: Laiphuquy06120@