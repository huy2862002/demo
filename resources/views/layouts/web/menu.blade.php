<div class="py-1 bg-black">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">+84 0123 456 789</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">youremail@email.com</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text">Free ship bán kính 5 Km &amp; Lỗi đổi 1 - 1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Qwerty</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item active"><a href="{{route('home')}}" class="nav-link">Trang Chủ</a></li>
                <li class="nav-item"><a href="{{route('product.list')}}" class="nav-link">Sản Phẩm</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                @if(Auth::check())
                <li class="nav-item dropdown">
                    <p class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-user"></span> {{Auth::user()->name}}</p>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        @if(Auth::user()->role == 0)
                        <a class="dropdown-item" href="{{route('server.dashboard')}}">Quản Trị</a>
                        @endif
                        <a class="dropdown-item" href="product-single.html">Thông Tin</a>
                        <a class="dropdown-item" href="{{route('order')}}">Đơn Hàng</a>
                        <a class="dropdown-item" href="cart.html">Yêu Thích</a>
                        <a class="dropdown-item" href="{{route('logout')}}">Đăng Xuất</a>
                    </div>
                </li>
                @else
                <li class="nav-item cta cta-colored"><a href="{{route('loginForm')}}" class="nav-link"><span class="icon-user"></span> Đăng Nhập</a></li>
                @endif
                <li class="nav-item cta cta-colored"><a href="{{route('showCart')}}" class="nav-link"><span class="icon-shopping_cart"></span>[{{session()->get('cart') ? count(session()->get('cart') ) : 0 }}]</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->