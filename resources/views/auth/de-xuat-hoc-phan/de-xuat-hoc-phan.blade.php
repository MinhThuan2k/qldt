<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="http://localhost/MyLearning/public/images/favicon.ico"/>
    <meta name="csrf-token" content="68oqn1WKMAVepLiVW2i5T5COU0P2q9SGccIXsT8p"/>
    <title> Đề xuất học phần </title>
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
                        <img src="http://localhost/MyLearning/public/images/logo.png" width="85" height="85">
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
                <h1>Đề xuất học phần</h1>
            </section>
            <section class="content">
                <button class="btn btn-success btnThem">Thêm mới</button>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-striped" >
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Học phần</th>
                                        <th>Đợt đăng ký</th>
                                        <th>Ghi chú</th>
                                        <th style="width: 70px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td></td>
                                            <td> {{$item->ten_hoc_phan }}</td>
                                            <td> {{$item->ten_lop_hoc}}-{{$item->ten_dot_dang_ky }}</td>
                                            <td> {{$item->ghichu }}</td>
                                            <td class="text-center">
                                                <a data="{{ toAttrJson($item, ['id_dot_dang_ky', 'id_de_xuat_hoc_phan', 'id_lop_chuyen_nganh', 'id_hoc_phan','ghichu']) }}"
                                                   class="itemCapNhat" href="#">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a data="{{ $item->id_de_xuat_hoc_phan}}" class="itemXoa" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody></table>
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
                <h4 class="modal-title">Thêm thông tin</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Đợt đăng ký (*)</label>
                        <select class="form-control id_dot_dang_ky">
                            @foreach($dot_dang_ky as $item)
                                <option value="{{$item->id_dot_dang_ky}}">{{$item->ten_dot_dang_ky}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Tên học phần (*)</label>
                        <select class="form-control id_hoc_phan">
                            @foreach($hoc_phan as $item)
                                <option value="{{$item->id_hoc_phan}}">{{$item->ten_hoc_phan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Lớp chuyên ngành (*)</label>
                        <select class="form-control id_lop_chuyen_nganh">
                            @foreach($lop_hoc as $item)
                                <option value="{{$item->id_lop_hoc}}">{{$item->ten_lop_hoc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Ghi chú (*)</label>
                        <textarea cols="30" rows="3" class="form-control ghichu"
                                  placeholder="Ghi chú"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
            </div>
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


    var PUT_DE_XUAT_HOC_PHAN ="{{ action('App\Http\Controllers\DeXuatHocPhanController@putDeXuatHocPhan') }}";
    var POST_DE_XUAT_HOC_PHAN ="{{ action('App\Http\Controllers\DeXuatHocPhanController@updateDeXuatHocPhan') }}";
    var DELETE_DE_XUAT_HOC_PHAN ="{{ action('App\Http\Controllers\DeXuatHocPhanController@deleteDeXuatHocPhan') }}";

    $(document).ready(function () {
        $('.table').dataTable();
        $('.btnThem').click(function () {
            $('.id_dot_dang_ky,.id_hoc_phan,.id_lop_chuyen_nganh,.ghichu').val('');
            $('#modal-default .modal-title').text('Thêm thông tin');
            $('.btnLuu').attr('type', 'insert');
            $('#modal-default').modal('show');
        });
        $(document).on('click', '.itemCapNhat', function () {
            var data = JSON.parse($(this).attr('data'));
            $('.id_dot_dang_ky').val(data.id_dot_dang_ky);
            $('.id_lop_chuyen_nganh').val(data.id_lop_chuyen_nganh);
            $('.id_hoc_phan').val(data.id_hoc_phan);
            $('.ghichu').val(data.ghichu);
            $('#modal-default .modal-title').text('Cập nhật thông tin');
            $('.btnLuu').attr('data', data.id_de_xuat_hoc_phan).attr('type', 'update');
            $('#modal-default').modal('show');
        });
        $('.btnLuu').click(function (){
            switch ($(this).attr('type')) {
                case 'insert':
                    $.ajax({
                        url: PUT_DE_XUAT_HOC_PHAN,
                        type: "PUT",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id_dot_dang_ky': $('.id_dot_dang_ky').val(),
                            'id_hoc_phan': $('.id_hoc_phan').val(),
                            'id_lop_chuyen_nganh': $('.id_lop_chuyen_nganh').val(),
                            'ghichu': $('.ghichu').val(),
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
                    });break;
                case 'update':
                    var id_de_xuat_hoc_phan = $(this).attr('data');
                    $.ajax({
                        url : POST_DE_XUAT_HOC_PHAN,
                        type : "post",
                        data : {
                            "_token": "{{ csrf_token() }}",
                            'id_de_xuat_hoc_phan': id_de_xuat_hoc_phan,
                            'id_dot_dang_ky': $('.id_dot_dang_ky').val(),
                            'id_hoc_phan': $('.id_hoc_phan').val(),
                            'id_lop_chuyen_nganh': $('.id_lop_chuyen_nganh').val(),
                            'ghichu': $('.ghichu').val(),
                        },
                        success : function (result){
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
                    });break;
            }
        });
        $('.itemXoa').click(function (){
            if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                return;
            }
            var id = $(this).attr('data');
            $.ajax({
                url : DELETE_DE_XUAT_HOC_PHAN,
                type : "DELETE",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'id_de_xuat_hoc_phan': id,
                },
                success : function (result){
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

</script>
