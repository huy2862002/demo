@extends('layouts.web.main')
@section('content_banner')
    <div class="row"></div>
@endsection
@section('content')
    <section class="ftco-section">
        <div class="container">
            <form action="{{route('addToCart', $product->id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 mb-5 ftco-animate">
                        <h3 style="text-align: center">{{$product->name}}</h3><br>
                        @if($default)
                            <div id="avt"><a href="{{asset($default->image)}}" class="image-popup"><img
                                        src="{{asset($default->image)}}"
                                        class="img-fluid"
                                        alt="Colorlib Template" width="700px" height="1200px"></a></div>
                        @else
                            <div id="avt"><a href="{{asset($product->image)}}" class="image-popup"><img
                                        src="{{asset($product->image)}}"
                                        class="img-fluid"
                                        alt="Colorlib Template" width="700px" height="1200px"></a></div>
                        @endif
                    </div>
                    <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                        <div class="rating d-flex">
                            <p class="text-left mr-4">
                                <a href="#" class="mr-2">5.0</a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                            </p>
                            <p class="text-left mr-4">
                                <a href="#" class="mr-2" style="color: #000;">100 <span
                                        style="color: #bbb;">Đánh giá</span></a>
                            </p>
                            <p class="text-left">
                                <a href="#" class="mr-2" style="color: #000;">500 <span
                                        style="color: #bbb;">Đã bán</span></a>
                            </p>
                        </div>
                        @if($default)
                            @if($default->price_discount < $default->price)
                                <div id="price"><span style="text-decoration-line:line-through" class="price-sale">{{number_format($default->price,0,',',',')}} VNĐ</span>
                                    <span style="color: red">( Giảm {{round(($default->price - $default->price_discount)/ $default->price * 100, 0)}}% )</span>
                                    <p class="price"><span class="price-sale">{{number_format($default->price_discount,0,',',',')}} VNĐ</span>
                                    </p></div>
                            @else
                                <div id="price">
                                    <p class="price"><span class="price-sale">{{number_format($default->price,0,',',',')}} VNĐ</span>
                                    </p>
                                </div>
                            @endif
                        @else
                            @if($product->price_discount < $product->price)
                                <span style="text-decoration-line:line-through" class="price-sale">{{number_format($product->price,0,',',',')}} VNĐ</span>
                                <span style="color: red">( Giảm {{round(($product->price - $product->price_discount)/ $product->price * 100, 0)}}% )</span>
                                <p class="price"><span class="price-sale">{{number_format($product->price_discount,0,',',',')}} VNĐ</span>
                                </p>
                            @else
                                <p class="price"><span
                                        class="price-sale">{{number_format($product->price,0,',',',')}} VNĐ</span></p>
                            @endif
                        @endif
                        <span>{{$product->short_description}}</span>
                        @if($default)
                            @if(count($chose_option) >0)
                                <div>
                                    @foreach($chose_option as $item)
                                        <div class="">
                                            <b>{{$item->name}}</b><br>
                                            <div
                                                style="display: grid;grid-template-columns: 1fr 1fr 1fr 1fr; grid-gap: 2px; text-align: left; margin-bottom: 20px">
                                                @foreach($opt as $o)
                                                    @if($o->attribute_id == $item->id)
                                                        @if(in_array($o->id, explode(' ', $default->option_id)))
                                                            <div class="dfa" id="att{{$o->id}}"
                                                                 style="text-align:center;border: 1px solid #a61ac8; background-color: #a61ac8; color: white">
                                                                <div>
                                                                    <input class="attribute" hidden id="rad{{$o->id}}"
                                                                           name="{{$item->name}}" type="radio" checked
                                                                           value="{{$o->id}}">
                                                                    @else
                                                                        <div class="dfa" id="att{{$o->id}}"
                                                                             style="text-align:center;border: 1px solid #cccccc">
                                                                            <div>
                                                                                <input hidden class="attribute"
                                                                                       id="rad{{$o->id}}"
                                                                                       name="{{$item->name}}"
                                                                                       type="radio"
                                                                                       value="{{$o->id}}">
                                                                                @endif
                                                                                @if($item->visual == 'text')
                                                                                    <span style="cursor: pointer"
                                                                                          class="option"
                                                                                          id="{{$o->id}}">{{$o->label}}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            @endforeach
                                            </div>
                                            @endif
                                            @endif
                                            <div class="row mt-4">
                                                <div class="w-100"></div>
                                                <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="ion-ios-remove"></i>
                                </button>
                            </span>
                                                    <input type="text" id="quantity" name="quantity"
                                                           class="form-control input-number"
                                                           value="1" min="1" max="100">
                                                    <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="ion-ios-add"></i>
                                </button>
                            </span>
                                                </div>
                                                <div class="w-100"></div>
                                            </div>
                                            <div id="btn-cart">
                                                <div style="background-color: deepskyblue">
                                                    <button style="width: 100%; cursor: pointer; color: white">ADD TO
                                                        CART
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Thông Tin
                            Thêm</a>
                    </div>
                    <div class="tab-content"
                         style="display: grid;grid-template-columns: 1.5fr 1fr; grid-gap:66px; padding-bottom: 31px">
                        <div class="tab-pane fade show active" id="tab-pane-1" style="padding-left: 12px;">
                            <h4 class="mb-3">{{$product->name}}</h4>
                            <p>{{$product->product_description}}</p>
                        </div>

                        <div>
                            <h4 class="mb-3">Cấu Hình</h4>
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Màn hình :</td>
                                    <td style="padding-left: 55px">OLED6.7"Super Retina XDR</td>
                                </tr>
                                <tr>
                                    <td>Hệ điều hành :</td>
                                    <td style="padding-left: 55px">iOS 15</td>
                                </tr>
                                <tr>
                                    <td>Camera sau :</td>
                                    <td style="padding-left: 55px">3 camera 12 MP</td>
                                </tr>
                                <tr>
                                    <td>Camera trước :</td>
                                    <td style="padding-left: 55px">12 MP</td>
                                </tr>
                                <tr>
                                    <td>Chip :</td>
                                    <td style="padding-left: 55px">Apple A15 Bionic</td>
                                </tr>
                                <tr>
                                    <td>RAM :</td>
                                    <td style="padding-left: 55px">6 GB</td>
                                </tr>
                                <tr>
                                    <td>Dung lượng lưu trữ :</td>
                                    <td style="padding-left: 55px">128 GB</td>
                                </tr>
                                <tr>
                                    <td>SIM :</td>
                                    <td style="padding-left: 55px" style="padding-left: 55px">1 Nano SIM & 1 eSIM, Hỗ
                                        trợ 5G
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pin, Sạc :</td>
                                    <td style="padding-left: 55px">4352 mAh20 W</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <hr>
                    <div class="tab-content" style="display: grid; grid-template-columns: 1fr 1fr;grid-gap: 12px">
                        <div class="tab-pane fade show active" id="tab-pane-1" style="padding: 66px">
                            <b style="font-size: 20px; color: blueviolet" class="mb-3">Đánh giá</b><br>
                            @if($rating != null)
                                @foreach($rating as $r)
                            <b class="mb-3">{{$r->user_name}}</b><span> {{date('d-m-Y', $r->created_at)}}</span>
                                    @for($i=$r->star;$i>=1;$i--)
                                        <i style="color: gold" class="fas fa-star filled"></i>
                                    @endfor
                            <p>{{$r->content}}</p>
                                @endforeach
                            @else
                                <b style="color: orange" class="mb-3">Chưa có đánh giá nào</b>
                            @endif
                        </div>
                        <div style="padding: 66px">
                            <form id="rating" method="post">
                                <div class="stars">
                                    @for($i=5;$i>=1;$i--)
                                        <input class="star star-{{$i}}" id="star-{{$i}}" type="radio" name="star" value="{{$i}}"/>
                                        <label class="star star-{{$i}}" for="star-{{$i}}"></label>
                                    @endfor
                                </div>
                                <br>
                                <div
                                    style="display: grid; grid-template-columns: 1fr 1fr;grid-gap: 12px ; padding-bottom: 12px">
                                    <input placeholder="Full name" class="form-control" type="text"
                                          name="fullname" value="{{Auth::check() ? Auth::user()->name : ''}}">
                                    <input placeholder="Phone number" class="form-control" type="text"
                                          name="phonenumber" value="{{Auth::check() ? Auth::user()->phone_number : ''}}">
                                </div>
                                <textarea name="content" style="padding-bottom: 100px" class="form-control"></textarea><br>
                                <button id="subRating" class="btn btn-primary">Gửi Đánh Giá</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Sản Phẩm Liên Quan</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($related as $item)
                    <div class="col-sm col-md-6 col-lg ftco-animate">
                        <form action="{{route('addToCart', $item->id)}}" method="post">
                            @csrf
                            <div class="product">
                                <a href="{{route('product.detail', $item->id)}}" class="img-prod"><img class="img-fluid"
                                                                                                       src="{{asset($item->image)}}"
                                                                                                       alt="Colorlib Template">
                                    @if($item->price - $item->price_discount > 0)
                                        <span class="status">-{{round(($item->price - $item->price_discount)/ $item->price * 100, 0)}}%</span>
                                        <div class="overlay"></div>
                                    @endif
                                </a>
                                <div class="text py-3 px-3">
                                    <h3><a href="#">{{$item->name}}</a></h3>
                                    <div class="">
                                        <div class="price" style="font-size: 14px;">
                                            <div class="price" style="font-size: 14px;">
                                                @if($item->price_discount < $item->price)
                                                    <p class="price"><span class="mr-2 price-dc">{{number_format($item->price,0,',',',')}} VNĐ</span><span
                                                            class="price-sale">{{number_format($item->price_discount,0,',',',')}} VNĐ</span>
                                                    </p>
                                                @else
                                                    <p class="price"><span class="price-sale">{{number_format($item->price,0,',',',')}} VNĐ</span>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price"><span style="color: red;"
                                                                   class="price-sale">Đã bán : 99</span></p>
                                        </div>
                                        <div class="rating">
                                            <p class="text-right">
                                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                                <a href="#"><span class="ion-ios-star-outline"></span></a>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="bottom-area d-flex px-3">
                                        <button class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                    class="ion-ios-add ml-1"></i></span></button>
                                        <button href="#" class="buy-now text-center py-2">Buy now<span><i
                                                    class="ion-ios-cart ml-1"></i></span></button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(function () {
            $('.option').on('click', function () {
                let id = $(this).attr('id');
                $('.dfa').css('border', '1px solid #cccccc');
                $('.dfa').css('background-color', 'white');
                $('.dfa').css('color', '#cccccc');
                $('#rad' + id).click();
            })
            $('.attribute').on('change', function () {
                var rdo = $(".attribute");
                let value = [];
                for (var i = 0; i < rdo.length; i++) {
                    if (rdo[i].checked === true) {
                        value.push(rdo[i].value);
                        $('#att' + rdo[i].value).css('border', '1px solid #a61ac8');
                        $('#att' + rdo[i].value).css('background-color', '#a61ac8');
                        $('#att' + rdo[i].value).css('color', 'white');
                    }
                }
                let url = "{{route('getInfoVariant')}}";
                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        value: value,
                        id: {{$product->id}}
                    },
                    success: function (res) {
                        let url = window.location.origin;
                        const format = new Intl.NumberFormat('en');
                        if (res.data.price_discount < res.data.price) {
                            let price = `
                            <span style="text-decoration-line:line-through" class="price-sale">${format.format(res.data.price)} VNĐ</span>
                        <span style="color: red">( -${Math.round((res.data.price - res.data.price_discount) / res.data.price * 100)}% )</span>
                        <p class="price"><span class="price-sale">${format.format(res.data.price_discount)} VNĐ</span>
                        </p>
                            `
                            $('#price').html(price);
                        } else {
                            let price = `
                             <p class="price"><span class="price-sale">${format.format(res.data.price)} VNĐ</span>
                        </p>
                            `
                            $('#price').html(price);
                        }

                        if (res.data.inventory <= 0) {
                            $('#btn-cart').css('background-color: red');
                            let btn = `
                           <div style="background-color: orange">
                                                <button disabled style="width: 100%; cursor: pointer; color: white">CONTACT US</button>
                                            </div>
                            `
                            $('#btn-cart').html(btn);
                        } else {
                            let btn = `
                            <div style="background-color: deepskyblue">
                                                <button style="width: 100%; cursor: pointer; color: white">ADD TO CART</button>
                                            </div>
                            `
                            $('#btn-cart').html(btn);
                        }
                        let avt = `
<a href="${url + '/' + res.data.image}" class="image-popup"><img
                                    src="${url + '/' + res.data.image}"
                                    class="img-fluid"
                                    alt="Colorlib Template" width="700px" height="1200px"></a>`
                        $('#avt').html(avt)

                    },
                    error: function () {
                        alert('error');
                    }
                })
            })

         $(document).on('click','#subRating',function (event){
             event.preventDefault();
             const rating=$('.star:checked').attr('value');
             const name = $("input[name = 'fullname']").val();
             const phone = $("input[name = 'phonenumber']").val();
             const content = $("textarea[name = 'content']").val();
             const product_id = {{$product->id}};
             console.log(name, phone, product_id, content)
             console.log(rating);
             $.ajax({
                 url: "{{route('loadRating')}}",
                 method : 'post',
                 data:{
                     product_id:product_id,
                     name:name,
                     phone:phone,
                     star:rating,
                     content:content
                 },
                 success:function (res){
                     console.log(res)
                     alert('Đánh giá của bạn đang được xét duyệt !')
                 },error:function (e){
                     alert('Bạn cần nhập đầy đủ thông tin !')
                 }
             })
         })

        })
    </script>
@endsection
