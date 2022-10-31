
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="http://localhost/MyLearning/public/images/favicon.ico"/>
    <meta name="csrf-token" content="68oqn1WKMAVepLiVW2i5T5COU0P2q9SGccIXsT8p"/>
    <title> Giảng viên </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/lte.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
                        <img src="{{asset("images/logo.png")}}" width="85" height="85">
                    </a>
                </div>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <div class="navbar-custom-menu" style="margin: 18px">

                        </div>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
</div>
<div class="content-wrapper">

    <div class="content-wrapper" style="min-height: 251px;">

        <div class="container">
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Quản lý Thông tin</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDSLop',$id_giang_vien)}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-star-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quản lý</span>
                        <span class="info-box-number text-uppercase">Lớp chuyên ngành</span>
                    </div>
                </div>
            </a>
        </div>
        {{-- <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDanhSachSV',$id_giang_vien)}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quản lý</span>
                        <span class="info-box-number text-uppercase">Kết quả đăng ký học phần</span>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>
    <div class="row">
        <div  class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('App\Http\Controllers\DeXuatHocPhanController@getDeXuatHocPhan')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quản lý</span>
                        <span class="info-box-number text-uppercase">Đề xuất học phần</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDSLop2',$id_giang_vien)}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-calendar-plus-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quản lý</span>
                        <span class="info-box-number text-uppercase">Thống kê Kết quả học tập</span>
                    </div>
                </div>
            </a>
        </div>
        {{-- <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@nhapDiem',$id_giang_vien)}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-calendar-plus-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quản lý</span>
                        <span class="info-box-number text-uppercase">Nhập điểm</span>
                    </div>
                </div>
            </a>
        </div> --}}
    </div>
    {{-- <div class="row"> --}}
        {{-- <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDSLop',$id_giang_vien)}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-star-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quản lý</span>
                        <span class="info-box-number text-uppercase">Lịch Dạy</span>
                    </div>
                </div>
            </a>
        </div> --}}
        {{-- <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDanhSachSV',$id_giang_vien)}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quản lý</span>
                        <span class="info-box-number text-uppercase">Kết quả đăng ký học phần</span>
                    </div>
                </div>
            </a>
        </div> --}}

    </div>
</section>
        </div>
    </div>
</div>

<footer class="main-footer">
    <strong>
        <a href="#">@2021  | Khoa Công nghệ thông tin - Đại học SPKT Vĩnh Long</a>.
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
<script>
    $(document).ready(function () {
    });
</script>
