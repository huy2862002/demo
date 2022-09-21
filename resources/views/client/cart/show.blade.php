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
                    <div class="col-xl-8 ftco-animate">
                        <div class="billing-form">
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Full Name</label><span id="error_user_name"
                                                                                      style="padding-left: 12px;font-size: 14px; color: red"></span>
                                        <input type="text" class="form-control" name="user_name"
                                               value="{{Auth::check() ? Auth::user()->name : ''}}"
                                               placeholder="Enter Your Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Phone Number</label><span id="error_phone"
                                                                                         style="padding-left: 12px;font-size: 14px; color: red"></span>
                                        <input type="text" class="form-control" name="phone_number"
                                               value="{{Auth::check() ? Auth::user()->phone_number : ''}}"
                                               placeholder="Enter Your Phone Number">
                                    </div>
                                </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Email</label><br>
                                            @if(Auth::check())
                                            <input checked name="email"
                                                   value="{{Auth::user()->email}}"
                                                   type="radio"> {{Auth::user()->email}} <br>
                                            @else
                                                <input type="text" class="form-control" name="email"
                                                       value="{{old('email') ? old('email') : ''}}"
                                                       placeholder="Enter Your Email">
                                            @endif
                                        </div>
                                    </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="streetaddress">Delivery Time</label>
                                        <select class="form-control" name="district_id" required>
                                            <option selected value="1">Morning</option>
                                            <option value="2">Noon</option>
                                            <option value="3">Afternoon</option>
                                            <option value="4">Night</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Region</label><span id="error_region"
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
                                            <label for="streetaddress">Province / City</label><span id="error_province"
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
                                            <label for="streetaddress">District</label><span id="error_district"
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
                                    <div class="form-group">
                                        <label for="streetaddress">Address</label><span id="error_district"
                                                                                             style="padding-left: 12px;font-size: 14px; color: red"></span>
                                            <input type="text" class="form-control" name="address"
                                                   value=""
                                                   placeholder="Email của bạn">
                                    </div>
                                </div>
                            </div>

                        </div><!-- END -->

                        <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                <p class="d-flex total-price" id="ship">
                                    <span>Phí Ship</span>
                                    <span>{{number_format(10000,0,',',',')}} VNĐ</span>
                                </p>
                                <p class="d-flex total-price" id="total">
                                    <span>Tổng</span>
                                    <span>{{number_format(10000 + $total,0,',',',')}} VNĐ</span>
                                </p>
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


        })
    </script>
@endsection

