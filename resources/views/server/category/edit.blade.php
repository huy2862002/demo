@extends('layouts.server.main')
@section('title', 'Cập Nhật Danh Mục')
@section('title_tab', 'Danh Mục / Cập Nhật')
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

    <form action="{{route('server.category.putEdit',$category->id)}}" method="post">
        @csrf
        @method('put')
        <b>Tên Danh Mục</b>
        <input type="text" class="form-control" name="name" value="{{$category->name}}">
        <br><br>
        <b>Thuộc Danh Mục ?</b>
        <select name="parent_id" class="form-control">
            <!-- ----------- -->
            @if($category->parent_id == 0)
            <option selected value="0">Không Thuộc Danh Mục Nào</option>
            @endif
            <!-- ----------- -->
            @foreach($data_category as $item)
            <!-- ----------- -->
            @if($category->parent_id == $item->id)
            <option selected value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
            @endif
            <!-- ----------- -->
            @if($category->parent_id != $item->id)
            <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
            @endif
            <!-- ----------- -->
            @endforeach
            <!-- ----------- -->
            @if($category->parent_id != 0)
            <option value="0">Không Thuộc Danh Mục Nào</option>
            @endif
        </select>
        <br><br>
        <button class="btn btn-success">Cập Nhật</button>
    </form>
</div>
@endsection 