
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
                    <li class="active"><a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDanhSachSV', $id)}}"><i
                                class="fa fa-dashboard"></i>Đợt đăng ký</a></li>
                    <li class="active">Danh sách sinh viên</li>
                </ol>
                <h1>
                   Danh sách sinh viên
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">
                <a class="btn btn-primary btnThem">Duyệt</a>
                <button onclick="checkAll()" class = "btn btn-success">Chọn tất cả</button>
                <button onclick="uncheckAll()" class = "btn btn-success">Bỏ chọn</button>
                <div class="box box-default">
                    <div class="box-body">
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 150px">Họ tên</th>
                                        <th>Họ tên</th>
                                        <th>Mã lớp học phần</th>
                                        <th>Học phần</th>
                                        <th style="width: 100px">Số TC(LT/TH)</th>
                                        <th>Trạng thái</th>
                                        <th style="width: 100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gv as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{$item->ho}} {{$item->ten}}</td>
                                        <td>{{$item->ma_lop_hoc_phan}}</td>
                                        <td>{{$item->ten_hoc_phan}}</td>
                                        <td>{{$item->tin_chi_lt}}/{{$item->tin_chi_th}}</td>
                                        @if($item->trang_thai === 1)
                                            <td><span class="label label-success">Đã duyệt</span></td>
                                        @else
                                            <td><span class="label label-warning">Chưa duyệt</span></td>
                                        @endif
                                        <td class="text-center">
                                            <input type="checkbox" class = "check" name = "ck[]" value="{{$item->id_lop_hoc_phan}},{{$item->id_hoc_vien}},{{$item->id_dot_dang_ky}}">
                                        </td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
            <!-- /.content -->


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
    var groupColumn = 1;
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
    function checkAll() {
        var inputs = document.querySelectorAll('.check');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = true;
        }
    }
    function uncheckAll() {
        var inputs = document.querySelectorAll('.check');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = false;
        }
    }
    $('.btnThem').click(function (){

    });
</script>
