@extends('layouts.server.main')
@section('title_tab', 'Thêm Thộc Tính Sản Phẩm')
@section('content')
    <div id="status_form">
        @if(session()->has('success'))
            <div
                style="border: 1px solid #27d11d; background-color: #27d11d;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                <b>{{session()->get('success')}}</b>
            </div>
        @endif
            @if(session()->has('error'))
                <div
                    style="border: 1px solid red; background-color: red;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                    <b>{{session()->get('error')}}</b>
                </div>
            @endif
    </div>
    <div class="container" style="max-width:96%">
        <b style="color: goldenrod">Thuộc tính của sản phẩm</b>
        @if(count($data_att_product) > 0)
            <form action="{{route('server.product.postAddVariant', $product->id)}}" method="post">
                @csrf
                @foreach($data_att_product as $item)
                    <div style="border: 1px solid forestgreen; padding: 12px; margin-bottom: 12px">
                        <b>{{$item->attName}} ( type:{{$item->visual}} , {{config('type_attribute.'.$item->type)}}
                            )</b><br><br>
                        @if($item->type!=0)
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr">
                                @else
                                    <div>
                                        @endif
                                        @foreach($data_att_opt as $option)
                                            @if($item->attribute_id == $option->attribute_id)
                                                @if($item->type == 2)
                                                    @if($item->visual == 'image')
                                                        <div style="margin-bottom: 12px">
                                                            <input name="{{$item->attName}}[]" type="checkbox"
                                                                   checked class="form-group" value="{{$option->id}}">
                                                            <img src="{{asset($option->value)}}" width="50px"
                                                                 height="50px">
                                                            <span>{{$option->label}}</span>
                                                        </div>
                                                    @endif
                                                    @if($item->visual == 'color')
                                                        <div style="margin-bottom: 12px">
                                                            <input name="{{$item->attName}}[]" type="checkbox"
                                                                  checked class="form-group" value="{{$option->id}}">
                                                            <div
                                                                style="width: 50px; height: 50px; background-color: {{$option->value}}"></div>
                                                            <span>{{$option->label}}</span>
                                                        </div>
                                                    @endif
                                                    @if($item->visual == 'text')
                                                        <div style="margin-bottom: 12px">
                                                            <input name="{{$item->attName}}[]" type="checkbox"
                                                                   checked class="form-group" value="{{$option->id}}">
                                                            <span>{{$option->label}}</span>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                            </div>
                            @endforeach
                        @endif
                        <div>
                            <button id="sb" type="submit" class="btn btn-primary">Create Variant</button>
                        </div>
                    </div>
            </form>

        @if(count($data_opt_product) > 0)
            <div style="padding: 12px">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Variant</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Price Discount</th>
                        <th scope="col">Inventory</th>
                        <th scope="col">Default</th>
                        <th scope="col">Hidden</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data_opt_product as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td width="100px">
                            @foreach($data_att_opt as $opt)
                                @if(in_array($opt->id, explode(' ',$item->option_id)))
                                {{$opt->label}} <br>
                                @endif
                            @endforeach
                        </td>
                        <td style="display: grid; grid-template-columns: 1fr 1fr; width: 300px">
                            <img id="review{{$item->id}}" width="100px" height="100px" src="{{asset($item->image)}}">
                            <form method="post" enctype="multipart/form-data" class="form">
                                <div>
                                    <input type="hidden" name="hid" value="{{$item->id}}">
                                    <input id="image{{$item->id}}" name="image" type="file" class="form-control" style="visibility: hidden">
                                    <button id="sub{{$item->id}}" class="submit" style="visibility: hidden">add</button>
                                    <button  id="{{$item->id}}" class="btn-file btn btn-warning">Chọn file</button></div>
                            </form>
                        </td>
                        <td>
                            <input type="number" id="{{$item->id}}" name="price" value="{{$item->price}}" class="form-control">
                            VNĐ</td>
                        <td><input type="number" name="price_discount" id="{{$item->id}}" value="{{$item->price_discount}}" class="form-control"> VNĐ</td>
                        <td><input type="number" name="inventory" id="{{$item->id}}" value="{{$item->inventory}}" class="form-control"></td>
                        <td>
                            @if($item->status == 0)
                                <input value="{{$item->id}}" class="default" name="default" checked type="radio" class="form-group">
                            @else
                                <input value="{{$item->id}}" class="default" name="default" type="radio" class="form-group">
                            @endif
                        </td>
                        <td><input name="hidden" type="checkbox" class="form-group"></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
    </div>

@endsection
@section('script')
<script>
    $(function (){
        $("input[name = 'price']").on('keyup', function (){
            let id = $(this).attr('id');
            let value = $(this).val();
            $.ajax({
                url:"{{route('updatePriceVariant')}}",
                method: 'put',
                data:{
                    id:id,
                    value:value
                }
            })
        })
        $("input[name = 'price_discount']").on('keyup', function (){
            let id = $(this).attr('id');
            let value = $(this).val();
            $.ajax({
                url:"{{route('updatePriceDiscountVariant')}}",
                method: 'put',
                data:{
                    id:id,
                    value:value
                }
            })
        })
        $("input[name = 'inventory']").on('keyup', function (){
            let id = $(this).attr('id');
            let value = $(this).val();
            $.ajax({
                url:"{{route('updateInventoryVariant')}}",
                method: 'put',
                data:{
                    id:id,
                    value:value
                }
            })
        })
        $('button.btn-file').on('click', function (e){
            e.preventDefault();
            let id=$(this).attr('id')
            console.log(id)
            $("#image"+id).click();
            $("#image"+id).on('change', function (e){
                e.preventDefault();
                    var input = e.target;
                    var reader = new FileReader();
                    reader.onload = function () {
                        var dataURL = reader.result;
                        var output = $("#review"+id).attr('src', dataURL);
                    }
                    reader.readAsDataURL(input.files[0]);

                $('button#sub'+id).click();
            })
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{route('updateAvtVariant')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    console.log(data);
                },
                error: function(data){
                    let error = `
                    <div
                        style="border: 1px solid red; background-color: red;margin-bottom: 12px; color: white; text-align: center; padding: 6px">
                        <b>File không phù hợp</b>
                    </div>
                    `
                        $('#status_form').html(error);
                }
            });
        });

        $(".default").on('click', function(){
            let id  = $(this).attr('value');
            $.ajax({
                url:"{{route('primarySetup')}}",
                method:'put',
                data:{
                    id:id,
                    proId:{{$product->id}}
                },success:function(res){
                    alert('successfully')
                },error:function(e){
                    alert('error')
                }
            })
        })
    })
</script>
@endsection
