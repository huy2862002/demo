@extends('layouts.server.main')
@section('title_tab', 'Danh Sách Giá Trị Thuộc Tính')
@section('content')
    <div id="status_form">
        @if(session()->has('success'))
            <div
                style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                <b>{{session()->get('success')}}</b>
            </div>
        @endif
    </div>
    <div class="content" style="padding: 0 12px; margin-top: 12px">
            <h5>{{$att->name}}</h5>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Label</th>
                    <th scope="col">Value</th>
                    <th scope="col"> <button type="button" style="visibility: hidden">Add</button>#</th>
                </tr>
                </thead>
                <tbody id="tbody">
                @foreach($opt as $item)
                    <tr>
                        <td>
                            <input disabled name="label" class="form-control" value="{{$item->label}}">
                        </td>
                        <td>
                            @if($att->visual == 'image')
                                <div style="display: grid; grid-template-columns: 1fr 8fr">
                                    <img width="66px" height="66px" src="{{asset($item->value)}}">
                                    <input disabled name="value" class="form-control" type="file">
                                </div>
                            @elseif($att->visual == 'color')
                                <div style="display: grid; grid-template-columns: 1fr 8fr">
                                    <div style="width: 66px; height: 66px; background-color: {{$item->value}}"></div>
                                    <input disabled name="value" class="form-control" value="{{$item->value}}" type="color">
                                </div>
                            @else
                                <input disabled name="value" class="form-control" value="{{$item->value}}" type="text">
                            @endif
                        </td>
                        <td>
                            <button type="button" style="visibility: hidden">Add</button>
                            <a id="btn-del" href="{{route('server.att.delOption', $item->id)}}"><i style="color: red"
                                                                                                class="nav-icon fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if( $att->type !=0)
                <tbody>
                <tr>
                    <form method="post" id="form" enctype="multipart/form-data">
                        <td>
                            <input name="att_id" class="form-control" value="{{$att->id}}" type="hidden">
                            <input name="label_add" class="form-control">
                        </td>
                        <td>
                            @if($att->visual == 'image')
                                <div style="display: grid; grid-template-columns: 1fr 8fr">
                                    <img id="review_image" width="66px" height="66px">
                                    <input name="value_image" class="form-control" type="file">
                                </div>
                            @elseif($att->visual == 'color')
                                <div style="display: grid; grid-template-columns: 1fr 8fr">
                                    <div id="review_color" style="width: 66px; height: 66px; background-color: #000000"></div>
                                    <input name="value_color" class="form-control" type="color">
                                </div>
                            @else
                                <input name="value_text" class="form-control" type="text">
                            @endif
                        </td>
                        <td>
                            <button id="sbmt" style="visibility: hidden">Add</button>
                            <span id="{{$att->id}}" class="add_att" style="cursor: pointer"> <i style="color: goldenrod"
                                                                                                class="nav-icon far fa-plus-square"></i></span>
                        </td>
                    </form>
                </tr>
                </tbody>
                @else
                <span style="color: red">Danh mục có type nhập value. Vui lòng thêm trong chức năng tạo biến thể sản phẩm</span>
                @endif
            </table>
    </div>
@endsection
@section('script')
<script>
    $(function (){
        function confirm_form() {
            var del = document.querySelectorAll('#btn-del');
            del.forEach(function (item) {
                item.onclick = function () {
                    var cfm = confirm("Bạn có chắc chắn xóa thuộc tính này không ?");
                    if (cfm == true) {
                        return true;
                    } else return false;
                }
            });
        }

        confirm_form();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#form').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: "{{route('addOption')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (res) => {
                    RenderData(res.data);
                },
                error: function (data) {
                    let error = `<div style="border: 1px solid #f64848; background-color: #f64848;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
        <b>Error . File không phù hợp !</b>
    </div>`
                    $('#status_form').html(error);
                }
            });

            function RenderData(data) {
                let url = window.location.origin;
                if ('{{$att->visual}}' == 'color') {
                    let render = `
                <tr>
                        <td>
                            <input disabled name="label" class="form-control" value="${data.label}">
                        </td>
                        <td>
                    <div style="display: grid; grid-template-columns: 1fr 8fr">
                        <div style="width: 66px; height: 66px; background-color: ${data.value}"></div>
                                    <input disabled name="value" class="form-control" value="${data.value}" type="color">
                                </div>
                    </td>
                    <td>
                        <button type="button" style="visibility: hidden">Add</button>
                        <a id="btn-del" href="${url + '/quan-tri/thuoc-tinh/xoa-option/' + data.id}"><i style="color: red" class="nav-icon fas fa-trash"></i></a>
                        </td>
                    </tr>
                }
                `
                    $('#tbody').append(render);
                }
                if('{{$att->visual}}' == 'image'){
                    let render = `
                <tr>
                        <td>
                            <input disabled name="label" class="form-control" value="${data.label}">
                        </td>
                        <td>
                    <div style="display: grid; grid-template-columns: 1fr 8fr">
                                    <img width="66px" height="66px" src="${url + '/' +data.value}">
                                    <input disabled name="value" class="form-control" type="file">
                                </div>
                    </td>
                    <td>
                        <button type="button" style="visibility: hidden">Add</button>
                        <a id="btn-del" href="${url + '/quan-tri/thuoc-tinh/xoa-option/' + data.id}"><i style="color: red" class="nav-icon fas fa-trash"></i></a>
                        </td>
                    </tr>
                }
                `
                    $('#tbody').append(render);
                }
                if('{{$att->visual}}' == 'text'){
                    let render = `
                <tr>
                        <td>
                            <input disabled name="label" class="form-control" value="${data.label}">
                        </td>
                        <td>
                    <input disabled name="value" class="form-control" value="${data.value}" type="text">
                    </td>
                    <td>
                        <button type="button" style="visibility: hidden">Add</button>
                        <a id="btn-del" href="${url + '/quan-tri/thuoc-tinh/xoa-option/' + data.id}"><i style="color: red" class="nav-icon fas fa-trash"></i></a>
                        </td>
                    </tr>
                }
                `
                    $('#tbody').append(render);
                }
                confirm_form();
            }
        });
    })
</script>
@endsection
