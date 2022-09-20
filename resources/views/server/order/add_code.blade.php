@extends('layouts.server.main')
@section('title', 'Thêm Mã Code')
@section('title_tab', 'Mã Code / Thêm Mới')
@section('content')
    <div class="content" style="padding: 0 12px;">
        <div class="errors" style="text-align: center;">
            @if(session()->has('error'))
                <span class="login-box-msg text-danger"> {{session()->get('error')}}</span>
            @endif
        </div>
        <form action="{{route('server.code.postAdd')}}" method="post">
            @csrf
            <b>Mã Code</b><span id="error_code" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="text" class="form-control" name="code" value="{{old('code') ? old('code') : ''}}"> <br><br>
            <b>Mức Giảm</b><span id="error_dis" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="text" class="form-control" name="discount"
                   value="{{old('discount') ? old('discount') : ''}}"><br><br>
            <b>Số Lượng</b><span id="error_qty" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="number" class="form-control" name="quantity"
                   value="{{old('quantity') ? old('quantity') : ''}}"><br><br>
            <b>Ngày Mở Code</b><span id="error_start" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="datetime-local" class="form-control" name="start"> <br><br>
            <b>Ngày Đóng Hạn</b><span id="error_end" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="datetime-local" class="form-control" name="end"> <br><br>
            <button id="submit_code" class="btn btn-success">Thêm Mới</button>
        </form>
    </div>
@endsection

