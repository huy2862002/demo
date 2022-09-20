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
                            <div class="cart-total mb-3">
                                <p class="d-flex total-price">
                                    <span><a href="">< Tiếp Tục Mua</a></span>
                                    <span>Giỏ Hàng Của Bạn</span>
                                </p>
                            </div>
                            <table class="table">
                                <tbody>
                                @foreach(session()->get('cart') as  $item)
                                    <tr class="text-center">
                                        <td class="product-remove">
                                            <form action="{{route('delCart', $item['id'])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button><span class="ion-ios-close"></span></button>
                                            </form>
                                        </td>

                                        <td class="image-prod">
                                            <a href="{{route('product.detail', $item['id'])}}">
                                                <img width="100px" height="100px" src="{{asset($item['image'])}}"
                                                     alt="">
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <h3>{{$item['name']}}</h3>
                                            @if(count($att_opt) >0)
                                                @foreach($att_opt as $att)
                                                    @if(in_array($att->id , explode(' ',$item['option_id'] )))
                                            <span>{{$att->label}}.</span>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>

                                        <td class="price">
                                            <span>{{number_format($item['price_discount'],0,',',',') }} VNĐ</span>
                                        </td>

                                        <td class="quantity">
                                            <div class="input-group mb-3">
                                                <input type="text" name="quantity"
                                                       class="quantity form-control input-number"
                                                       value="{{$item['quantity']}}" min="1" max="100">
                                            </div>
                                        </td>
                                    </tr><!-- END TR-->
                                @endforeach
                                </tbody>
                            </table>
                            <div class="cart-total mb-3">
                                <p class="d-flex total-price">
                                    <span>Tạm Tính ( {{count(session()->get('cart'))}} Sản Phẩm)</span>
                                    <span>{{number_format($total,0,',',',') }} VNĐ</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="row justify-content-center" action="{{route('checkout')}}" method="post">
                    @csrf
                    <div class="col-xl-8 ftco-animate">
                        <div class="billing-form">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Họ Và Tên</label><span id="error_user_name"
                                                                                      style="padding-left: 12px;font-size: 14px; color: red"></span>
                                        <input type="text" class="form-control" name="user_name"
                                               value="{{Auth::check() ? Auth::user()->name : ''}}"
                                               placeholder="Nhập họ và tên">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Số Điện Thoại</label><span id="error_phone"
                                                                                         style="padding-left: 12px;font-size: 14px; color: red"></span>
                                        <input type="text" class="form-control" name="phone_number"
                                               value="{{Auth::check() ? Auth::user()->phone_number : ''}}"
                                               placeholder="Số điện thoại của bạn">
                                    </div>
                                </div>
                                @if(Auth::check())
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Email</label><br>
                                            <input checked name="email"
                                                   value="{{Auth::user()->email}}"
                                                   type="radio"> {{Auth::user()->email}} <br>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Email</label><span id="error_email"
                                                                                    style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <input type="text" class="form-control" name="email"
                                                   value="{{old('email') ? old('email') : ''}}"
                                                   placeholder="Email của bạn">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="streetaddress">Thời Gian Nhận Hàng</label>
                                        <select class="form-control" name="district_id" required>
                                            <option selected value="1">Sáng</option>
                                            <option value="2">Trưa</option>
                                            <option value="3">Chiều</option>
                                            <option value="4">Tối</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                @if($address == null)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Vùng / Miền</label><span id="error_region"
                                                                                                style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <select id="regionData" class="form-control" name="region_id" required>
                                                <option selected value="0">---</option>
                                                <option value="1">Miền Bắc</option>
                                                <option value="2">Miền Trung</option>
                                                <option value="3">Miền Nam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Tỉnh / Thành Phố</label><span id="error_province"
                                                                                                     style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <select id="provinceData" class="form-control" name="province_id">
                                                <option selected value="0">---</option>
                                                @foreach($provinces as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Quận / Huyện</label><span id="error_district"
                                                                                                 style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <select id="districtData" class="form-control" name="district_id">
                                                <option selected value="0">---</option>
                                                @foreach($districts as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="address">
                                            <label for="postcodezip">Địa Chỉ</label><span
                                                style="padding-left: 12px; font-size: 14px; color: red"
                                                id="error_address"></span>
                                            <input type="text" class="form-control" placeholder="Nhập Địa Chỉ Nhận Hàng"
                                                   value="{{$address != null ? $address->address : ''}}" name="address">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if($address != null)
                                <div class="address" id="address">
                                    <div class="form-group">
                                        <label for="address">Địa Chỉ : </label><br>
                                        <input checked name="address_id" value="{{$address->id}}"
                                               type="radio"> {{$address->address}}
                                        , {{$address->districtType}} {{$address->districtName}}
                                        , {{$address->provinceType}} {{$address->provinceName}} <br>
                                    </div>
                                    <a id="add_address" style="color: #0c84ff" href="#">Địa chỉ khác</a>
                                </div>
                            @endif
                        </div><!-- END -->

                        <div class="cart-detail cart-total bg-light p-3 p-md-4">
                            @if(is_numeric($ship))
                                <p class="d-flex total-price" id="ship">
                                    <span>Phí Ship</span>
                                    <span>{{number_format($ship,0,',',',')}} VNĐ</span>
                                </p>
                                <p class="d-flex total-price" id="total">
                                    <span>Tổng</span>
                                    <span>{{number_format($ship + $total,0,',',',')}} VNĐ</span>
                                </p>
                            @else
                                <p class="d-flex total-price" id="ship">
                                    <span>Phí Ship</span>
                                    <span>---</span>
                                </p>
                                <p class="d-flex total-price" id="total">
                                    <span>Tổng</span>
                                    <span>---</span>
                                </p>
                            @endif
                            <button id="submit_checkout" class="btn btn-primary py-3 px-4" style="color: white">Đặt Hàng
                            </button>
                        </div>
                    </div> <!-- .col-md-8 -->
                </form>
            </div>
        </section>
    @else
        <h3 style="color: red;text-align:center;margin-bottom:31px">Giỏ Hàng Trống !</h3>
    @endif
@endsection
@section('script')
    <script>
        $(function () {
            function call_address() {
                $('#regionData').on('change', function () {
                    let value = $(this).val();
                    if (value != 0) {
                        let url = "{{route('provinceData')}}"
                        CallProvince(url, value)
                    }
                })

                function CallProvince(url, data) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {
                            data: data
                        },
                        success: function (res) {
                            console.log(res.data);
                            showProvince(res.data)
                        }
                    })
                }

                function showProvince(data) {
                    let url = window.location.origin;
                    let html = data.map(function (value) {
                        return `
  <option value="0">---</option>
                    <option value="${value.id}">${value.name}</option>
                    `
                    });
                    $('#provinceData').html(html);
                }

                $('#provinceData').on('change', function () {
                    let value = $(this).val();
                    if (value != 0) {
                        let url = "{{route('districtData')}}"
                        CallDistrict(url, value)
                    }
                })

                function CallDistrict(url, data) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {
                            data: data
                        },
                        success: function (res) {
                            console.log(res.data);
                            showDistrict(res.data)
                        }
                    })
                }

                function showDistrict(data) {
                    let url = window.location.origin;
                    let html = data.map(function (value) {
                        return `
  <option value="0">---</option>
                    <option value="${value.id}">${value.name}</option>
                    `
                    });
                    $('#districtData').html(html);
                }

                $('#districtData').on('change', function () {
                    let value = $(this).val();
                    if (value != 0) {
                        let url = "{{route('shipData')}}"
                        CallShip(url, value)
                    }
                })

                function CallShip(url, data) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {
                            data: data
                        },
                        success: function (res) {
                            console.log(res.data);
                            showShip(res.data)
                        }
                    })
                }

                function showShip(data) {
                    const format = new Intl.NumberFormat('en');
                    let url = window.location.origin;
                    let ship = `
                              <span>Phí Ship</span>
                                    <span>${format.format(data.weight * 20000)} VNĐ</span>
                               `
                    let total = `
                                    <span>Tổng</span>
                                    <span>${format.format(data.weight * 20000 + {{$total}})} VNĐ</span>
                    `
                    $('#ship').html(ship);
                    $('#total').html(total);
                }

            }

            call_address();
            $('#add_address').on('click', function () {
                let html = `
                <div class="row align-items-end">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Vùng / Miền</label><span id="error_region" style="padding-left: 12px;font-size: 14px; color: red"></span>
                                    <select id="regionData" class="form-control" name="region_id">
                                       <option selected value="{{$address ? $address->region_id : 0}}">{{$address ? $regionName : '---'}}</option>
                                        <option  value="1">Miền Bắc</option>
                                        <option  value="2">Miền Trung</option>
                                        <option  value="3">Miền Nam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Tỉnh / Thành Phố</label><span id="error_province" style="padding-left: 12px;font-size: 14px; color: red"></span>
                                    <select id="provinceData" class="form-control" name="province_id" >
                                       <option selected value="{{$address ? $address->province_id : 0}}">{{$address ? $address->provinceName : '---'}}</option>
                                        @foreach($provinces as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
     <div class="form-group">
<label for="streetaddress">Quận / Huyện</label><span id="error_district" style="padding-left: 12px;font-size: 14px; color: red"></span>
<select id="districtData" class="form-control" name="district_id" >
 <option selected value="{{$address ? $address->district_id : 0}}">{{$address ? $address->districtName : '---'}}</option>
@foreach($districts as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                                             @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="address">
                <label for="postcodezip">Địa Chỉ</label><span style="padding-left: 12px; font-size: 14px; color: red" id="error_address"></span>
                <input type="text" class="form-control" placeholder="Nhập Địa Chỉ Nhận Hàng" value="{{$address != null ? $address->address : ''}}" name="address">
                                     </div>
                                 </div>
</div>
                `
                $('#address').html(html);
                call_address();
                return false;
            })
        })

    </script>
@endsection
