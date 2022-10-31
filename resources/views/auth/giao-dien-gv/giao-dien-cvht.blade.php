
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="http://localhost/MyLearning/public/images/favicon.ico"/>
    <meta name="csrf-token" content="68oqn1WKMAVepLiVW2i5T5COU0P2q9SGccIXsT8p"/>
    <title> Cố vấn học tập </title>
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
            <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@giaoDienGiangVien', $id)}}"><i
                            class="fa fa-dashboard"></i>Trang chủ</a></li>
                <li class="active">Đợt đăng ký</li>
            </ol>
            <h1>Đợt đăng ký học phần</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">

                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Đợt đăng ký</th>
                                        <th>Học kỳ</th>
                                        <th>Năm học</th>
                                        <th style="width: 200px;">Ngày mở</th>
                                        <th style="width: 200px;">Ngày đóng</th>
                                    </tr>
                                    @foreach($gv2 as $item)
                                        <tr>
                                            <td>
                                                <a class="text-bold"
                                                   href="{{ action('App\Http\Controllers\GiaoDienGiangVienController@getDSSV',[$item->id_dot_dang_ky,$id]) }}">
                                                    {{ $item->ten_dot_dang_ky }}
                                                </a>
                                            </td>
                                            <td>{{$item->ten_hoc_ky}}</td>
                                            <td>{{$item->ten_nam_hoc}}</td>
                                            <td>{{$item->thoi_gian_mo}}</td>
                                            <td>{{$item->thoi_gian_dong}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
