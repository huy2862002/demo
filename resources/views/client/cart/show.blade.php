@extends('layouts.web.main')
@section('content_banner')
    <div class="row"></div>
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
                                    <span><a href="">< CONTINUE BUYING</a></span>
                                    <span>Your Shopping Cart</span>
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
                                            <img width="100px" height="100px" src="{{asset($item['image'])}}"
                                                 alt="">
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
                                                <input type="number" name="quantity" id="{{$item['id']}}"
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
                                    <span>PROVISIONAL</span>
                                    <span>{{number_format($total,0,',',',') }} VNĐ</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="row justify-content-center" action="{{route('checkout')}}" method="post">
                    @csrf
                    <div class="container" style="display: grid; grid-template-columns: 2fr 1fr; grid-gap: 12px">
                        <div class="billing-form">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Full Name</label><span id="error_user_name"
                                                                                      style="padding-left: 12px;font-size: 14px; color: red"></span>
                                        <input type="text" class="form-control" name="user_name"
                                               value="{{$user != null ? $user->name : ''}}"
                                               placeholder="Enter your full name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Phone Number</label><span id="error_phone"
                                                                                        style="padding-left: 12px;font-size: 14px; color: red"></span>
                                        <input type="text" class="form-control" name="phone_number"
                                               value="{{$user != null ? $user->phone_number : ''}}"
                                               placeholder="Enter your phone number">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Email</label><span id="error_email"
                                                                                style="padding-left: 12px;font-size: 14px; color: red"></span>
                                        @if($user != null)
                                            <input checked name="email"
                                                   value="{{$user->email}}"
                                                   type="radio"> {{$user->email}} <br>
                                        @else
                                            <input type="email" class="form-control" name="email"
                                                   value=""
                                                   placeholder="Enter your email">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="streetaddress">Delivery Time</label><span id="error_delivery"
                                                                                              style="padding-left: 12px;font-size: 14px; color: red"></span>
                                        <select id="delivery_time" class="form-control" name="delivery">
                                            <option selected value="0">---</option>
                                            <option value="1">Morning</option>
                                            <option value="2">Noon</option>
                                            <option value="3">Afternoon</option>
                                            <option value="4">Night</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                @if($address == '')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Region</label><span id="error_region"
                                                                                           style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <select id="regionData" class="form-control" name="region_id">
                                                <option selected value="0">---</option>
                                                @if(count($regions) > 0)
                                                    @foreach($regions as $region)
                                                        <option value="{{$region->id}}">{{$region->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Province / City</label><span id="error_province"
                                                                                                    style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <select id="provinceData" class="form-control" name="province_id">
                                                <option selected value="0">---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">District</label><span id="error_district"
                                                                                             style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <select id="districtData" class="form-control" name="district_id">
                                                <option selected value="0">---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Address</label><span id="error_address"
                                                                                            style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <input type="text" class="form-control" name="address"
                                                   value=""
                                                   placeholder="Enter your address">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12" id="addressPresent">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="address">Address</label><span id="error_address"
                                                                                          style="padding-left: 12px;font-size: 14px; color: red"></span>
                                                <input checked name="address_id"
                                                       value="{{$address->id}}"
                                                       type="radio"> {{$address->address}}
                                                - {{$address->districtType}} {{$address->districtName}}
                                                - {{$address->provinceType}} {{$address->provinceName}}
                                                <br>
                                                <span style="color: blue; cursor: pointer" id="other_address">Địa chỉ khác</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="billing-form">
                                <div class="row align-items-end" id="updateAddress">

                                </div>
                            </div>

                        </div><!-- END -->
                        <div class="cart-detail cart-total bg-light p-3 p-md-4">
                            <p class="d-flex total-price" id="ship">
                                <span>Ship Fee</span>
                                <span>{{$ship_fee != '' ? number_format($ship_fee,0,',',',') : '---'}} VNĐ</span>
                            </p>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>{{number_format($total,0,',',',')}} VNĐ</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price" id="total">
                                <span>SubTotal</span>
                                <span>{{$ship_fee != '' ? number_format($ship_fee + $total,0,',',',') : '---'}} VNĐ</span>
                            </p>
                            <button id="submit_cart" class="btn btn-primary py-3 px-4"
                                    style="color: white; margin-top: 28px">Đặt Hàng
                            </button>
                        </div>
                    </div> <!-- .col-md-8 -->
                </form>
            </div>
        </section>
    @else
        <div style="text-align: center; margin: 66px auto">
            <img width="6%" src="{{asset('web/images/cart_empty.jpg')}}">
        </div>
    @endif
@endsection
@section('script')
    <script>
        $(function () {
            function call_address() {
                $("select[name = 'region_id']").on('change', function () {
                    let value = $(this).val();
                    if (value != 0) {
                        let url = "{{route('provinceData')}}"
                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                data: value
                            },
                            success: function (res) {
                                let data = res.data;
                                let html = data.map(function (value, key) {
                                    return `
                                     <option value="${value.id}"> ${value.name} </option>
                                    `
                                });
                                let select = ` <option selected value="0"> --- </option>`
                                $('#provinceData').html(html);
                                $('#provinceData').append(select)
                            }
                        })
                    }
                })

                $("select[name = 'province_id']").on('change', function () {
                    let value = $(this).val();
                    if (value != 0) {
                        let url = "{{route('districtData')}}"
                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                data: value
                            },
                            success: function (res) {
                                let data = res.data;
                                let html = data.map(function (value, key) {
                                    return `
                                     <option value="${value.id}"> ${value.name} </option>
                                    `
                                });
                                let select = ` <option selected value="0"> --- </option>`
                                $('#districtData').html(html);
                                $('#districtData').append(select)
                            }
                        })
                    }
                })

                $("select[name = 'district_id']").on('change', function () {
                    let value = $(this).val();
                    if (value != 0) {
                        let url = "{{route('shipData')}}"
                        $.ajax({
                            url: url,
                            method: 'GET',
                            data: {
                                data: value
                            },
                            success: function (res) {
                                const format = new Intl.NumberFormat('en');
                                let data = res.data;
                                let subtotal = data.ship_fee + {{$total}};
                                console.log(data);
                                let ship = `<span>Ship Fee</span>
                                <span>${format.format(data.ship_fee)} VNĐ</span>`
                                $('#ship').html(ship)
                                let total = `<span>Total</span>
                                <span>${format.format(subtotal)} VNĐ</span>`
                                $('#total').html(total)
                            }
                        })
                    }
                })
            }

            call_address();
            $('#other_address').on('click', function () {
                let add = `
                 <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Region</label><span id="error_region"
                                                                                           style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <select id="regionData" class="form-control" name="region_id">
                                                <option selected value="0">---</option>
                                                @if(count($regions) > 0)
                @foreach($regions as $region)
                <option value="{{$region->id}}">{{$region->name}}</option>
                                                    @endforeach
                @endif
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="streetaddress">Province / City</label><span id="error_province"
                                                                        style="padding-left: 12px;font-size: 14px; color: red"></span>
                <select id="provinceData" class="form-control" name="province_id">
                    <option selected value="0">---</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="streetaddress">District</label><span id="error_district"
                                                                 style="padding-left: 12px;font-size: 14px; color: red"></span>
                <select id="districtData" class="form-control" name="district_id">
                    <option selected value="0">---</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="streetaddress">Address</label><span id="error_address"
                                                                style="padding-left: 12px;font-size: 14px; color: red"></span>
                <input type="text" class="form-control" name="address"
                       value=""
                       placeholder="Enter your address">
            </div>
        </div>
`
                $('#updateAddress').html(add);
                $('#addressPresent').remove();
                call_address();
            });


        })

    </script>
@endsection

