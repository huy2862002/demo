<form action="{{route('handle', 12)}}" method="post">
    @csrf
<div class="pay" style="text-align: center" id="pay">
    <button name="redirect" id="checkout" class="btn btn-primary py-3 px-4"
            style="color: white">Đặt Hàng
    </button>
</div>
</form>
