@extends('layouts.web.main')
@section('content_banner')
    <div class="row"></div>
@endsection
@section('content')
    @if(count($detail)>0 && $order->status == 0)
        <div style="max-width: 666px; margin: 31px auto">
            <form method="post" action="{{route('handle', $order->id)}}">
                @csrf
                <div style="padding: 12px">
                    <div
                        style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                        <b>BẠN CÓ MỘT ĐƠN HÀNG</b>
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
                        <span id="total">Subtotal : {{number_format($order->total_money)}} VNĐ</span><br>
                        <span id="code_info" style="color: orange"></span><br>
                    </div>
                    <hr>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 31px">
                        <div>
                            <b>Payment Method : </b><br>
                            <input value="1" name="paymentMethod" type="radio">
                            Thanh toán tiền mặt khi nhận hàng<br>
                            <input value="2" name="paymentMethod" type="radio">
                            Qua thẻ ATM (có Internet Banking)<br>
                            <input value="3" checked name="paymentMethod" type="radio">
                            Qua VNPAY ( NCB Bank )<br>
                            <input value="4" name="paymentMethod" type="radio">
                            Ví MoMo<br>
                        </div>
                        <div id="banking">
                            <b>Chọn Ngân Hàng Thanh Toán</b>
                            <select  style="width: 100%; padding: 6px" name="bank_code">
                                <option value="NCB">NCB</option>s
                                <option value="BIDV">BIDV</option>
                            </select>
                        </div>
                        <div id="pay">
                            <input type="text" name="id" value="{{$order->id}}" hidden>
                            <button name="redirect" style="text-align: center" class="btn btn-primary">Thanh Toán
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @else
        <span style="text-align: center; color: red">Đơn hàng đã được xử lý thanh toán</span>
    @endif
@endsection
@section('script')
    <script>
        $(function () {
            $("input[name = 'paymentMethod']").on('click', function () {
                let value = $(this).attr('value');
                if (value == 1) {
                    let btn = `
                    <button style="text-align: center" class="btn btn-primary">Thanh Toán</button>
                    `
                    $('#pay').html(btn)
                    let banking = ``;
                    $('#banking').html(banking);
                } else if (value == 2) {
                    let btn = `
                    <button style="text-align: center" class="btn btn-primary">Thanh Toán</button>
                    `
                    $('#pay').html(btn)
                    let banking = `
<span>NGUYỄN QUANG HUY</span><br>
                            <span>99888828062002</span><br>
                            <span>Ngân Hàng MB Bank</span><br>
                            <span>Thông Tin Giao Dịch : <b>QWERTY#{{$order->id}}</b></span>
                    `
                    $('#banking').html(banking);
                } else if(value == 3) {
                    let btn = `
                    <button name="redirect" style="text-align: center" class="btn btn-primary">Thanh Toán</button>
                    `
                    $('#pay').html(btn)

                    let banking = `
<b>Chọn Ngân Hàng Thanh Toán</b>
                    <select  style="width: 100%; padding: 6px" name="bank_code">
                        <option value="NCB">NCB</option>
                        <option value="BIDV">BIDV</option>
                    </select>
                    `
                    $('#banking').html(banking);

                }else{

                }
            })
        })
    </script>

@endsection
