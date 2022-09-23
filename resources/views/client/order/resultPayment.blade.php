@extends('layouts.web.main')
@section('content_banner')
    <div class="row"></div>
@endsection
@section('content')
    <div style="{{$_GET['vnp_ResponseCode'] == '00' ? 'background-color: green' : 'background-color: red'}}; color: white; padding: 12px">
        <div style="max-width: 500px; margin: 31px auto; text-align: center">
            <div class="form-group">
                <label>Mã đơn hàng:</label>

                <label>{{$_GET['vnp_TxnRef']}}</label>
            </div>
            <div class="form-group">
                <label>Số tiền:</label>
                <label>{{number_format($_GET['vnp_Amount']/100,0,'.','.')}} VNĐ </label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label>{{$_GET['vnp_OrderInfo']}}</label>
            </div>
            <div class="form-group">
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label>{{ $_GET['vnp_ResponseCode'] }}</label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label>{{$_GET['vnp_TransactionNo']}}</label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label>{{$_GET['vnp_BankCode']}} </label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label>{{date('d-m-Y',$_GET['vnp_PayDate'])}} </label>
            </div>
            @if ($_GET['vnp_ResponseCode'] == '00')
                GD Thanh cong
            @else
                GD Khong thanh cong
            @endif
        </div>
    </div>
@endsection
