@extends('layouts.server.main')
@section('title', 'Mã Giảm Giá')
@section('title_tab', 'Mã Giảm Giá')
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
    @if(count($code_list) > 0)
    <div class="top" style="display:grid; grid-template-columns:1fr 8fr; grid-gap:31px; margin-bottom: 12px; margin-top: 12px">
    <a href="{{route('server.code.addForm')}}"><button class="btn btn-primary">Thêm Mới</button></a>
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
                        <a id="btn-del" href="{{route('server.code.delete', $item->id)}}"><i style="color: red;" class="nav-icon fas fa-trash"></i></a>
                </td>
                <td>
                    <a href=""><i style="color: goldenrod;" class="nav-icon fas fa-edit"></i></a>
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
@section('script')
<script>
    $(function() {
        var del = document.querySelectorAll('#btn-del');
        del.forEach(function(item){
            item.onclick = function () {
                var cfm = confirm("Sau khi xóa danh mục các sản phẩm của danh mục này cũng sẽ bị xóa. Bạn có chắc chắn xóa không ?");
                if (cfm == true) {
                    return true;
                }
                else return false;
            }
        });
    });
</script>
@endsection