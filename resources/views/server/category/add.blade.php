@extends('layouts.server.main')
@section('title', 'Thêm Danh Mục')
@section('title_tab', 'Thêm Danh Mục')
@section('content')
    <div id="status_form">
        @if(session()->has('success'))
            <div
                style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                <b>{{session()->get('success')}}</b>
            </div>
        @endif
    </div>
    <div class="content" style="padding: 0 12px;">
        <form action="{{route('server.category.postAdd')}}" method="post">
            @csrf
            <b>Name *</b><span id="error_name" style="padding-left: 12px;font-size: 14px; color: red"></span>
            <input type="text" class="form-control" name="name">
            <br>
            <b>Thuộc Danh Mục ? *</b>
            <select name="parent_id" class="form-control">
                <option selected value="0">Không Thuộc Danh Mục Nào</option>
                @if(count($list_category) > 0)
                    @foreach($list_category as $item)
                        <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
                    @endforeach
                @endif
            </select>
            <br>
            <button class="btn btn-primary" id="submit_cate">Add</button>
        </form>
    </div>
@endsection
