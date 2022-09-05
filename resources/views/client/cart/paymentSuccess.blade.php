@extends('layouts.web.main')
@section('title', 'Đơn hàng')
@section('content_banner')
<div class="row"></div>
@endsection
@section('content')
<div class="alert" style="text-align:center">
    <h4 style="color: green;">Thanh Toán Thành Công !</h4>
</div>
<div class="info" style="text-align:center; margin-bottom:100px">

<span style="text-align:left">Mã Giao Dịch : {{$data['vnp_TransactionNo']}}</span><br>
<span style="text-align:left">Phương Thức Thanh Toán : {{$data['vnp_OrderInfo']}}</span><br>
<span style="text-align:left">Tổng Đơn Hàng Thanh Toán : {{number_format($data['vnp_Amount']/100,0,'.','.')}} VNĐ</span><br>
<span style="text-align:left">Ngày Giao Dịch : {{date('d-m-Y H:i:s', $data['vnp_PayDate'])}}</span><br>
</div>
@endsection