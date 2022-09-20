@extends('layouts.web.main')
@section('title', 'Giỏ Hàng')
@section('content_banner')
    <div class="row"></div>
@endsection
@section('content')
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <form action="{{route('handle', $order->id)}}" method="post">
                        @csrf
                        <div class="cart-list">
                            <table class="table">
                                <tbody>
                                @foreach($detail as  $item)
                                    <tr class="text-center">
                                        <td class="image-prod">
                                            <img width="100px" height="100px" src="{{asset($item['proAvatar'])}}"
                                                 alt="">
                                        </td>
                                        <td class="product-name">
                                            <h3>{{$item['proName']}} [ {{$item['quantity']}} ]</h3>
                                        </td>
                                        <td class="price">
                                            <span>{{number_format($item['proPrice'] * $item['quantity'],0,',',',') }} VNĐ</span>
                                        </td>
                                    </tr><!-- END TR-->
                                @endforeach
                                </tbody>
                            </table>
                            <div class="cart-total mb-3">
                                <p class="d-flex total-price">
                                    <span> Địa chỉ : {{$address->address}}, {{$address->districtName}}, {{$address->provinceName}} <br>
                                    Số điện thoại nhận hàng : {{$address->phone_number}} <br>
                                    Người nhận : {{$address->user_name}} <br>
                                    <span id="ship">Phí ship : {{number_format($ship,0,',',',') }} VNĐ</span>
                                        Giảm giá :<span id="code">- 0 VNĐ</span>
                                    Tổng thanh toán : <span id="total">{{number_format($order->total_money,0,',',',') }} VNĐ</span> </span>
                                    <span>
                                        <input name="code" type="text" class="form-control"
                                               placeholder="Nhập Mã Giảm Giá">
                                     <input id="sub_code" type="button" class="form-control" value="Áp Dụng">
                                        Phương Thức Thanh Toán <br>
                                    <input value="1" name="method_pay" type="radio">  <label><img height="50px"
                                                                                                  width="60px"
                                                                                                  src="{{asset('web/images/momo.png')}}"></label>Thanh Toán Qua Momo <br>
                                        <input checked name="method_pay" value="2" type="radio">  <label><img
                                                height="50px"
                                                width="60px"
                                                src="{{asset('web/images/vnpay.png')}}"></label> Thanh Toán Qua VN Pay <br>
                                    </span>
                                </p>
                            </div>
                            <div class="pay" style="text-align: center" id="pay">
                                <button name="redirect" id="checkout" class="btn btn-primary py-3 px-4"
                                        style="color: white">Đặt Hàng
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function () {
            $('#sub_code').on('click', function () {
                if ($("input[name = 'code']").val().trim()) {
                    let value = $("input[name = 'code']").val();
                    let url = "{{route('codeData')}}";
                    CallCode(url, value);
                }
            })
            function CallCode(url, data) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        data: data
                    },
                    success: function (res) {
                        console.log(res.data);
                        ShowDiscount(res.data);
                    }
                })
            }
            function ShowDiscount(value) {
                if (value == 0) {
                    alert('Mã Giảm Giá Không Tồn Tại !');
                }
                const format = new Intl.NumberFormat('en');
                let code = `- ${format.format(value * {{$order->total_money}} / 100)} VNĐ ( - ${value}% )`;
                $('#code').html(code)
                let total = `${format.format(({{$order->total_money}}) - value * {{$order->total_money}} / 100)} VNĐ`;
                $('#total').html(total)
            }
        })
    </script>
@endsection
