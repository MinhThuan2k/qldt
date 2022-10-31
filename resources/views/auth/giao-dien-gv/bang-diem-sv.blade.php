<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="http://localhost/MyLearning/public/images/favicon.ico"/>
    <meta name="csrf-token" content="68oqn1WKMAVepLiVW2i5T5COU0P2q9SGccIXsT8p"/>
    <title> Bảng điểm sinh viên </title>
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
                <li>Trang chủ</li>
                <li>Lớp chuyên ngành</li>
                <li class="active">Lớp</li>
                <li class="active">Điểm cá nhân</li>
            </ol>
            <h1>Bảng điểm cá nhân {{$ho}} {{$ten}}</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Mã học phần</th>
                                        <th hidden>Học kỳ</th>
                                        <th>Tên học phần</th>
                                        <th>Số tín chỉ</th>
                                        <th>Quá trình</th>
                                        <th>Giữa kỳ</th>
                                        <th>Điểm thi</th>
                                        <th>Điểm HP</th>
                                        <th>Điểm chữ</th>
                                        <th>Điểm hệ 4</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gv as $item)
                                        <tr>
                                            <td ></td>
                                            <td>{{ $item->ma_hoc_phan}}</td>
                                            <td hidden>{{ $item->ten_hoc_ky}} - {{$item->ma_nam_hoc}}</td>
                                            <td>{{ $item->ten_hoc_phan}}</td>
                                            <td>{{ $item->tin_chi_lt}}/{{$item->tin_chi_th}}</td>
                                            <td>{{$item->diem_10}}</td>
                                            <td>{{$item->diem_40}}</td>
                                            <td>{{$item->diem_50}}</td>
                                            <td>{{$item->dtb}}</td>
                                            @if($item->dtb>=8.5)
                                                <td>A</td>
                                                <td>4.0</td>
                                            @elseif($item->dtb>=7.8)
                                                <td>B+</td>
                                                <td>3.5</td>
                                            @elseif($item->dtb>=7.0)
                                                <td>B</td>
                                                <td>3.0</td>
                                            @elseif($item->dtb>=6.3)
                                                <td>C+</td>
                                                <td>2.5</td>
                                            @elseif($item->dtb>=5.5)
                                                <td>C</td>
                                                <td>2.0</td>
                                            @elseif($item->dtb>=4.8)
                                                <td>D+</td>
                                                <td>1.5</td>
                                            @elseif($item->dtb>=4.0)
                                                <td>D</td>
                                                <td>1.0</td>
                                            @else
                                                <td>F</td>
                                                <td>0</td>
                                            @endif
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
    var groupColumn = 2;
    var table = $('.table').DataTable({
        "ordering": false,
        "columnDefs": [
            {"visible": false, "targets": groupColumn}
        ],
        "order": [[groupColumn, 'desc']],
        "displayLength": 50,
        "drawCallback": function (settings) {
            var api = this.api();
            var rows = api.rows({page: 'current'}).nodes();
            var last = null;
            api.column(groupColumn, {page: 'current'}).data().each(function (group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td style="font-size: 16px;" class="text-bold text-danger" colspan="8">' + group + '</td></tr>'
                    );
                    last = group;
                }
            });
        }
    });
    $(document).ready(function () {

    });
</script>
