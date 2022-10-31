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
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="#" class="logo">
            <span class="logo-lg">
                <img src="#" height="35" alt="Trung tâm tin học VLUTE">
                <b style="padding-left: 10px;">TT.Tin Học</b>
            </span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <select class="form-control" style="margin-top: 7px;">
                            <option value="">Học kỳ 1, năm học 2021 - 2022</option>
                            <option value="">Học kỳ 1, năm học 2021 - 2022</option>
                            <option value="">Học kỳ 1, năm học 2021 - 2022</option>
                            <option value="">Học kỳ 1, năm học 2021 - 2022</option>
                            <option value="">Học kỳ 1, năm học 2021 - 2022</option>
                        </select>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('images/logo.png')}}" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs">{{session()->get('hoten')}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="{{asset('images/logo.png')}}" class="img-circle"
                                     alt="User Image">
                                <p>
                                    {{session()->get('hoten')}}
                                    <small>{{session()->get('email')}}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{route('logout')}}"
                                       class="btn btn-default btn-flat">Đăng xuất</a>
                                </div>
                                <div class="pull-left">
                                    <a href="#"
                                       class="btn btn-default btn-flat">Đổi mật khẩu</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar" style="margin-top: -50px; z-index: 10000;">
        @if(true)
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">QUẢN LÝ THÔNG TIN</li>
                    <li class="treeview" style="height: auto;">
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Thông tin chung</span>
                            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{action('App\Http\Controllers\HeDaoTaoController@getViewHeDaoTao')}}">
                                    <i class="fa fa-circle-o"></i>
                                    Hệ đào tạo
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('App\Http\Controllers\NganhHocController@getNganhHoc') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Ngành đào tạo
                                </a>
                            </li>
                            <li hidden>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i>
                                    Chương trình đào tạo
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('App\Http\Controllers\DonViController@getDonVi')  }}">
                                    <i class="fa fa-circle-o"></i>
                                    Đơn vị - Khoa chuyên môn
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('App\Http\Controllers\HocPhanController@getHocPhan')  }}">
                                    <i class="fa fa-circle-o"></i>
                                    Học phần
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('App\Http\Controllers\NamHocController@getNamHoc') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Năm học
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('App\Http\Controllers\HocKyController@getViewHocKy') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Học kỳ
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('App\Http\Controllers\HocPhiController@getViewHocPhi') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Học phí
                                </a>
                            </li>

                            <li><a href="#">
                                    <i class="fa fa-circle-o"></i>
                                    Học viên
                                </a>
                            </li>

{{--                            <li>--}}
{{--                                <a href="{{ action('App\Http\Controllers\ThoiGianController@getThoiGian') }}">--}}
{{--                                    <i class="fa fa-circle-o"></i>--}}
{{--                                    Thời gian học--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li>
                                <a href="{{ action('App\Http\Controllers\PhongController@getPhong') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Phòng học
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('App\Http\Controllers\ThoiKhoaBieuController@getTKB') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Thời khóa biểu
                                </a>
                            </li>
                            <li>
                                <a href="{{ action('App\Http\Controllers\NienKhoaController@getNienKhoa') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Niên Khóa
                                </a>
                            </li>
                            <li>
{{--                                <a href="{{ action('App\Http\Controllers\LopHocController@getLopHoc') }}">--}}
                                <a href="#">
                                    <i class="fa fa-circle-o"></i>
                                    Lớp học
                                </a>
                            </li>
                            <li hidden>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i>
                                    Học phí - lệ phí
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{action('App\Http\Controllers\KhaoSatDangKyHocPhanController@get')}}">
                                    <i class="fa fa-circle-o"></i>
                                    Khảo sát đăng ký môn
                                </a>
                            </li> --}}

                            <li>
                                <a href="{{action('App\Http\Controllers\DotDangKyController@getViewDotDangKy')}}">
                                    <i class="fa fa-circle-o"></i>
                                    Đăng ký môn
                                </a>
                            </li>

                            <li>
                                <a href="{{ action('App\Http\Controllers\CaiDatDangKyMonController@HienThi') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Cài đặt đăng ký môn
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="header">QUẢN LÝ GIẢNG DẠY</li>
                    <li hidden>
                        <a href="#">
                            <i class="fa fa-address-book-o" aria-hidden="true"></i>
                            <span>Lớp học phần</span></a>
                    </li>
                    <li hidden>
                        <a href="#">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span>Phân công giảng dạy</span></a>
                    </li>
                    <li hidden>
                        <a href="#">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span>Tài khoản</span></a>
                    </li>
                </ul>
            </section>
        @else
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.sidebar-toggle').trigger('click');
                });
            </script>
        @endif
    </aside>

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
