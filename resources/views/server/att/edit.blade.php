@extends('layouts.server.main')
@section('title_tab', 'Cập Nhật Thuộc Tính')
@section('content')
    <div id="status_form">
        @if(session()->has('success'))
            <div
                style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                <b>{{session()->get('success')}}</b>
            </div>
        @endif
    </div>
    <div class="container" style="max-width:96%">
        <form action="{{route('server.att.putEdit', $att->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <b>Name *</b><span id="error_att_name"
                               style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input value="{{$att->name}}" type="text" class="form-control" name="att_name"><br>
            <b>Style *</b><span id="error_visual"
                                style="padding-left: 12px;font-size: 14px; color: red"></span>
            <select class="form-control" name="visual">
                @if($att->visual == 'text')
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                    <option value="color">Color</option>
                @elseif($att->visual == 'image')
                    <option value="image">Image</option>
                    <option value="text">Text</option>
                    <option value="color">Color</option>
                @else
                    <option value="color">Color</option>
                    <option value="text">Text</option>
                    <option value="image">Image</option>
                @endif
            </select><br>
            <b>Type *</b><span id="error_visual"
                               style="padding-left: 12px;font-size: 14px; color: red"></span>
            <select class="form-control" name="type">
                <option selected
                        value="{{$att->type == 1 ? $att->type : 2}}">{{$att->type == 1 ? 'Một Value' : 'Nhiều Value'}}</option>
                <option
                    value="{{$att->type == 1 ? 2 : $att->type}}">{{$att->type == 1 ? 'Nhiều Value' : 'Một Value'}}</option>
            </select><br>
            <button id="submit_att" type="submit" class="btn btn-primary">Update</button>
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
