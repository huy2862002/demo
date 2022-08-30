@extends('layouts.server.main')
@section('title', 'Cập Nhật Sản Phẩm')
@section('title_tab', 'Sản Phẩm / Cập Nhật')
@section('content')
<div class="content" style="padding: 0 12px;">
    @if($errors ->any())
    <div class="errors">
        <ul class="form">
            @foreach($errors->all() as $error)
            <li style="text-align: left;" class="login-box-msg text-danger">{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
  
    <form action="{{route('server.product.putEdit',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
       <div class="form" style="display:grid; grid-template-columns:1fr 6fr">
       <div class="avatar">
        <img width="500px" height="500px" src="{{asset($product->avatar)}}" alt="">
       </div>
       <div class="info">
       <b>Tên Sản Phẩm</b>
        <input type="text" class="form-control" name="name" value="{{$product->name ? $product->name : old('name')}}">
        <br>
        <b>Ảnh Sản Phẩm</b>
        <input type="file" class="form-control" name="avatar">
        <br>
        <b>Giá</b>
        <input type="number" class="form-control" name="price" value="{{$product->price ? $product->price : old('price')}}">
        <br>
        <b>Mô Tả Ngắn</b>
        <input type="text" class="form-control" name="moTaNgan" value="{{$product->moTaNgan ? $product->moTaNgan :old('moTaNgan')}}">
        <br>
        <b>Mô Tả Sản Phẩm</b>
        <textarea name="moTaSP" class="form-control">{{$product->moTaSP ? $product->moTaSP : old('moTaSP')}}</textarea>
        <br>
        <b>Danh Mục</b>
        <select name="category_id" class="form-control">
            <!-- ----------- -->
            @foreach($data_category as $item)
            <!-- ----------- -->
            @if($product->category_id == $item->id)
            <option selected value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
            @endif
            <!-- ----------- -->
            @if($product->category_id != $item->id)
            <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
            @endif
            <!-- ----------- -->
            @endforeach
            <!-- ----------- -->
        </select>
        <br><br>
        <button class="btn btn-success">Cập Nhật</button>
       </div>
    </div>
    </form>

</div>

@endsection