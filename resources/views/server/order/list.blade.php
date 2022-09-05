@extends('layouts.server.main')
@section('title', 'Sản Phẩm')
@section('title_tab', 'Sản Phẩm')
@section('search')
<li class="nav-item">
    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
    </a>
    <div class="navbar-search-block">
        <form class="form-inline" method="post" action="">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="keyWord">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</li>
@endsection

@section('content')
<div class="content" style="padding:0 12px">
    @if(count($list_order) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
               
                <th scope="col">ID</th>
                <th scope="col">TÊN KHÁCH HÀNG</th>
                <th scope="col">SỐ ĐIỆN THOẠI</th>
                <th scope="col">TỔNG TIỀN</th>
                <th scope="col">ĐỊA CHỈ</th>
                <th scope="col">TRẠNG THÁI</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($list_order as $item)
            <tr>
                </td>
                <td>{{$item->id}}</td>
                <td>{{$item->user_name}}</td>
                <td>{{$item->phone_number}}</td>
                <td>{{number_format($item->total_money,0,',',',')}}</td>
                <td>{{$item->address}} - {{$item->districtName}} - {{$item->provinceName}}</td>
                <td>{{config('orderStatus.'.$item->status) }}</td>
                <td>
                    <form action="{{route('server.product.delete', $item->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button id="btn-del" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button>
                    </form>
                </td>
                <td>
                    <a href="{{route('server.product.editForm', $item->id)}}"><button class="btn btn-warning"><i class="nav-icon fas fa-edit"></i></button></a>
                </td>
                <td>
                   <a href="{{route('server.order.detail', $item->id)}}"> <button id="detail" type="button" class="btn btn-info"><i class="nav-icon fas fa-search"></i></button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate">
        {{$list_order->links()}}
    </div>
    @else
    <div class="add" style="text-align: center;color:red">
        <span>Hiện Chưa Có Đơn Hàng Nào !</span>
    </div>
    @endif
</div>
@endsection
<script>

</script>