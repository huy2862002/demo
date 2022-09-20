@extends('layouts.web.main')
@section('title', 'Đơn hàng')
@section('content_banner')
<div class="row"></div>
@endsection
@section('content')
    @if(Auth::check() == true)
<section class="ftco-section ftco-cart">
    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Đang Giao Đến</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Chuẩn Bị Giao Hàng</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Đang Xử Lý</a>

                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Đã Hủy</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        @if(count($delivering) > 0 )
                        <div class="row">
                            <div class="col-md-12 ftco-animate">
                                <div class="cart-list">
                                    <table class="table">
                                        <thead class="">
                                            <tr class="text-center">
                                                <th>Mã Đơn Hàng</th>
                                                <th>Địa Chỉ</th>
                                                <th>Trạng Thái</th>
                                                <th>Ngày Mua</th>
                                                <th>Tổng</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($delivering as $item)
                                            <tr class="text-center">
                                                <td class="product-name">
                                                    <h3>#{{$item->id}}</h3>
                                                </td>
                                                <td class="quantity">
                                                    <span>{{$item->address}}, {{$item->disName}}, {{$item->provinceName}}</span>
                                                </td>
                                                <td class="status">
                                                    <span>{{config('orderStatus.'.$item->status)}}</span>
                                                </td>
                                                <td>
                                                    <span>{{date('d-m-Y', $item->created_at)}}</span>
                                                </td>
                                                <td class="price">
                                                    <span>{{number_format($item->total_money - $item->total_money * $item->discount/100 ,0,',',',') }} VNĐ</span>
                                                </td>

                                                <td>
                                                    <a id="del" href="{{route('cancel', $item->id)}}" class="btn btn-danger">Hủy</a>
                                                    <a href="{{route('orderDetail', $item->id)}}" class="btn btn-info">Chi Tiết</a>
                                                </td>
                                            </tr><!-- END TR-->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <h5 style="color: red;text-align:center;margin-bottom:31px">Bạn Không Có Đơn Hàng Nào Đang Được Giao !</h5>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2" style="padding-left: 12px;">
                    @if(count($processing) > 0 )
                        <div class="row">
                            <div class="col-md-12 ftco-animate">
                                <div class="cart-list">
                                    <table class="table">
                                        <thead class="">
                                            <tr class="text-center">
                                                <th>Mã Đơn Hàng</th>
                                                <th>Địa Chỉ</th>
                                                <th>Trạng Thái</th>
                                                <th>Ngày Mua</th>
                                                <th>Tổng</th>
                                                <th>#</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($processing as $item)
                                            <tr class="text-center">
                                                <td class="product-name">
                                                    <h3>#{{$item->id}}</h3>
                                                </td>
                                                <td class="quantity">
                                                    <span>{{$item->address}}, {{$item->disName}}, {{$item->provinceName}}</span>
                                                </td>
                                                <td class="status">
                                                    <span>{{config('orderStatus.'.$item->status)}}</span>
                                                </td>
                                                <td>
                                                    <span>{{date('d-m-Y', $item->created_at)}}</span>
                                                </td>

                                                <td class="price">
                                                    <span>{{number_format($item->total_money - $item->total_money * $item->discount/100 ,0,',',',') }} VNĐ</span>
                                                </td>
                                                <td>
                                                    <a id="del" href="{{route('cancel', $item->id)}}" class="btn btn-danger">Hủy</a>
                                                    <a href="{{route('orderDetail', $item->id)}}" class="btn btn-info">Chi Tiết</a>
                                                </td>
                                            </tr><!-- END TR-->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <h5 style="color: red;text-align:center;margin-bottom:31px">Bạn Không Có Đơn Hàng Nào !</h5>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3" style="padding-left: 12px;">
                        @if(count($payment) > 0 )
                        <div class="row">
                            <div class="col-md-12 ftco-animate">
                                <div class="cart-list">
                                    <table class="table">
                                        <thead class="">
                                            <tr class="text-center">
                                                <th>Mã Đơn Hàng</th>
                                                <th>Địa Chỉ</th>
                                                <th>Trạng Thái</th>
                                                <th>Ngày Mua</th>
                                                <th>Tổng</th>
                                                <th>#</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payment as $item)
                                            <tr class="text-center">
                                                <td class="product-name">
                                                    <h3>#{{$item->id}}</h3>
                                                </td>
                                                <td class="quantity">
                                                    <span>{{$item->address}}, {{$item->disName}}, {{$item->provinceName}}</span>
                                                </td>
                                                <td class="status">
                                                    <span>{{config('orderStatus.'.$item->status)}}</span>
                                                </td>
                                                <td>
                                                    <span>{{date('d-m-Y', $item->created_at)}}</span>
                                                </td>
                                                <td class="price">
                                                    <span>{{number_format($item->total_money - $item->total_money * $item->discount/100 ,0,',',',') }} VNĐ</span>
                                                </td>

                                                <td>
                                                    <a id="del" href="{{route('cancel', $item->id)}}" class="btn btn-danger">Hủy</a>
                                                    <a href="{{route('orderDetail', $item->id)}}" class="btn btn-info">Chi Tiết</a>
                                                </td>
                                            </tr><!-- END TR-->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <h5 style="color: red;text-align:center;margin-bottom:31px">Bạn Không Có Đơn Hàng Nào Cần Thanh Toán !</h5>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="tab-pane-4" style="padding-left: 12px;">
                    @if(count($cancel) > 0 )
                        <div class="row">
                            <div class="col-md-12 ftco-animate">
                                <div class="cart-list">
                                    <table class="table">
                                        <thead class="">
                                            <tr class="text-center">
                                                <th>Mã Đơn Hàng</th>
                                                <th>Địa Chỉ</th>
                                                <th>Trạng Thái</th>
                                                <th>Ngày Mua</th>
                                                <th>Tổng</th>
                                                <th>#</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cancel as $item)
                                            <tr class="text-center">
                                                <td class="product-name">
                                                    <h3>#{{$item->id}}</h3>
                                                </td>
                                                <td class="quantity">
                                                    <span>{{$item->address}}, {{$item->disName}}, {{$item->provinceName}}</span>
                                                </td>
                                                <td class="status">
                                                    <span>{{config('orderStatus.'.$item->status)}}</span>
                                                </td>
                                                <td>
                                                    <span>{{date('d-m-Y', $item->created_at)}}</span>
                                                </td>
                                                <td class="price">
                                                    <span>{{number_format($item->total_money - $item->total_money * $item->discount/100 ,0,',',',') }} VNĐ</span>
                                                </td>
                                                <td>
                                                    <a href="{{route('orderDetail', $item->id)}}" class="btn btn-info">Chi Tiết</a>
                                                <td>
                                            </tr><!-- END TR-->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <h5 style="color: red;text-align:center;margin-bottom:31px">Bạn Không Có Đơn Hàng Nào Đã Hủy !</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
    @else
       <div class="search_order" style="text-align: center; margin:100px auto;">
           <form action="" method="post">
               @csrf
               <label>
                   <span id="error" style="padding-left: 12px;font-size: 14px; color: red"></span>
                   <input type="text" name="gmail" placeholder="Nhập Gmail" class="form-control"><br>
               </label>
               <button id="btn" class="btn btn-info">Tìm Kiếm</button>
           </form>
       </div>
    @endif
@endsection

@section('script')
<script>
    var del = document.querySelectorAll('#del');
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
    $(function (){
        $('#btn').on('click', function (){
            let check = true;
            if($("input[name = 'gmail']").val().trim() == ''){
                let error = `Nhập gmail của bạn`;
                    $('#error').html(error);
                    check = false;
            }else{
                let error = ``;
                $('#error').html(error);
            }
            return check;
        })
    })
</script>
@endsection
