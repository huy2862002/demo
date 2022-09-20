@extends('layouts.server.main')
@section('title', 'Thông Tin Đơn Hàng')
@section('title_tab', 'Thông Tin Đơn Hàng')
@section('content')
<div class="content" style="padding:0 12px">
    @if(count($order_detail) > 0)
    <div class="pdf">
    <a href="{{route('server.order.export', $order->id)}}"><button class="btn btn-warning">Export PDF</button></a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th scope="col">TÊN SẢN PHẨM</th>
                <th scope="col">ĐƠN GIÁ</th>
                <th scope="col">SỐ LƯỢNG</th>
                <th scope="col">THÀNH TIỀN</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($order_detail as $item)
            <tr>
                <td><img width="100px" height="100px" src="{{asset($item->avatar)}}" alt=""></td>
                <td>{{$item->name}}</td>
                <td>{{number_format($item->price,0,',',',')}} VNĐ</td>
                <td>{{$item->quantity}}</td>
                <td>{{number_format($item->price * $item->quantity,0,',',',')}} VNĐ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="add" style="text-align: center;color:red">
        <span>Đơn Hàng Không Tồn Tại !</span>
    </div>
    @endif
    <div class="info">
        <span style="color: red;">Mã Đơn Hàng</span> : <span>{{$order->id}}</span><br>
        <span style="color: red;">Họ Tên Khách Hàng</span> : <span>{{$order->user_name}}</span><br>
        <span style="color: red;">Số Điện Thoại</span> : <span>{{$order->phone_number}}</span><br>
        <span style="color: red;">Địa Chỉ </span> : <span>{{$order->address}}</span><br>
        <span style="color: red;">Tổng Thiệt Hại </span> : <span>{{number_format($order->total_money,0,'.','.') }} VNĐ</span><br>
    </div>
</div>
@endsection
