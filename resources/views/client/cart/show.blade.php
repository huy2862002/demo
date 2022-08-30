@extends('layouts.web.main')
@section('title', 'Giỏ Hàng')
@section('content_banner')
<div class="row">

</div>
@endsection

@section('content')
@if(session()->get('cart'))
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session()->get('cart') as  $item)
                            <tr class="text-center">
                                <td class="product-remove">
                                    <form action="" method="post">
                                        @csrf
                                        @method('delete')
                                    <button><span class="ion-ios-close"></span></button>
                                    </form>
                                </td>

                                <td class="image-prod">
                                    <a href="{{route('product.detail', $item['id'])}}">
                                    <img width="100px" height="100px" src="{{asset($item['avatar'])}}" alt="">
                                    </a>
                                </td>

                                <td class="product-name">
                                    <h3>{{$item['name']}}</h3>
                                </td>

                                <td class="price">
                                    <span>{{number_format($item['price'],0,',',',') }} VNĐ</span>
                                </td>

                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="text" name="quantity" class="quantity form-control input-number" value="{{$item['quantity']}}" min="1" max="100">
                                    </div>
                                </td>
                            </tr><!-- END TR-->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <p class="d-flex total-price">
                        <span>Tổng Tất Cả</span>
                        <span>{{number_format($total,0,',',',') }} VNĐ</span>
                    </p>
                </div>
                <p class="text-center"><a href="{{route('checkOut')}}" class="btn btn-primary py-3 px-4">Đặt Hàng</a></p>
            </div>
        </div>
    </div>
</section>
@else
<h3 style="color: red;text-align:center;margin-bottom:31px">Giỏ Hàng Trống !</h3>
@endif
@endsection