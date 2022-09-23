@extends('layouts.web.main')
@section('content_banner')
    <div class="row"></div>
@endsection
@section('content')
    @if(count($detail)>0)
        <div style="max-width: 666px; margin: 31px auto">
            <form method="post" action="{{route('handle', $order->id)}}">
                @csrf
                <div style="padding: 12px">
                    <div
                        style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                        <b>ĐẶT HÀNG THÀNH CÔNG</b>
                    </div>
                    <div>
                <span>
                    Cảm ơn {{$order->user_name}} đã tin tưởng QWERTY Shop !.
                </span>
                        <hr>
                    </div>
                    <div>
                        <b>Order : #{{$order->id}}</b>
                        <span
                            style="padding-left: 100px">Receiver : {{$order->user_name}}, phone number : {{$order->phone_number}}</span><br>
                        <span>Delivered to : {{$address->address}}, {{$address->districtType}} {{$address->disName}}, {{$address->provinceType}} {{$address->provinceName}}</span><br>
                        <span>Subtotal : {{number_format($order->total_money)}} VNĐ</span><br>
                    </div>
                    <hr>
                    <div>
                        <b>Payment Method : </b><br>
                        <input disabled name="paymentMethod" type="radio">
                        Thanh toán tiền mặt khi nhận hàng<br>
                        <input disabled name="paymentMethod" type="radio">
                        Chuyển khoản ngân hàng<br>
                        <input disabled name="paymentMethod" type="radio">
                        Qua thẻ ATM (có Internet Banking)<br>
                        <input checked name="paymentMethod" type="radio">
                        Qua VNPAY ( NCB Bank )<br>
                        <input disabled name="paymentMethod" type="radio">
                        Ví MoMo<br>
                        <input disabled name="paymentMethod" type="radio">
                        Qua thẻ quốc tế Visa, Master, JCB<br>
                        <input disabled name="paymentMethod" type="radio">
                        Qua Ví điện tử Moca trên Grab<br>
                        <input disabled name="paymentMethod" type="radio">
                        Ví điện tử ShopeePay<br>
                        <input disabled name="paymentMethod" type="radio">
                        Nhân viên mang máy cà thẻ khi nhận hàng<br>
                        <br>
                        <button name="redirect" style="text-align: center" class="btn btn-primary">Thanh Toán</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endsection
