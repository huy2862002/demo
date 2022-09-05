@extends('layouts.web.main')
@section('title', 'Đơn hàng')
@section('content_banner')
<div class="row"></div>
@endsection
@section('content')
@if(count($order_detail) > 0)
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="">
                            <tr class="text-center">
                                <th></th>
                                <th>Tên Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order_detail as $item)
                            <tr class="text-center">
                            <td class="product-name">
                                    <img width="100px" height="100px" src="{{asset($item->avatar)}}" alt="">
                                </td>
                                <td class="product-name">
                                    <h3>#{{$item->name}}</h3>
                                </td>
                                <td class="price">
                                    <span>{{number_format($item->price,0,'.','.')}} VNĐ</span>
                                </td>
                                <td class="quantity">
                                    <span>{{$item->quantity}}</span>
                                </td>
                            </tr><!-- END TR-->
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
@else
<h3 style="color: red;text-align:center;margin-bottom:31px">Bạn Chưa Có Đơn Hàng Nào !</h3>
@endif
@endsection