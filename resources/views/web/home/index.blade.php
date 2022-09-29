@extends('layouts.web.main')
@section('content_banner')
<div class="row">
    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18 text-center">
            <div class="text">
                <strong class="number" data-number="{{isset($count_product) ? $count_product : 0}}">0</strong>
                <span>Product</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18 text-center">
            <div class="text">
                <strong class="number" data-number="20">0</strong>
                <span>Rating</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
        <div class="block-18 text-center">
            <div class="text">
                <strong class="number" data-number="{{isset($count_user) ? $count_user : 0}}">0</strong>
                <span>Account</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">New Product</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($latest_product as $item)
            <div class="col-sm col-md-12 col-lg ftco-animate">
                <form action="{{route('addToCart', $item->id)}}" method="post">
                    @csrf
                    <div class="product">
                        <a href="{{route('product.detail', $item->id)}}" class="img-prod"><img class="img-fluid" src="{{asset($item->image)}}" alt="Colorlib Template">
                            @if($item->price - $item->price_discount > 0)
                            <span class="status">-{{round(($item->price - $item->price_discount)/ $item->price * 100, 0)}}%</span>
                            <div class="overlay"></div>
                            @endif
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">{{$item->name}}</a></h3>
                            <div class="">
                                <div class="price" style="font-size: 14px;">
                                    @if($item->price_discount < $item->price)
                                        <p class="price"><span class="mr-2 price-dc">{{number_format($item->price,0,',',',')}} VNĐ</span><span class="price-sale">{{number_format($item->price_discount,0,',',',')}} VNĐ</span></p>
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
    </div>
</section>

<section class="ftco-section ftco-choose ftco-no-pb ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-8 d-flex align-items-stretch">
                <div class="img" style="background-image: url(https://bgr.com/wp-content/uploads/2022/01/iphone-14-pro-concept-5.jpg?quality=82&strip=all);"></div>
            </div>
            <div class="col-md-4 py-md-5 ftco-animate">
                <div class="text py-3 py-md-5">
                    <h3 class="mb-4">Ra Mắt Điện Thoại iPhone 14</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p><a href="#" class="btn btn-white px-4 py-3">Read More</a></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 order-md-last d-flex align-items-stretch">
                <div class="img img-2" style="background-image: url(https://gadgettendency.com/wp-content/uploads/2021/09/Microsoft-has-unveiled-its-top-of-the-line-Surface-Laptop-Studio-Intel-Core.jpg);"></div>
            </div>
            <div class="col-md-7 py-3 py-md-5 ftco-animate">
                <div class="text text-2 py-md-5">
                    <h3 class="mb-4">Máy Tính Có Cấu Hình Mạnh Nhất Hiện Tại ?</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p><a href="#" class="btn btn-white px-4 py-3">Read More</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Popular Product</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($popular_product as $item)
            <div class="col-sm col-md-6 col-lg ftco-animate">
                <form action="{{route('addToCart', $item->id)}}" method="post">
                    @csrf
                    <div class="product">
                        <a href="{{route('product.detail', $item->id)}}" class="img-prod"><img class="img-fluid" src="{{asset($item->image)}}" alt="Colorlib Template">
                            @if($item->price - $item->price_discount > 0)
                                <span class="status">-{{round(($item->price - $item->price_discount)/ $item->price * 100, 0)}}%</span>
                                <div class="overlay"></div>
                            @endif
                        </a>
                        <div class="text py-3 px-3">
                            <h3><a href="#">{{$item->name}}</a></h3>
                            <div class="">
                                <div class="price" style="font-size: 14px;">
                                    @if($item->price_discount < $item->price)
                                    <p class="price"><span class="mr-2 price-dc">{{number_format($item->price,0,',',',')}} VNĐ</span><span class="price-sale">{{number_format($item->price_discount,0,',',',')}} VNĐ</span></p>
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
    </div>
</section>
@endsection
