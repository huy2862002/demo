@extends('layouts.server.main')
@section('title', 'Shipping Fee')
@section('title_tab', 'Shipping Fee')
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
        @if(count($ship_list) > 0)
            <div class="top"
                 style="display:grid; grid-template-columns:1fr 8fr; grid-gap:31px; margin-bottom: 12px; margin-top: 12px">
                <a href="{{route('server.ship.addForm')}}">
                    <button class="btn btn-primary">Thêm Mới</button>
                </a>

            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Province / City</th>
                    <th scope="col">District</th>
                    <th scope="col">Ship Fee</th>
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
                        <td>{{number_format($item->ship_fee,0,',',',')}} VNĐ</td>
                        <td>
                            <form action="" method="post">
                                @csrf
                                @method('delete')
                                <button id="btn-del" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="">
                                <button class="btn btn-warning"><i class="nav-icon fas fa-edit"></i></button>
                            </a>
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

