@extends('layouts.web.main')
@section('title', 'Thanh Toán')
@section('content_banner')
<div class="row">

</div>
@endsection
@section('content')
<section class="ftco-section">
    <div class="container">
        <form class="row justify-content-center" action="{{route('payment')}}" method="post">
            @csrf
            <div class="col-xl-8 ftco-animate">
                <div class="billing-form">
                    <h3 class="mb-4 billing-heading">Thông Tin Khách Hàng</h3>
                    <div class="row align-items-end">
                        @if(Auth::check())
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Họ Và Tên</label>
                                <input type="text" class="form-control" name="user_name" value="{{Auth::user()->name}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Số Điện Thoại</label>
                                <input type="text" class="form-control" name="phone_number" value="{{Auth::user()->phone_number}}" required>
                            </div>
                        </div>
                        @else
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Họ Và Tên</label>
                                <input type="text" class="form-control" placeholder="Nhập Vào Họ Tên" required name="user_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Số Điện Thoại</label>
                                <input type="text" class="form-control" placeholder="Nhập Vào Số Điện Thoại" required name="phone_number">
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
                                <input required type="text" class="form-control" placeholder="Nhập Địa Chỉ Nhận Hàng" value="{{$address != null ? $address->address : ''}}" name="address">
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
                            <p class="d-flex total-price">
                                <span>Tổng</span>
                                <span>{{number_format($total,0,',',',')}} VNĐ</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="cart-detail bg-light p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Phương Thức</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"> Trả Tiền Mặt Sau Khi Nhận Hàng</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"> Chuyển Khoản</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label><input required type="checkbox" checked name="check" value="" class="mr-2"> Tôi Đã Chắc Chắn !</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary py-3 px-4">Đặt Hàng</button>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-md-8 -->
        </form>
    </div>
</section> <!-- .section -->
@endsection

@section('script')
<script>
    $(function() {
        $('#selectData').on('click', function() {
            let value = $(this).val();
            CallApiProvince(url = "{{route('provinceData')}}", value)
        })

        $('#provinceData').on('click', function() {
            let value = $(this).val();
            CallApiDistrict(url = "{{route('districtData')}}", value)
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

        function CallApiDistrict(url, data) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    data: data
                },
                success: function(res) {
                    HandleDataDistrict(res.data);
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

        function HandleDataDistrict(data) {
            let url = window.location.origin;
            let html = data.map(function(value) {
                return `
                <option value="${value.id}">${value.name}</option>`
            })
            $('#districtData').html(html)
        }


    });
</script>

@endsection