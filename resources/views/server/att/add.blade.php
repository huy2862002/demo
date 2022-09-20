@extends('layouts.server.main')
@section('title_tab', 'Thêm Thuộc Tính Sản Phẩm')
@section('content')
    <div id="status_form">
        @if(session()->has('success'))
            <div style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                <b>{{session()->get('success')}}</b>
            </div>
        @endif
    </div>
    <div class="container" style="max-width:96%">
        <form action="{{route('server.att.postAdd')}}" method="post" enctype="multipart/form-data">
            @csrf
            <b>Name *</b><span id="error_att_name"
                               style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="text" class="form-control" name="att_name"><br>
            <b>Style *</b><span id="error_visual"
                                style="padding-left: 12px;font-size: 14px; color: red"></span>
            <select class="form-control" name="visual">
                <option value="text">Text</option>
                <option disabled value="image">Image</option>
                <option disabled value="color">Color</option>
            </select><br>
            <b>Type *</b><span id="error_visual"
                               style="padding-left: 12px;font-size: 14px; color: red"></span>
            <select class="form-control" name="type">
                <option value="0">Nhập giá trị</option>
                <option value="1">Chọn một giá trị</option>
                <option value="2">Chọn nhiều giá trị</option>
            </select><br>
            <button id="submit_att" type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $("input[name = 'att_name']").on('keyup', function () {
            if ($(this).val().trim() != '') {
                let error = ``;
                $('#error_att_name').html(error);
            }
        })
        $(function () {
            $('#submit_att').on('click', function () {
                let check = true;
                if ($("input[name = 'att_name']").val().trim() == '') {
                    let error = `Vui lòng nhập tên thuộc tính`;
                    $('#error_att_name').html(error);
                    check = false;
                }
                if (check == false) {
                    let error = `<div style="border: 1px solid #f64848; background-color: #f64848;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
        <b>Error !</b>
    </div>`
                    $('#status_form').html(error);
                }
                return check;
            })
        })
    </script>
@endsection
