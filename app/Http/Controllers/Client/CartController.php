<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\checkOutRequest;
use App\Mail\MailNotify;
use App\Models\Address;
use App\Models\Cart;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

// use Session;

class CartController extends Controller
{
    //
    public function addToCart(Product $product, Request $request)
    {
        if ($request->quantity) {
            $quantity = $request->quantity;
        } else {
            $quantity = 1;
        }
        $new_cart = new Cart();
        $new_cart->addCart($product, $quantity);

        return redirect()->route('showCart');
    }

    public function showCart()
    {
        $new_cart = new Cart();

        $total = $new_cart->get_total(session()->get('cart'));
        return view('client.cart.show', [
            'total' => $total,

        ]);
    }

    public function delCart($id)
    {
        $oldCart = session()->get('cart') ? session()->get('cart') : null;
        $new_cart = [];
        if (!session()->get('cart')) {
            return redirect()->route('home');
        }
        foreach (session()->get('cart') as $item) {
            if ($item['id'] != $id) {
                $cart = $item;
                $new_cart[$item['id']] = $cart;
            }
            session()->forget('cart');
        }
        session()->put('cart', $new_cart);
        return redirect()->back();
    }

    public function checkOut()
    {
        $new_cart = new Cart();
        $new_address = new Address();
        $new_ship = new Ship();

        if (Auth::check()) {
            $address = $new_address->get_address(Auth::user()->id);
        } else {
            $address = [];
        }
        $provinces = $new_address->get_province();
        $districts = $new_address->get_district();

        $shipFee = $new_ship->ship_list()->first()->weight * 10000;
        $total = $new_cart->get_total(session()->get('cart'));
        return view('client.cart.checkOut', [
            'total' => $total,
            'address' => $address,
            'provinces' => $provinces,
            'districts' => $districts,
            'ship' => $shipFee
        ]);
    }

    public function payment(checkOutRequest $request)
    {
        $new_order = new Order();
        $new_detail = new OrderDetail();
        $new_cart = new Cart();
        $new_ship = new Ship();
        if ($request->optradio == 2) {
            $ship = $new_ship->ship_fee($request->district_id)->weight * 10000;
            $money = $new_cart->get_total(session()->get('cart'));
            $total = $ship + $money;
            $id = $new_order->add_new($request->user_name, $request->phone_number, $request->email, $request->region_id, $request->province_id, $request->district_id, $request->address, $total);
            foreach (session()->get('cart') as $item) {
                $new_detail->add_new($id, $item['id'], $item['quantity']);
                $new_cart->save_order($item['avatar'], $item['name'], $item['price'], $item['quantity'], $item['id']);
            }
            session()->put('total', $total);
            if (Auth::check()) {
                $new_address = new Address();
                $address = $new_address->get_address(Auth::user()->id);
                if ($address == null) {
                    $new_address->user_id = Auth::user()->id;
                    $new_address->region_id = $request->region_id;
                    $new_address->province_id = $request->province_id;
                    $new_address->district_id = $request->district_id;
                    $new_address->address = $request->address;
                    $new_address->ngayTao = strtotime(date('Y-m-d H:i:s'));
                    $new_address->ngayCapNhat = strtotime(date('Y-m-d H:i:s'));
                    $new_address->save();
                } else {
                    $address->region_id = $request->region_id;
                    $address->province_id = $request->province_id;
                    $address->district_id = $request->district_id;
                    $address->address = $request->address;
                    $address->save();
                }
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('success');
            $vnp_TmnCode = "39IE9XM1"; //Mã website tại VNPAY 
            $vnp_HashSecret = "SNCTAOSZZEBRPFURIPQPUPVBAIGLVJUY"; //Chuỗi bí mật

            $vnp_TxnRef = $id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'VN PAY - NGÂN HÀNG ' . $request->bank;
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $total * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = $request->bank;
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $fullName = trim($request->user_name);
            if (isset($fullName) && trim($fullName) != '') {
                $name = explode(' ', $fullName);
                $vnp_Bill_FirstName = array_shift($name);
                $vnp_Bill_LastName = array_pop($name);
            }
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
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                $new_order->success_payment($id);
                if (Auth::check() == false) {
                    $data = session()->get('order');
                    $new_email = new MailNotify($request->user_name, $request->phone_number, $data, $total);
                    $email = $request->email;
                    Mail::to($email)->send($new_email);
                }
                die();
            } else {
                echo json_encode($returnData);
            }
        }
    }

    public function order()
    {
        if (Auth::check()) {
            $gmail = Auth::user()->email;
        } else {
            $gmail = '';
        }
        $new_order = new Order();
        $orders = $new_order->get_order_by_gmail($gmail);
        $detail_orders = $new_order->get_detail_by_gmail($gmail);
        return view('client.order.list', [
            'orders' => $orders,
            'detail_orders' => $detail_orders
        ]);
    }

    public function success()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        return view('client.cart.paymentSuccess', [
            'data' => $inputData
        ]);
    }
}
