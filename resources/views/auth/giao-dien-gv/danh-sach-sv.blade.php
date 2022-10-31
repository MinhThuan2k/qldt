<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="http://localhost/MyLearning/public/images/favicon.ico"/>
    <meta name="csrf-token" content="68oqn1WKMAVepLiVW2i5T5COU0P2q9SGccIXsT8p"/>
    <title> Danh sách sinh viên </title>
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

            </ol>
            <h1>Danh sách sinh viên</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Mô tả</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gv as $item)
                                        <tr>
                                            <td style="width: 10px"></td>
                                            <td>{{ $item->ho}} {{$item->ten}}</td>
                                            <td>{{ $item->email}}</td>
                                            <td>{{ $item->sdt}}</td>
                                            <td>{{ $item->dia_chi}}</td>
                                            <td>{{$item->ghi_chu}}</td>
                                            <td class="text-center">
                                                <a data="{{ toAttrJson($item, ['id_hoc_vien', 'ghi_chu']) }}"
                                                   class="itemCapNhat" href="#">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </td>
                                            <td><a class="text-bold"
                                                   href="{{ action('App\Http\Controllers\GiaoDienGiangVienController@getDiem',['id_hoc_vien'=>"15"]) }}">Xem bảng điểm</a></td>
                                                
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cập nhật mô tả học viên</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Mô tả</label>
                        <textarea cols="30" rows="3" class="form-control ghi_chu"
                                  placeholder="Mô tả học viên"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
            </div>
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
    $('.table').dataTable({
        "ordering": false
    } );
    var POST_HOC_VIEN = "{{ action('App\Http\Controllers\GiaoDienGiangVienController@updateMoTa') }}";
    $(document).ready(function () {
        $(document).on('click', '.itemCapNhat', function () {
            var data = JSON.parse($(this).attr('data'));
            $('.ghi_chu').val(data.ghi_chu);
            $('.btnLuu').attr('data', data.id_hoc_vien);
            $('#modal-default').modal('show');
        });
        $('.btnLuu').click(function () {
            var id_hoc_vien = $(this).attr('data');
            $.ajax({
                url: POST_HOC_VIEN,
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id_hoc_vien': id_hoc_vien,
                    'ghi_chu': $('.ghi_chu').val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        toastr.success(result.message, "Thao tác thành công");
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    } else {
                        toastr.error(result.message, "Thao tác thất bại");
                    }
                }
            });
        });

    });
</script>
