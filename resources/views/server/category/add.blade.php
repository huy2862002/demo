@extends('layouts.server.main')
@section('title', 'Thêm Danh Mục')
@section('title_tab', 'Danh Mục / Thêm Mới')
@section('content')
<div class="content" style="padding: 0 12px;">

  <div class="errors" style="text-align: center;">
    @if($errors ->any())
    @foreach($errors->all() as $error)
    <span style="text-align: left;" class="login-box-msg text-danger">{{$error}}</span>
    @endforeach
    @endif
    @if(session()->has('error'))
    <span class="login-box-msg text-danger"> {{session()->get('error')}}</span>
    @endif
  </div>


  <form action="{{route('server.category.postAdd')}}" method="post">
    @csrf
    <b>Tên Danh Mục</b>
    <input type="text" class="form-control" name="name">
    <br><br>
    <b>Thuộc Danh Mục ?</b>
    <select name="parent_id" class="form-control">
      <option selected value="0">Không Thuộc Danh Mục Nào</option>
      @if(count($list_category) > 0)
      @foreach($list_category as $item)
      <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
      @endforeach
      @endif
    </select>
    <br><br>
    <button class="btn btn-success">Thêm Mới</button>
  </form><br><br>
  <form action="{{route('server.category.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control" required><br>
    <button class="btn btn-info">Import with Excel</button>
  </form>
</div>
@endsection