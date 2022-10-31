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
    <link rel="stylesheet" href="{{asset('css/scheduler_8.css')}}">
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
    <script src="{{asset('js/daypilot-all.min.js')}}"></script>
    @yield('style')
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ action('App\Http\Controllers\BangDiemSinhVienController@getSinhVien') }}" class="navbar-brand"><b>VLUTE</b> Giảng Viên</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                            @if(session()->get('hoten'))
                                    <li class="dropdown user user-menu">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <img src="{{asset('images/logo.png')}}" class="user-image" alt="User Image">
                                            <span class="hidden-xs">{{session()->get('hoten')}}</span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="user-header">
                                                <img src="http://localhost/MyLearning/public/images/logo.png" class="img-circle" alt="User Image">
                                                <p>
                                                    {{session()->get('hoten')}}
                                                    <small>{{session()->get('email')}}</small>
                                                </p>
                                            </li>
                                            <li class="user-footer">
                                                <div class="pull-right">
                                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Đăng xuất</a>
                                                </div>
                                                <div class="pull-left">
                                                    <a href="#" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @else
                                <li class="dropdown user user-menu">
                                    <a href="{{ route('login') }}">
                                        <span class="hidden-xs">Đăng nhập</span>
                                    </a>
{{--                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">--}}
{{--                                        <img src="http://localhost/MyLearning/public/images/logo.png" class="user-image" alt="User Image">--}}
{{--                                        <span class="hidden-xs"></span>--}}
{{--                                    </a>--}}
{{--                                    <ul class="dropdown-menu">--}}
{{--                                        <li class="user-header">--}}
{{--                                            <img src="http://localhost/MyLearning/public/images/logo.png" class="img-circle" alt="User Image">--}}
{{--                                            <p>--}}
{{--                                                Nguyễn Văn A--}}
{{--                                                <small>Email</small>--}}
{{--                                            </p>--}}
{{--                                        </li>--}}
{{--                                        <li class="user-footer">--}}
{{--                                            <div class="pull-right">--}}
{{--                                                <a href="#" class="btn btn-default btn-flat">Đăng xuất</a>--}}
{{--                                            </div>--}}
{{--                                            <div class="pull-left">--}}
{{--                                                <a href="#" class="btn btn-default btn-flat">Đổi mật khẩu</a>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
                                </li>
                            @endif

                        </div>
                    </ul>
                </div>

                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>

    </header>



    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">
        <strong>
            <a href="#">@2021 | Khoa Công nghệ thông tin - Đại học SPKT Vĩnh Long</a>.
        </strong>
    </footer>
</div>
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

        $('.treeview-menu li').each(function () {
            var tmp = localStorage.getItem('menu');
            if (tmp === $(this).text()) {
                $(this).addClass('active');
                $(this).parent().parent().addClass('active menu-open');
            }
        });

        $('.treeview-menu li').click(function () {
            localStorage.setItem('menu', $(this).text())
        });
    });
</script>
@yield('script')
