@extends('layouts.web.main')
@section('content_banner')
<div class="row"></div>
@endsection
@section('content')
   @if($list_order != null)
<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Total Money</th>
            <th scope="col">Purchase Date</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list_order as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{number_format($item->total_money, 0, '.', '.')}} VNĐ</td>
            <td>{{date('d-m-Y', $item->created_at)}}</td>
            <td>{{config('orderStatus.'.$item->status)}}</td>
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
