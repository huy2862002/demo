@extends('layouts.web.main')
@section('title', 'Thanh Toán')
@section('content_banner')
<div class="row">

</div>
@endsection
@section('content')
@if(session()->get('cart'))
<section class="ftco-section">
    <div class="container">

        <form class="row justify-content-center" action="{{route('payment')}}" method="post">
            @csrf
            <div class="col-xl-8 ftco-animate">
                <div class="billing-form">
                    <h3 class="mb-4 billing-heading">Thông Tin Khách Hàng</h3>
                    <div class="error" style="display:grid; grid-template-columns:1fr 1fr">
                        @if($errors ->any())
                        @foreach($errors->all() as $error)
                        <span style="text-align: left;" class="login-box-msg text-danger">{{$error}}</span>
                        @endforeach
                        @endif
                    </div><br>
                    <div class="row align-items-end">
                        @if(Auth::check())
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Họ Và Tên</label>
                                <input type="text" class="form-control" name="user_name" value="{{Auth::user()->name ? Auth::user()->name : old('user_name')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Số Điện Thoại</label>
                                <input type="text" class="form-control" name="phone_number" value="{{Auth::user()->phone_number ? Auth::user()->phone_number : old('phone_number')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Email</label>
                                <input type="text" class="form-control" name="email" value="{{Auth::user()->email ? Auth::user()->email : old('email')}}">
                            </div>
                        </div>
                        @else
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Họ Và Tên</label>
                                <input type="text" class="form-control" placeholder="Nhập Vào Họ Tên" name="user_name" value="{{old('user_name') ? old('user_name') : ''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Số Điện Thoại</label>
                                <input type="text" class="form-control" placeholder="Nhập Vào Số Điện Thoại" name="phone_number" value="{{old('phone_number') ? old('phone_number') : ''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Email</label>
                                <input type="text" class="form-control" placeholder="Nhập Vào Email" name="email" value="{{old('email') ? old('email') : ''}}">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        @endif
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Vùng / Miền</label>
                                <select id="selectData" class="form-control" name="region_id">
                                    @if($address != null && $address->region_id == 3)
                                    <option selected value="3">Miền Nam</option>
                                    <option value="1">Miền Bắc</option>
                                    <option value="2">Miền Trung</option>
                                    @elseif($address != null && $address->region_id == 2)
                                    <option selected value="2">Miền Trung</option>
                                    <option value="1">Miền Bắc</option>
                                    <option value="3">Miền Nam</option>
                                    @else
                                    <option selected value="1">Miền Bắc</option>
                                    <option value="2">Miền Trung</option>
                                    <option value="3">Miền Nam</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Tỉnh / Thành Phố</label>
                                <select name="province_id" class="form-control" id="provinceData" required>
                                    @if($address != null)
                                    <option selected value="{{$address->province_id}}">{{$address->provinceName}}</option>
                                    @endif
                                    @foreach($provinces as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Quận / Huyện / Xã</label>
                                <select id="districtData" class="form-control" name="district_id" required>
                                    @if($address != null)
                                    <option value="{{$address->district_id}}">{{$address->districtName}}</option>
                                    @endif
                                    @foreach($districts as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="address">
                                <label for="postcodezip">Địa Chỉ</label>
                                <input type="text" class="form-control" placeholder="Nhập Địa Chỉ Nhận Hàng" value="{{$address != null ? $address->address : ''}}" name="address">
                            </div>
                        </div>
                    </div>
                </div><!-- END -->
                <div class="row mt-5 pt-3 d-flex">
                    <div class="col-md-6 d-flex">
                        <div class="cart-detail cart-total bg-light p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Thông Tin Đơn Hàng</h3>
                            @foreach(session()->get('cart') as $item)
                            <p class="d-flex">
                                <span>{{$item['name']}}</span>
                                <span>[{{$item['quantity']}}]</span>
                            </p>
                            @endforeach
                            <hr>
                            <p class="d-flex total-price" id="ship">
                                <span>Phí Ship</span>
                                <span>{{number_format($ship,0,'.','.')}} VNĐ</span>
                            </p>
                            <p class="d-flex total-price" id="total">
                                <span>Tổng</span>
                                <span>{{number_format($ship + $total,0,'.','.')}} VNĐ</span>
                            </p>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-detail bg-light p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Phương Thức</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label>
                                            <input checked type="radio" name="optradio" class="mr-2" value="2">
                                            <img width="88px" height="55px" src="{{asset('web/images/vnpay.png')}}" alt="">
                                            Thanh Toán VN Pay
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <select class="form-select" name="bank">
                                        <option value="NCB" selected>Ngân Hàng NCB</option>
                                        <option value="BIDV">Ngân Hàng BIDV</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label><input required type="checkbox" checked name="check" value="" class="mr-2"> Tôi Đã Chắc Chắn !</label>
                                    </div>
                                </div>
                            </div>
                            <button name="redirect" class="btn btn-primary py-3 px-4">Đặt Hàng</button>
                        </div>
                    </div>
                </div>

            </div> <!-- .col-md-8 -->
        </form>
    </div>
</section> <!-- .section -->
@endif
@endsection

@section('script')
<script>
    $(function() {
        $('#selectData').on('click', function() {
            let value = $(this).val();
            CallApiProvince(url = "{{route('provinceData')}}", value)
        })

        function CallApiProvince(url, data) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    data: data
                },
                success: function(res) {
                    HandleDataProvince(res.data);
                }
            })
        }

        function HandleDataProvince(data) {
            let url = window.location.origin;
            let html = data.map(function(value) {
                return `
                <option value="${value.id}">${value.name}</option>`
            })
            $('#provinceData').html(html)
        }

        $('#provinceData').on('click', function() {
            let value = $(this).val();
            CallApiDistrict(url = "{{route('districtData')}}", value)
        })

        function CallApiDistrict(url, data) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    data: data
                },
                success: function(res) {
                    console.log(res.data);
                    HandleDataDistrict(res.data);
                }
            })
        }

        function HandleDataDistrict(data) {
            let url = window.location.origin;
            const format = new Intl.NumberFormat('en');
            let html = data.map(function(value) {
                return `
                <option value="${value.id}">${value.name}</option>`
            })
            $('#districtData').html(html);
        }
        $('#districtData').on('click', function() {
            let value = $(this).val();
            console.log(value)
            CallApiShip(url = "{{route('shipData')}}", value)
        })

        function CallApiShip(url, data) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    data: data
                },
                success: function(res) {
                    console.log(res.data);
                    HandleDataShip(res.data);
                }
            })
        }

        function HandleDataShip(data) {
            let url = window.location.origin;
            const format = new Intl.NumberFormat('en');
            let ship = `
            <span>Phí Ship</span>
                                <span>${format.format(data.weight * 10000)} VNĐ</span>
                                `
            $('#ship').html(ship)

            let total = `
            <span>Tổng</span>
                                <span>${format.format(data.weight * 10000 + {{$total}})} VNĐ</span>
                                `
            $('#total').html(total)
        }
    });
</script>

@endsection