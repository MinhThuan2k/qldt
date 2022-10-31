<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lte.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('cdn/plugin.js')}}"></script>
    <script src="{{asset('js/function.js')}}"></script>
    <script src="{{asset('js/push-menu-left.js')}}"></script>
    <script src="{{asset('js/tree-menu.js')}}"></script>
    <script src="{{asset('js/js.cookie.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/function.js')}}"></script>
    <style>

        element.style {
        }
        .skin-blue .main-header .navbar {
            background-color: #00a157;
        }
    </style>
</head>
<body class="hold-transition skin-blue layout-top-nav">

<div>
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('images/logo.png')}}" width="85" height="85">
                    </a>
                </div>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <div class="navbar-custom-menu" style="margin: 18px">
                            <ul class="nav navbar-nav">
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="hidden-xs">Trang chủ</span>
                                    </a>
                                </li>

                                @if(session()->get('hoten'))
                                    <li class="dropdown user user-menu">
                                        <a href="#">
                                            <span class="hidden-xs">{{ session()->get('hoten') }}</span>
                                        </a>
                                    </li>
                                    <li class="dropdown user user-menu">
                                        <a href="{{ route('logout') }}">
                                            <span class="hidden-xs">Đăng xuất</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="dropdown user user-menu">
                                        <a href="{{ route('login') }}">
                                            <span class="hidden-xs">Đăng nhập</span>
                                        </a>
                                    </li>
{{--                                    <li class="dropdown user user-menu">--}}
{{--                                        <a href="#">--}}
{{--                                            <span class="hidden-xs">Đăng ký</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
                                @endif
                            </ul>
                        </div>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
</div>



    <div class="container ">
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Tổng quan <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="{{action('App\Http\Controllers\DangKyHocPhanController@getChonDotDangKy')}}">Đăng ký lớp học phần <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="#">Đang học <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="#">Đăng ký lớp học phần <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="#">Thời khóa biểu <span class="sr-only">(current)</span></a></li>
                <li class="active"><a href="#">Học phần đào tạo <span class="sr-only">(current)</span></a></li>
            </ul>
        </div>
    </div>


    <div class="content-wrapper">
        @yield('content')
    </div>


    <footer class="main-footer">
        <strong>
            <a href="#">@2021 | Khoa Công nghệ thông tin - Đại học SPKT Vĩnh Long</a>.
        </strong>
    </footer>

</body>
</html>
<script type="text/javascript">

    $.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';
    $.extend(true, $.fn.dataTable.defaults, {
        "sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
        "autoWidth": true,
        'stateSave': true
    });

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
</script>
@yield('script')
