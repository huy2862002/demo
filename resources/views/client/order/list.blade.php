@extends('layouts.web.main')
@section('title', 'Đơn hàng')
@section('content_banner')
<div class="row"></div>
@endsection
@section('content')
@if(count($orders) >0)
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="">
                            <tr class="text-center">
                                <th>Mã Đơn Hàng</th>
                                <th>Địa Chỉ</th>
                                <th>Trạng Thái</th>
                                <th>Tổng</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $item)
                            <tr class="text-center">
                                <td class="product-name">
                                    <h3>#{{$item->id}}</h3>
                                </td>
                                <td class="quantity">
                                    <span>{{$item->address}}</span>
                                </td>
                                <td class="status">
                                    <span>{{config('orderStatus.'.$item->status)}}</span>
                                </td>
                                <td class="price">
                                    <span>{{number_format($item->total_money,0,',',',') }} VNĐ</span>
                                </td>
                                @if($item->status == 0 || $item->status == 1)
                                <td>
                                    <form action="{{route('cancelOrder', $item->id)}}" method="post">
                                        @csrf
                                        <button id="btn-del" class="btn btn-danger">- Hủy -</button>
                                    </form>
                                </td>
                                @else
                                <td></td>
                                @endif
                                <td>
                                    <a href="{{route('orderDetail', $item->id)}}" class="btn btn-info">Chi Tiết</a>
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

@section('script')
<script>
    var del = document.querySelectorAll('#btn-del');
    del.forEach(function(item) {
        item.onclick = function() {
            var result = confirm("Bạn Có Chắc Chắn Muốn Hủy Đơn Hàng Này Không ?");
            if (result == true) {
                return true;
            } else {
                return false;
            }
        }
    });
</script>
@endsection