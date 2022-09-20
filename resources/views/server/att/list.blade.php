@extends('layouts.server.main')
@section('title_tab', 'Danh Sách Thuộc Tính')
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
        @if(count($list_att) > 0)
            <div class="top" style="display:grid; grid-template-columns:1fr 8fr; grid-gap:31px; margin-bottom: 12px; margin-top: 12px">
                <a href="{{route('server.att.addForm')}}"><button class="btn btn-primary">Add New</button></a>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Style</th>
                    <th scope="col">Type</th>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody id="tbody">
                @foreach($list_att as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->visual}}</td>
                        <td>{{config('type_attribute.'.$item->type)}}</td>
                        <td>
                            <a href="{{route('server.att.option', $item->id)}}"><i class="nav-icon fas fa-book"></i></a>
                        </td>
                        <td>
                            <a id="btn-del" href="{{route('server.att.delete', $item->id)}}"><i style="color: red" class="nav-icon fas fa-trash"></i></a>
                        </td>
                        <td>
                            <a href="{{route('server.att.editForm', $item->id)}}"><i style="color: goldenrod" class="nav-icon fas fa-edit"></i></a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        @else
            <div class="add" style="text-align: center;color:red; margin-top: 12px">
                <a href="{{route('server.att.addForm')}}"><button class="btn btn-primary" type="button">Thêm Mới</button></a><br><br>
                <span>Hiện chưa có thuộc tính nào !</span>
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
                    var cfm = confirm("Bạn có chắc chắn xóa thuộc tính này không ?");
                    if (cfm == true) {
                        return true;
                    }
                    else return false;
                }
            });
            /* $('#checkAll').on('click', function() {
                var checkboxes = document.querySelectorAll('input[name="check"]');
                if ($(this).prop("checked") == true) {
                    for (var checkbox of checkboxes) {
                        checkbox.checked = this.checked;
                    }
                } else if ($(this).prop("checked") == false) {
                    for (var checkbox of checkboxes) {
                        checkbox.checked = this.unchecked;
                    }
                }
            }); */
        });
    </script>
@endsection
