@extends('layouts.web.main')
@section('title', 'Đơn hàng')
@section('content_banner')
<div class="row"></div>
@endsection
@section('content')
@if(count($detail) > 0)
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                            @foreach($detail as $item)
                                    <img width="100px" height="100px" src="{{asset($item->image)}}" alt="">
                                <span style="margin-left: 31px">{{$item->productName}}</span>
                                    @foreach($att_opt as $opt)
                                        @if(in_array($opt->id, explode(' ', $item->option_id)))
                                            <span style="margin-left: 90px">{{$opt->value}}</span>
                                        @endif
                                    @endforeach
                                    <span style="margin-left: 90px">Số lượng : {{$item->quantity}}</span>
                        <span style="margin-left: 90px"><b style="color: orangered">Tổng : {{number_format($item->total_money,0,'.','.')}} VNĐ</b></span>
                            @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
