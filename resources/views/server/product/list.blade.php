@extends('layouts.server.main')
@section('title_tab', 'Danh Sách Sản Phẩm')
@section('content')
    <div id="status_form">
        @if(session()->has('success'))
            <div
                style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                <b>{{session()->get('success')}}</b>
            </div>
        @endif
    </div>
<div class="content" style="padding:0 12px">
    @if(count($list_product) > 0)
    <div class="top" style="display:grid; grid-template-columns:1fr 8fr; grid-gap:31px; margin-bottom: 12px; margin-top: 12px">
        <a href="{{route('server.product.addForm')}}"><button class="btn btn-primary">Add New</button></a>
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
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Category</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Price Discount</th>
                <th scope="col">Inventory</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($list_product as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->slug}}</td>
                @foreach($data_category as $cate)
                @if($item->category_id == $cate->id)
                <td>{{$cate->name}}</td>
                @endif
                @endforeach
                <td><img height="100px" width="100px" src="{{asset($item->image)}}" alt=""></td>
                <td>{{number_format($item->price,0,',',',')}} VNĐ</td>
                <td>{{number_format($item->price_discount,0,',',',')}} VNĐ</td>
                <td>{{$item->inventory}}</td>
                <td><a href="{{route('server.product.addAttribute', $item->id)}}">Thêm Thuộc Tính</a></td>
                <td>
                   <a id="btn-del" href="{{route('server.product.delete', $item->id)}}"><i style="color: red" class="nav-icon fas fa-trash"></i></a>
                </td>
                <td>
                    <a href="{{route('server.product.editForm', $item->id)}}"><i style="color: goldenrod" class="nav-icon fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate">
        {{$list_product->links()}}
    </div>
    @else
    <div class="add" style="text-align: center;color:red; margin-top: 12px">
        <a href="{{route('server.product.addForm')}}"><button class="btn btn-primary">Add New</button></a><br><br>
        <span>Hiện Chưa Có Sản Phẩm Nào !</span>
    </div>
    @endif
</div>

@endsection
@section('script')
<script>
    $(function() {

        function confirm_del(){
            var del = document.querySelectorAll('#btn-del');
            del.forEach(function(item){
                item.onclick = function () {
                    var cfm = confirm("Bạn có chắc chắn muốn xóa sản phẩm này ?");
                    if (cfm == true) {
                        return true;
                    }
                    else return false;
                }
            });
        }
        confirm_del();
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
                 <td>${value.slug}</td>
                <td>${value.cateName}</td>
                <td><img height="100px" width="100px" src="${url + '/' + value.image}" alt=""></td>
                <td>${format.format(value.price)} VNĐ</td>
                <td>${format.format(value.price_discount)} VNĐ</td>
                <td>${value.inventory}</td>
                <td><a href="${url + '/quan-tri/san-pham/them-thuoc-tinh/' + value.id}">Thêm Thuộc Tính</a></td>
                <td>
                    <a id="btn-del" href="${url + '/quan-tri/san-pham/xoa/' + value.id}"><i style="color: red" class="nav-icon fas fa-trash"></i></a>
                </td>
                <td>
                    <a href="${url + '/quan-tri/san-pham/cap-nhat/' + value.id}"><i style="color: goldenrod" class="nav-icon fas fa-edit"></i></a>
                </td>
            </tr>`
            })
            $('#tbody').html(html)
            confirm_del();
        }


    });
</script>
@endsection
