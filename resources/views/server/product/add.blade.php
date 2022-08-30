@extends('layouts.server.main')
@section('title', 'Thêm Sản Phẩm')
@section('title_tab', 'Sản Phẩm / Thêm Mới')
@section('content')

@section('content')

<div class="container" style="max-width:96%">
    @if($errors ->any())
    <div class="errors">
        <ul class="form">
            @foreach($errors->all() as $error)
            <li style="text-align: left;" class="login-box-msg text-danger">{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
   
    <form action="{{route('server.product.postAdd')}}" method="post" enctype="multipart/form-data">
        @csrf
        <b>Tên Sản Phẩm</b>
        <input type="text" class="form-control" name="name" value="{{old('name')}}">
        <br>
        <b>Ảnh Sản Phẩm</b>
        <input type="file" class="form-control" name="avatar">
        <br>
        <b>Giá</b>
        <input type="number" class="form-control" name="price" value="{{old('price')}}">
        <br>
        <b>Mô Tả Ngắn</b>
        <input type="text" class="form-control" name="moTaNgan" value="{{old('moTaNgan')}}">
        <br>
        <b>Mô Tả Sản Phẩm</b>
        <textarea name="moTaSP" class="form-control">{{old('moTaSP')}}</textarea>
        <br>
        <b>Danh Mục</b>
        <select name="category_id" class="form-control">
            @foreach($data_category as $item)
            <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="btn btn-success">Thêm Mới</button>
        <button type="reset" class="btn btn-warning">Nhập Lại</button>
    </form>

</div>

@endsection