<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VnpayController extends Controller
{
    public function cancelOrder(Order $order)
    {
        $order->status = 4;
        $order->save();
    }

    public function handle(Order $order, Request $request)
    {
        if ($request->paymentMethod == 1 || $request->paymentMethod == 2) {
            return redirect()->route('order');
        } elseif ($request->paymentMethod == 3) {
            $bankCode = $request->bank_code;
        } else {
            return redirect()->route('order');
        }
        $order_id = $order->id;
        $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh Toán Qua VN Pay';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $order->total_money * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $bankCode;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => config('VnPay.'.'vnp_TmnCode'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => config('VnPay.'.'vnp_ReturnUrl'),
            "vnp_TxnRef" => $vnp_TxnRef
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
//var_dump($inputData);
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
        $vnp_HashSecret = config('VnPay.'.'vnp_HashSecret');
        $vnp_Url = config('VnPay.'.'vnp_Url') . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {

            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function IPN(Request $request)
    {
        $new_order = new Order();
        $vnp_HashSecret = config('VnPay.'.'vnp_HashSecret');
        $inputData = array();
        $returnData = array();
        $orderId = $request->vnp_TxnRef;
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo
        // URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];
        try {
            //Check Orderid
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);
                $order = [];
                $order= Order::find($orderId);
                if ($order != NULL) {
                    if ($order->total_money == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền
                        //kiểm tra là đúng. //$order["Amount"] == $vnp_Amount
                    {
                        if ($order->status == 0) {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $Status = 1; // Trạng thái thanh toán thành công
                                $new_order->success_payment($orderId);
                            } else {
                                $Status = 2; // Trạng thái thanh toán thất bại / lỗi
                            }
                            //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB

                            //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                            return view('client.order.resultPayment');
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
    }
}
