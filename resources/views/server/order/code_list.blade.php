@extends('layouts.server.main')
@section('title', 'Mã Giảm Giá')
@section('title_tab', 'Mã Giảm Giá')
@section('content')
<div class="content" style="padding:0 12px">
    @if(session()->has('success'))
        <span class="login-box-msg text-success"> {{session()->get('success')}}</span>
    @endif
    @if(count($code_list) > 0)
    <div class="top" style="display:grid; grid-template-columns:1fr 1fr 8fr; grid-gap:31px">
        <a href="{{route('server.code.addForm')}}"><button class="btn btn-success">Thêm Mới</button></a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">MÃ CODE</th>
                <th scope="col">MỨC GIẢM GIÁ ( % )</th>
                <th scope="col">NGÀY MỞ CODE</th>
                <th scope="col">NGÀY ĐÓNG HẠN</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($code_list as $item)
            <tr>
                </td>
                <td>{{$item->id}}</td>
                <td>{{$item->code}}</td>
                <td>{{$item->discount}}</td>
                <td>{{date('d-m-Y H:i:s', $item->start)}}</td>
                <td>{{date('d-m-Y H:i:s', $item->end)}}</td>
                <td>
                    <form action="" method="post">
                        @csrf
                        @method('delete')
                        <button id="btn-del" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button>
                    </form>
                </td>
                <td>
                    <a href=""><button class="btn btn-warning"><i class="nav-icon fas fa-edit"></i></button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate">
        {{$code_list->links()}}
    </div>
    @else
    <div class="add" style="text-align: center;color:red">
        <span>Hiện Chưa Có Mã Giảm Giá Nào !</span>
    </div>
    @endif
</div>
@endsection
