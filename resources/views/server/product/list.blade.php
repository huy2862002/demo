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
    @if(count($list_product) > 0)
    
    @if(session()->has('success'))
    <li class="login-box-msg text-success"> {{session()->get('success')}}</li>
    @endif
    <div class="top" style="display:grid; grid-template-columns:1fr 1fr 7fr; grid-gap:31px">

    <a href="{{route('server.product.export')}}"><button class="btn btn-info">Export Excel</button></a>

        <a href="{{route('server.product.addForm')}}"><button class="btn btn-success">Thêm Mới</button></a>
        <div class="search" style="display:flex; justify-content:space-between">
            <select class="form-control" name="" id="selectData">
                @foreach($data_category as $item)
                <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">TÊN SẢN pHẨM</th>
                <th scope="col">TÊN DANH MỤC</th>
                <th scope="col">ẢNH</th>
                <th scope="col">GIÁ</th>
                <th scope="col">MÔ TẢ NGẮN</th>
                <th scope="col">MÔ TẢ SẢN PHẨM</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($list_product as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                @foreach($data_category as $cate)
                @if($item->category_id == $cate->id)
                <td>{{$cate->name}}</td>
                @endif
                @endforeach
                <td><img height="100px" width="100px" src="{{asset($item->avatar)}}" alt=""></td>
                <td>{{number_format($item->price,0,',',',')}} VNĐ</td>
                <td>{{$item->moTaNgan}}</td>
                <td>{{$item->moTaSP}}</td>
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
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate">
        {{$list_product->links()}}
    </div>
    @else
    <div class="add" style="text-align: center;color:red">
        <a href="{{route('server.product.addForm')}}"><button class="btn btn-success" type="button">Thêm Mới</button></a><br><br>
        <span>Hiện Chưa Có Sản Phẩm Nào !</span>
    </div>
    @endif
</div>

@endsection
@section('script')
<script>
    $(function() {

        $('#selectData').on('click', function() {
            let value = $(this).val();
            CallApi(url = "{{route('productData')}}", value)
        })

        function CallApi(url, data) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    data: data
                },
                success: function(res) {
                    console.log(res.data);
                    HandleData(res.data)
                }
            })
        }

        function HandleData(data) {
            let url = window.location.origin;
            const format = new Intl.NumberFormat('en');
            let html = data.map(function(value, key) {
                return `
                <tr>
                <td>${value.id}</td>
                <td>${value.name}</td>
                <td>${value.cateName}</td>
                <td><img height="100px" width="100px" src="${url + '/' + value.avatar}" alt=""></td>
                <td>${format.format(value.price)} VNĐ</td>
                <td>${value.moTaNgan}</td>
                <td>${value.moTaSP}</td>
                <td>
                    <form action="${url + '/quan-tri/san-pham/xoa/' + value.id}" method="post">
                        @csrf
                        @method('delete')
                        <button id="btn-del" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button>
                    </form>
                </td>
                <td>
                    <a href="${url + '/quan-tri/san-pham/cap-nhat/' + value.id}"><button class="btn btn-warning"><i class="nav-icon fas fa-edit"></i></button></a>
                </td>
            </tr>`
            })
            $('#tbody').html(html)

        }

    });
</script>
@endsection