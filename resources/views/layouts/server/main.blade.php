<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN QWERTY SHOP</title>
    <link rel="icon" type="image/x-icon" href="{{asset('server/dist/img/AdminLTELogo.png')}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('server/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('server/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('server/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('server/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('server/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('server/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('server/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('server/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{asset('server/dist/radio.scss')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('server/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60"
             width="60">
    </div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('home')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline" method="post" action="">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search" name="keyWord">
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
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img src="{{asset('server/dist/img/user1-128x128.jpg')}}" alt="User Avatar"
                                 class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img src="{{asset('server/dist/img/user8-128x128.jpg')}}" alt="User Avatar"
                                 class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img src="{{asset('server/dist/img/user3-128x128.jpg')}}" alt="User Avatar"
                                 class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                   role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <img src="{{asset('server/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">QWERTY SHOP</span>
        </a>
        @include('layouts.server.sidebar')
    </aside>
    <div class="content-wrapper">
        <div style="border-top: 1px solid #cccccc; border-bottom: 1px solid #cccccc; text-align: center; padding: 28px;
        background-color: #6322ce; color: white">
            <h3>@yield('title_tab')</h3>
        </div>
        @yield('content')
    </div>
    <footer class="main-footer">
    </footer>
    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<script src="{{asset('server/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('server/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('server/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('server/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('server/plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('server/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('server/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('server/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('server/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('server/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('server/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('server/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('server/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('server/dist/js/adminlte.js')}}"></script>
<script src="{{asset('server/dist/js/demo.js')}}"></script>
<script src="{{asset('server/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('server/dist/js/admin.js')}}"></script>
<script src="{{asset('server/dist/js/product_validate.js')}}"></script>
<script src="{{asset('server/dist/js/category_validate.js')}}"></script>
<script src="{{asset('server/dist/js/code_validate.js')}}"></script>
<script src="{{asset('server/dist/js/change_slug.js')}}"></script>
<script src="{{asset('server/dist/js/validate_att.js')}}"></script>
</body>
@yield('script')
</html>
