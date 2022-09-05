<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Báo</title>
</head>

<body>
    <div class="container">
        <h3>Xin Chào {{$name}} ! Số Điện Thoại Nhận Hàng : {{$phone_number}}</h3>
        <b>Thông Tin Sản Phẩm</b><br>
        @foreach($data as $item)
        <span>Sản Phẩm : {{$item['name']}}</span> |
        <span>Đơn Giá : {{$item['price']}}</span> | 
        <span>Số Lượng : {{$item['quantity']}}</span><br>
        @endforeach
        <span>Tổng : {{number_format($total,0,'.','.') }} VNĐ</span><br>
    </div>
</body>

</html>