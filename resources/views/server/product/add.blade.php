@extends('layouts.server.main')
@section('title_tab', 'Thêm Sản Phẩm')
@section('content')
    <div id="status_form">
        @if(session()->has('success'))
        <div style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
            <b>{{session()->get('success')}}</b>
        </div>
        @endif
    </div>
    <div class="container" style="max-width:96%">
        <form action="{{route('server.product.postAdd')}}" method="post" enctype="multipart/form-data">
            @csrf
            <b>Name *</b><span id="error_name" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input onkeyup="ChangeToSlug();" value="" id="title" type="text" class="form-control" name="name"><br>
            <b>Slug *</b><span id="error_slug" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input value="" id="slug" type="text" class="form-control" name="slug"><br>
            <b>Image *</b><span id="error_image" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="file" class="form-control" name="image"><br>
            <b>Price *</b><span id="error_price" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="number" class="form-control" name="price"><br>
            <b>Price Discount *</b><span id="error_price_discount"
                                         style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="number" class="form-control" name="price_discount"><br>
            <b>Short Description *</b><span id="error_mtn"
                                            style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="text" class="form-control" name="short_description"><br>
            <b>Product Description *</b><span id="error_mtsp"
                                              style="padding-left: 12px;font-size: 14px; color: red"></span>
            <textarea name="product_description" class="form-control"></textarea><br>
            <b>Category *</b><span id="error_category"
                                   style="padding-left: 12px;font-size: 14px; color: red"></span>

            <select name="category_id" class="form-control">
                <option disabled selected value="0">Chọn Danh Mục</option>
                @if(count($data_category) > 0)
                    @foreach($data_category as $item)
                        <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
                    @endforeach
                @endif
            </select><br>
            <b>Inventory *</b><span id="error_inventory"
                                         style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="number" class="form-control" name="inventory"><br>
            <button id="submit_product" type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
