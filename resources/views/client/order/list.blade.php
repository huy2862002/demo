@extends('layouts.web.main')
@section('title', 'Đơn hàng')
@section('content_banner')
<div class="row"></div>
@endsection
@section('content')
@if(count($order) > 0)
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Mã Đơn Hàng</th>
                                <th>Trạng Thái</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $item)
                            <tr class="text-center" style="background-color: greenyellow;">
                                @if($item->status == 1)
                                <td class="product-remove">
                                    <form action="" method="post">
                                        @csrf
                                        @method('delete')
                                        <button><span class="ion-ios-close"></span></button>
                                    </form>
                                </td>
                                @else
                                <td></td>
                                @endif
                                <td class="product-name">
                                    <h3>QWERTY{{$item->id}}</h3>
                                </td>
                                <td>
                                    <span>{{config('orderStatus.'.$item->status)}}</span>
                                </td>
                                <td></td>
                            </tr><!-- END TR-->
                            @foreach($order_detail as $o)
                            @if($o->order_id == $item->id)
                            <tr>
                                <td class="image-prod">
                                    <a href="">
                                        <img width="100px" height="100px" src="{{asset($o->avatar)}}" alt="">
                                    </a>
                                </td>
                                <td class="product-name">
                                    <h3>{{$o->name}}</h3>
                                </td>
                                <td class="quantity">
                                    <span>{{$o->quantity}}</span>
                                </td>
                                <td class="total">{{number_format($o->total_money,0,',',',')}} VNĐ</td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<h3 style="color: red;text-align:center;margin-bottom:31px">Giỏ Hàng Trống !</h3>
@endif
@endsection