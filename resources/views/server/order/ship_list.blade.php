@extends('layouts.server.main')
@section('title', 'Shipping Fee')
@section('title_tab', 'Shipping Fee')
@section('content')
<div class="content" style="padding:0 12px">
    @if(count($ship_list) > 0)
    <div class="top" style="display:grid; grid-template-columns:1fr 1fr 8fr; grid-gap:31px">

        <a href="{{route('server.ship.addForm')}}"><button class="btn btn-success">Thêm Mới</button></a>
        
    </div>
    <table class="table table-striped">
        <thead>
            <tr>

                <th scope="col">ID</th>
                <th scope="col">TỈNH / THÀNH PHỐ</th>
                <th scope="col">QUẬN / HUYỆN / THỊ XÃ</th>
                <th scope="col">TRỌNG SỐ</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($ship_list as $item)
            <tr>
                </td>
                <td>{{$item->shipId}}</td>
                <td>{{$item->provinceName}}</td>
                <td>{{$item->districtName}}</td>
                <td>{{$item->weight}}</td>
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
        {{$ship_list->links()}}
    </div>
    @else
    <div class="add" style="text-align: center;color:red">
        <span>Hiện Chưa Có Bảng Ship !</span>
    </div>
    @endif
</div>
@endsection
<script>

</script>