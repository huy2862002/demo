@extends('layouts.server.main')
@section('title', 'Thêm Shipping Fee')
@section('title_tab', 'Shipping Fee / Thêm Mới')
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
    <b>Tên Tỉnh / Thành Phố</b>
    <input type="text" class="form-control" name="name">
    <br><br>
    <b>Tên Quận / Huyện / Thị Xã</b>
    <input type="text" class="form-control" name="name">
    <br><br>
    <b>Trọng Số</b>
    <input type="text" class="form-control" name="name">
    <br><br>
    <button class="btn btn-success">Thêm Mới</button>
  </form><br><br>
  <form action="{{route('server.ship.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control" required><br>
    <button class="btn btn-info">Import with Excel</button>
  </form>
</div>
@endsection