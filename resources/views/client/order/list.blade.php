@extends('layouts.web.main')
@section('content_banner')
<div class="row"></div>
@endsection
@section('content')
   @if($list_order != null)
<div class="container" style="text-align: center; margin: 0 auto">
    <table>
        <thead>
        <tr>
            <th style="padding: 31px; text-align: center" scope="col">#ID</th>
            <th style="padding: 31px; text-align: center" scope="col">Total Money</th>
            <th style="padding: 31px; text-align: center" scope="col">Purchase Date</th>
            <th style="padding: 31px; text-align: center" scope="col">Status</th>
            <th style="padding: 31px; text-align: center" scope="col">#</th>
            <th style="padding: 31px; text-align: center" scope="col">#</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list_order as $item)
        <tr>
            <td style="padding: 31px; text-align: center">#{{$item->id}}</td>
            <td style="padding: 31px; text-align: center">{{number_format($item->total_money, 0, '.', '.')}} VNĐ <br>
                @if($item->status == 0)
                    <a style="margin-top: 31px" href="{{route('payment', $item->id)}}">Thanh toán</a>
                @endif
            </td>

            <td style="padding: 31px; text-align: center">{{date('d-m-Y', $item->created_at)}}</td>
            @if($item->status == 0)
                <td><div style="color: blue"><b>{{config('orderStatus.'.$item->status)}}</b></div></td>
            @elseif($item->status == 1)
                <td><div style="color: green"><b>{{config('orderStatus.'.$item->status)}}</b></div></td>
            @elseif($item->status == 2)
                <td><div style="color: blue"><b>{{config('orderStatus.'.$item->status)}}</b></div></td>
            @elseif($item->status == 3)
                <td><div style="color: green"><b>{{config('orderStatus.'.$item->status)}}</b></div></td>
            @elseif($item->status == 4)
                <td><div style="color: red"><b>{{config('orderStatus.'.$item->status)}}</b></div></td>
            @else
                <td><div>---</div></td>
            @endif
            <td style="padding: 31px; text-align: center"><a href="{{route('detailOrder', $item->id)}}"><div style="background-color: blueviolet; width: 100px; color: white; border-radius: 6px; padding: 3px 0">Detail</div></a></td>
            @if($item->status == 0)
                <td style="padding: 31px; text-align: center"><a href="{{route('cancelOrder', $item->id)}}"><div style="cursor:pointer;background-color: goldenrod; width: 150px; color: white; border-radius: 6px; padding: 3px 0">Cancel Order</div></a></td>
            @else
                <td style="padding: 31px; text-align: center; color: red">------</td>
            @endif
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
    @else
       <div class="search_order" style="text-align: center; margin:100px auto;">
           <form action="" method="post">
               @csrf
               <label>
                   <span id="error" style="padding-left: 12px;font-size: 14px; color: red"></span>
                   <input type="text" name="gmail" placeholder="Nhập Gmail" class="form-control"><br>
               </label>
               <button id="btn" class="btn btn-info">Tìm Kiếm</button>
           </form>
       </div>
    @endif
@endsection

@section('script')
<script>
    var del = document.querySelectorAll('#del');
    del.forEach(function(item) {
        item.onclick = function() {
            var result = confirm("Bạn Có Chắc Chắn Muốn Hủy Đơn Hàng Này Không ?");
            if (result == true) {
                return true;
            } else {
                return false;
            }
        }
    });
    $(function (){
        $('#btn').on('click', function (){
            let check = true;
            if($("input[name = 'gmail']").val().trim() == ''){
                let error = `Nhập gmail của bạn`;
                    $('#error').html(error);
                    check = false;
            }else{
                let error = ``;
                $('#error').html(error);
            }
            return check;
        })
    })
</script>
@endsection
