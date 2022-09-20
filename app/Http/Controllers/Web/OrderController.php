<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function detail(Order $order)
    {
        $new_detail = new OrderDetail();
        $order_detail = $new_detail->order_detail($order->id);
        return view('client.order.detail', [
            'order_detail' => $order_detail,
            'order' => $order
        ]);
    }

    public function cancelOrder(Order $order)
    {
        $order->status = 4;
        $order->save();
        return redirect()->back();
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function handle($id, Request $request)
    {
        $new_order = new Order();
        $order = Order::find($id);
        $discount = 0;
        if ($request->code) {
            $discount_ex = $new_order->discount_code($request->code);
            if($discount_ex){
                $discount = $discount_ex->discount;
                $discount_ex->quantity --;
                $discount_ex->save();
            }
        }
        $order->discount = $discount;
        $order->save();
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('success');
        $vnp_TmnCode = "39IE9XM1";//Mã website tại VNPAY
        $vnp_HashSecret = "SNCTAOSZZEBRPFURIPQPUPVBAIGLVJUY"; //Chuỗi bí mật
        $vnp_TxnRef = $id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $order->user_name . 'Thanh Toán Qua VN Pay';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = ($order->total_money - $order->total_money  * $discount / 100 )* 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
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
        $vnp_Url = $vnp_Url . "?" . $query;
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

    public function success()
    {
        $id = $_GET['vnp_TxnRef'];
        $order = Order::find($id);
        if ($_GET['vnp_ResponseCode'] == '00') {
            $order->status = 1;
            $order->updated_at = strtotime(date('Y-m-d H:i:s'));
            $order->save();
        }
        return view('client.order.resultPayment');
    }
}
