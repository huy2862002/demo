@extends('layouts.web.main')
@section('title', 'Chi Tiết Sản Phẩm')
@section('content_banner')
<div class="row">

</div>
@endsection

@section('content')
<section class="ftco-section">
    <div class="container">
        <form action="{{route('addToCart', $product->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{asset($product->avatar)}}" class="image-popup"><img src="{{asset($product->avatar)}}" class="img-fluid" alt="Colorlib Template"></a>
                </div>

                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{$product->name}}</h3>
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
                            <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Đánh giá</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Đã bán</span></a>
                        </p>
                    </div>
                    <p class="price"><span>{{number_format($product->price - $product->price * $product->discount / 100 , 0 , ',', ',')}} VNĐ</span></p>
                    <p>{{$product->moTaNgan}}</p>
                    </p>
                    <div class="row mt-4">
                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="ion-ios-remove"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="ion-ios-add"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                    </div>
                    <button>Add to Cart</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row px-xl-5">
        <div class="col">
            <div class="bg-light p-30">
                <div class="nav nav-tabs mb-4">
                    <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Thông Tin Thêm</a>
                    <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Đánh Giá</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1" style="padding-left: 12px;">
                        <h4 class="mb-3">{{$product->name}}</h4>
                        <p>{{$product->moTaSP}}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2" style="padding-left: 12px;">
                        <h4 class="mb-3">Cấu Hình</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>

                    </div>
                    <div class="tab-pane fade" id="tab-pane-3" style="padding-left: 12px;">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">Tổng 1 đánh giá cho {{$product->name}}</h4>
                                <div class="media mb-4">
                                    <img src="{{asset('web/images/icon-user.png')}}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6><small> Nguyễn Quang Huy <i>{{date('d-m-Y')}}</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>hahhaha</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Đánh Giá Sản Phẩm</h4>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <textarea name="content" id="message" cols="30" rows="5" class="form-control">{{old('content')}}</textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Gửi Đánh Giá" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>

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
                        <a href="{{route('product.detail',$item->id)}}" class="img-prod"><img class="img-fluid" src="{{asset($item->avatar)}}" alt="Colorlib Template">
                            @if($item->discount > 0)
                            <span class="status">-{{$item->discount}}%</span>
                            <div class="overlay"></div>
                            @endif
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">{{$item->name}}</a></h3>
                            <div class="">
                                <div class="price" style="font-size: 14px;">
                                    @if($item->discount > 0)
                                    <p class="price"><span class="mr-2 price-dc">{{number_format($item->price,0,',',',')}} VNĐ</span><span class="price-sale">{{number_format($item->price,0,',',',')}} VNĐ</span></p>
                                    @else
                                    <p class="price"><span class="price-sale">{{number_format($item->price,0,',',',')}} VNĐ</span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span style="color: red;" class="price-sale">Đã bán : 99</span></p>
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
                                <button class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></button>
                                <button href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></button>
                            </p>

                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });

    });
</script>
@endsection