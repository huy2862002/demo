@extends('layouts.server.main')
@section('title_tab', 'Cập Nhật Sản Phẩm')
@section('content')
    @if($product)
        <div id="status_form">
            @if(session()->has('success'))
                <div
                    style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                    <b>{{session()->get('success')}}</b>
                </div>
            @endif
        </div>
        <div class="content" style="padding: 0 12px;margin-top: 12px">
            <form action="{{route('server.product.putEdit',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form" style="display:grid; grid-template-columns:1fr 6fr; grid-gap: 12px">

                    <div class="info_left" style="margin-top: 23px">
                        <b>Name *</b><span id="error_name"
                                           style="padding-left: 12px;font-size: 14px; color: red"></span>
                        <input onkeyup="ChangeToSlug();" value="{{$product->name}}" id="title" type="text"
                               class="form-control" name="name"><br>
                        <b>Slug *</b><span id="error_slug"
                                           style="padding-left: 12px;font-size: 14px; color: red"></span>
                        <input value="{{$product->slug}}" value="" id="slug" type="text" class="form-control"
                               name="slug"><br>
                        <img id="image" width="500px" height="500px" src="{{asset($product->image)}}" alt="">
                    </div>
                    <div class="info-right" style="margin-top: 23px">
                        <b>Image *</b>
                        <input type="file" class="form-control" name="image_update"><br>
                        <b>Price *</b><span id="error_price"
                                            style="padding-left: 12px;font-size: 14px; color: red"></span>
                        <input value="{{$product->price}}" type="number" class="form-control" name="price"><br>
                        <b>Price Discount *</b><span id="error_price_discount"
                                                     style="padding-left: 12px;font-size: 14px; color: red"></span>
                        <input value="{{$product->price_discount}}" type="number" class="form-control"
                               name="price_discount"><br>
                        <b>Short Description *</b><span id="error_mtn"
                                                        style="padding-left: 12px;font-size: 14px; color: red"></span>
                        <input value="{{$product->short_description}}" type="text" class="form-control"
                               name="short_description"><br>
                        <b>Product Description *</b><span id="error_mtsp"
                                                          style="padding-left: 12px;font-size: 14px; color: red"></span>
                        <textarea name="product_description"
                                  class="form-control">{{$product->product_description}}</textarea><br>
                        <b>Category *</b>
                        <select name="category_id" class="form-control">
                            @foreach($data_category as $item)
                                @if($product->category_id == $item->id)
                                    <option selected
                                            value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
                                @endif
                                @if($product->category_id != $item->id)
                                    <option
                                        value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
                                @endif
                            @endforeach
                        </select><br>
                        <b>Inventory *</b><span id="error_inventory"
                                                style="padding-left: 12px;font-size: 14px; color: red"></span>
                        <input value="{{$product->inventory}}" type="number" class="form-control" name="inventory"><br>
                        <button id="submit_product" type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('server.product.list')}}">
                            <button type="button" class="btn btn-warning">Cancel</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endsection
@section('script')
    <script>
        $(function () {
            $("input[name = 'image_update']").on('change', function (e) {
                e.preventDefault();
                var input = e.target;
                var reader = new FileReader();
                reader.onload = function () {
                    var dataURL = reader.result;
                    var output = $('#image').attr('src', dataURL);
                }
                reader.readAsDataURL(input.files[0]);
            })
        })
    </script>
@endsection
