@extends('layouts.web.main')
@section('title', 'Sản Phẩm')
@section('content_banner')
<div class="row">

</div>
@endsection
@section('content')
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-10 order-md-last">
                <div class="row" id="row">
                    @foreach($list_product as $item)
                    <div class="col-sm-6 col-md-6 col-lg-4 ftco-animate">
                        <form action="{{route('addToCart', $item->id)}}" method="post">
                            @csrf
                            <div class="product">
                                <a href="{{route('product.detail', $item->id)}}" class="img-prod"><img class="img-fluid" src="{{asset($item->avatar)}}" alt="Colorlib Template">
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
                <div class="row mt-5">
                    {{$list_product->links()}}
                </div>
            </div>
            <div class="col-md-4 col-lg-2 sidebar">
                @foreach($data_category as $item)
                <div class="sidebar-box-2">
                    @if($item -> parent_id == 0)
                    <h2 class="heading mb-4"><a href="">{{$item->name}}</a></h2>
                    @else
                    <ul>
                        <li><a href="">{{$item->name}}</a></li>
                    </ul>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(function() {

        $('input[name="radioData"]').click(function() {
            let value = $(this).val();
            CallApi(url = "{{route('productData')}}", value)
        });

        function CallApi(url, data) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    data: data
                },
                success: function(res) {
                    console.log(res.data);
                    HandleData(res.data)
                }
            })
        }

        function HandleData(data) {
            let url = window.location.origin;
            const format = new Intl.NumberFormat('en');
            let html = data.map(function(value, key) {
                return `
                <div class="col-sm-6 col-md-6 col-lg-4 ftco-animate">
                        <form action="{{route('addToCart', $item->id)}}" method="post">
                            @csrf
                            <div class="product">
                                <a href="#" class="img-prod"><img class="img-fluid" src="{{asset($item->avatar)}}" alt="Colorlib Template">
                                    @if($item->discount > 0)
                                    <span class="status">-${value.discount}%</span>
                                    <div class="overlay"></div>
                                    @endif
                                </a>
                                <div class="text py-3 px-3">
                                    <h3><a href="#">${value.name}</a></h3>
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
                                        <button type="submit" class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></button>
                                        <button type="button" href="#" class="buy-now text-center py-2">Buy now<span><i class="ion-ios-cart ml-1"></i></span></button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>`
            })
            $('#row').html(html)

        }

    });
</script>
@endsection