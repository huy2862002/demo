<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>{{ $title }}</h3>
    <div class="content" style="padding:0 12px">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Name Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach($info as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{number_format($item->price,0,',',',')}} VNĐ</td>
                    <td>{{$item->quantity}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="info">
            <span style="color: red;">Code Order</span> : <span>{{$order->id}}</span><br>
            <span style="color: red;">Your Full Name</span> : <span>{{$order->user_name}}</span><br>
            <span style="color: red;">Your Phone Number</span> : <span>{{$order->phone_number}}</span><br>
            <span style="color: red;">Your Address </span> : <span>{{$order->address}}</span><br>
            <span style="color: red;">Total Money </span> : <span>{{number_format($order->total_money,0,'.','.') }} VNĐ</span><br>
        </div>
    </div>
</body>
</html>