@extends('layouts.server.main')
@section('title', 'Danh Mục')
@section('title_tab', 'Danh Mục')
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
<div class="content" style="padding: 0 12px;">
    @if(count($list_category) > 0)
    @if(session()->has('success'))
    <li class="login-box-msg text-success"> {{session()->get('success')}}</li>
    @endif
    <div class="top" style="display:grid; grid-template-columns:1fr 1fr 8fr; grid-gap:31px">
        <a href="{{route('server.category.export')}}"><button class="btn btn-info">Export Excel</button></a>

        <a href="{{route('server.category.addForm')}}"><button class="btn btn-success">Thêm Mới</button></a>
        <div class="search" style="display:flex; justify-content:space-between">
            <select class="form-control" name="" id="selectData">
                @foreach($list_category as $item)
                <option value="{{$item->id}}">{{str_repeat('---', $item['level']).$item->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">TÊN DANH MỤC</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($list_category as $item)
            <tr>
                <td>{{$item->id}}</td>
                
                <td>{{str_repeat('---', $item['level']).$item->name}}</td>
                <td>
                    <form action="{{route('server.category.delete', $item->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button id="btn-del" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button>
                    </form>
                </td>

                <td>
                    <a href="{{route('server.category.editForm', $item->id)}}"><button class="btn btn-warning"><i class="nav-icon fas fa-edit"></i></button></a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    @else
    <div class="add" style="text-align: center;color:red">
        <a href="{{route('server.category.addForm')}}"><button class="btn btn-success" type="button">Thêm Mới</button></a><br><br>
        <span>Hiện Chưa Có Danh Mục Nào !</span>
    </div>
    @endif
</div>
@endsection
@section('script')
<script>
    $(function() {
        $('#selectData').on('click', function() {
            let value = $(this).val();
            CallApi(url = "{{route('categoryData')}}", value)
        })

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

        function CallApi(url, data) {
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    data: data
                },
                success: function(res) {
                    HandleData(res.data);
                }
            })
        }

        function HandleData(data) {
            let url = window.location.origin;

            let html = data.map(function(value) {
                let call_ngayTao = new Date('YY-MM-DD', value.ngayCapNhat);

                console.log(call_ngayTao)
                return `
                        <tr>
                <td>${value.id}</td>
                <td>${'---'.repeat(value.level) + value.name}</td>
                <td>
                    <form action="${url + '/quan-tri/danh-muc/xoa/' + value.id}" method="post">
                    @csrf
                        @method('delete')
                        <button id="btn-del" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button>
                    </form>
                </td>
                <td>
                    <a href="${url + '/quan-tri/danh-muc/cap-nhat/' + value.id}"><button class="btn btn-warning"><i class="nav-icon fas fa-edit"></i></button></a>
                </td>
            </tr>`
            })
            $('#tbody').html(html)

        }
    });
</script>
@endsection