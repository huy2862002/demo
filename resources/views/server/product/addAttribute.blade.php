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
    </div>
    <div class="container" style="max-width:96%">
        <b style="color: goldenrod">Các thuộc tính còn lại</b>
           <form action="{{route('server.product.postAddAttribute', $product->id)}}" method="post">
               @csrf
               <div style="display: grid; grid-template-columns: 1fr 1fr 1fr;grid-gap: 12px">
                   @foreach($att_other as $other)
                       <div><input value="{{$other->id}}" name="att[]" style="margin-left: 12px" type="checkbox" class="form-group">
                           <span>{{$other->name}} ( type:{{$other->visual}} , {{config('type_attribute.'.$other->type)}}) </span></div>
                   @endforeach
                   <span style="margin-left: 12px; cursor: pointer"><button type="submit" id="sub" style="visibility: hidden">Add</button><i id="sbmt" style="color: goldenrod" class="nav-icon far fa-plus-square"></i></span>
               </div>
           </form>
        <b style="color: goldenrod">Thuộc tính của sản phẩm</b>
        @if(count($data_att_product) > 0)
                @foreach($data_att_product as $item)
                <div style="border: 1px solid forestgreen; padding: 12px; margin-bottom: 12px">
                       <div>
                           <b>{{$item->attName}} ( type:{{$item->visual}} , {{config('type_attribute.'.$item->type)}})</b>
                           <a href="{{route('server.product.delAttribute', $item->id)}}"><i style="color: red" class="nav-icon fas fa-trash"></i></a>
                       </div>
                </div>
                @endforeach
                    <a href="{{route('server.product.addVariant', $product->id)}}">Tạo biến thể sản phẩm -></a>
        @endif

            </div>
@endsection
@section('script')
    <script>
       $('#sbmt').on('click', function (e){
           e.preventDefault();
           $('#sub').trigger('click');
       })
    </script>
@endsection
