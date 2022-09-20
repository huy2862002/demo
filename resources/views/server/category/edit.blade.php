@extends('layouts.server.main')
@section('title_tab', 'Cập Nhật Danh Mục')
@section('content')
    @if($category)
        <div id="status_form">
            @if(session()->has('success'))
                <div
                    style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                    <b>{{session()->get('success')}}</b>
                </div>
            @endif
        </div>
        <div class="content" style="padding: 0 12px;margin-top: 12px">
            <form action="{{route('server.category.putEdit',$category->id)}}" method="post">
                @csrf
                @method('put')
                <b>Name *</b><span id="error_name" style="padding-left: 12px;font-size: 14px; color: red"></span>
                <input type="text" class="form-control" name="name" value="{{$category->name}}"><br>
                <b>Thuộc Danh Mục ? *</b>
                <select name="parent_id" class="form-control">
                    @if($category->parent_id == 0)
                        <option selected value="0">Không Thuộc Danh Mục Nào</option>
                    @endif
                    @foreach($data_category as $item)
                        @if($category->parent_id == $item->id)
                            <option selected
                                    value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
                        @endif
                        @if($category->parent_id != $item->id)
                            <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
                        @endif
                    @endforeach
                    @if($category->parent_id != 0)
                        <option value="0">Không Thuộc Danh Mục Nào</option>
                    @endif
                </select>
                <br><br>
                <button id="submit_cate" class="btn btn-primary">Update</button>
                <a href="{{route('server.category.list')}}">
                    <button type="button" class="btn btn-warning">Cancel</button>
                </a>
            </form>
        </div>
    @endif
@endsection
