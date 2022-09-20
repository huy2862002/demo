@extends('layouts.server.main')
@section('title', 'Thêm Shipping Fee')
@section('title_tab', 'Shipping Fee / Thêm Mới')
@section('content')
<div class="content" style="padding: 0 12px;">
  <div class="errors" style="text-align: center;">
    @if(session()->has('error'))
    <span class="login-box-msg text-danger"> {{session()->get('error')}}</span>
    @endif
  </div>
    <span id="error_code" style="font-size: 14px; color: red">Lưu ý : Chỉ nhận file Excel</span>
  <form action="{{route('server.ship.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control" required><br>
    <button class="btn btn-info">Import with Excel</button>
  </form>
</div>
@endsection
