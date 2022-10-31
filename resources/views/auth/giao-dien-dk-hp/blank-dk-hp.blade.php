@extends('auth.giao-dien-dk-hp.master')
@section('title') ĐĂNG KÝ HỌC PHẦN @endsection
@section('content')
    <div class="content-wrapper" style="min-height: 251px;">
        <div class="container">
            <section class="content-header">
                <h1>
                    Đăng ký lớp học phần
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                    <li><a href="#">Đăng ký...</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tìm kiếm</h3>
                    </div>
                    <form role="form">
                        <div class="box-body">
                            <div class="col-xs-12">
                                <select id="id_lop_chuyen_nganh" class="form-control">
                                    <option value="{{$id_lop_chuyen_nganh}}">Lọc theo học phần đã khảo sát</option>
                                    <option selected value="0">Lọc theo các môn dự kiến</option>
                                </select>
                            </div>
{{--                            <div class="col-xs-3">--}}
{{--                                <input type="text" class="form-control" placeholder="Tìm kiếm theo mã môn học">--}}
{{--                            </div>--}}
{{--                            <div class="col-xs-offset-10 col-xs-2">--}}
{{--                                <button class="btn btn-primary btn-block">Tìm kiếm</button>--}}
{{--                            </div>--}}
                        </div>
                    </form>
                </div>
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Học phần đã đăng ký</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool refreshHocPhanDangKy" data-widget="collapse"><i class="fa fa-refresh"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>Số tín chỉ tối đa được đăng ký: {{$cai_dat["tinChiToiDa"]}}</p>
                        <p>Số tín chỉ tối thiểu được đăng ký: {{$cai_dat["tinChiToiThieu"]}}</p>
                        <h4>Số tín chỉ đã đăng ký: <span class="badge badge-primary" id="soTinChi"></span></h4>
                        <table class="table table-striped" id="hocPhanDaDangKy">
                            <thead>
                            <tr>
                                <th>Tên học phần</th>
                                <th>Mã lớp học phần</th>
                                <th>Giảng viên</th>
                                <th>Phòng học</th>
                                <th>Ngày học</th>
                                <th>Thời gian học</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Học phần đang mở</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool goiyHP" data-widget="collapse">Gợi ý HP Theo CTĐT</button>
                            <button type="button" class="btn btn-box-tool refreshDangKy" data-widget="collapse"><i class="fa fa-refresh"></i>
                            </button>
                            
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped" id="bangDangKy">
                            <thead>
                            <tr>
                                <th>Mã lớp học phần</th>
                                <th>Tên học phần</th>
                                <th style="width: 100px">Số TC(LT/TH)</th>
                                <th style="width: 100px">Số lượng</th>
                                <th style="width: 100px">Đã đăng ký</th>
                                <th>Giảng viên</th>
                                <th>Ngày học</th>
                                <th>Thời gian học</th>
                                <th style="width: 100px">Đăng ký</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>


            </section>
            <!-- /.content -->


        </div>

    </div>

    <div class="modal fade" id="modalDangKyKem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-bold">Đăng ký lớp học kèm</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped" id="tableMonHocKem">
                                <thead>
                                <tr>
                                    <th>Mã lớp học phần</th>
                                    <th>Tên học phần</th>
                                    <th style="width: 100px">Số lượng</th>
                                    <th style="width: 100px">Đã đăng kí</th>
                                    <th style="width: 200px">Giảng viên</th>
                                    <th>Phòng học</th>
                                    <th>Ngày học</th>
                                    <th >Thời gian</th>
                                    <th style="width: 100px">Đăng ký</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnDangKyLopHocKem">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var LAY_HOC_PHAN_DA_DANG_KY = "{{action('App\Http\Controllers\DangKyHocPhanController@getHocPhanDaDangKy')}}";
        var SYNC_HOC_PHAN_DA_DANG_KY = "{{action('App\Http\Controllers\DangKyHocPhanController@sync_hocPhanDaDangKy')}}";
        var DANG_KY_LOP_HOC_PHAN = "{{action('App\Http\Controllers\DangKyHocPhanController@dangKyHocPhan')}}";
        var DANG_KY_LOP_HOC_PHAN_KEM = "{{action('App\Http\Controllers\DangKyHocPhanController@dangKyHocPhanKem')}}";
        var GET_LOP_THUC_HANH = "{{action('App\Http\Controllers\DangKyHocPhanController@getLopThucHanh')}}";
        var GET_LOP_HOC_PHAN_DATATABLE = "{{action('App\Http\Controllers\DangKyHocPhanController@getDangKyHocPhanDatatable')}}";
        var HUY_LOP_HOC_PHAN = "{{action('App\Http\Controllers\DangKyHocPhanController@huyHocPhanDangKy')}}";
        var ID_LOP_HOC_PHAN_LY_THUYET = 0;
        var ID_HOC_VIEN = "{{session()->get('id')}}";
        var DA_DANG_KY = [];
        var SO_TIN_CHI = 0;
        var ID_DOT_DANG_KY = {{$id_dot_dang_ky}};
        var GET_LOP_HOC_PHAN_GOI_Y_DATATABLE = "{{action('App\Http\Controllers\DangKyHocPhanController@getDangKyHocPhanGoiYDatatable',[$id_dot_dang_ky,session()->get('id')])}}";

        //2 nút reload trên bảng đăng ký và bảng đã đăng ký
        $('.refreshDangKy').on('click', function () {
            bangDangKyHocPhan_reload();
        })
        $('.refreshHocPhanDangKy').on('click', function () {
            hocPhanDaDangKy_reload();
        })
        function bangDangKyHocPhan_reload()
        {
            $('#bangDangKy').DataTable().clear();
            $('#bangDangKy').DataTable().destroy();
            $('#bangDangKy').dataTable(
                {
                    responsize: true,
                    ajax:{
                        "url": GET_LOP_HOC_PHAN_DATATABLE,
                        "dataSrc": "",
                        "type": "POST",
                        'data': {
                            //Lọc theo học phần đề xuất, lọc theo các lớp mở
                            'id_dot_dang_ky': ID_DOT_DANG_KY,
                            'id_lop_chuyen_nganh': $('#id_lop_chuyen_nganh').val(),
                           
                        }
                    },
                    "columns": [
                        { "data": "ma_lop_hoc_phan" },
                        { "data": "ten_hoc_phan" },
                        { "data": "tin_chi" },
                        { "data": "so_luong" },
                        { "data": "so_luong_dang_ky" },
                        { "data": "ho_ten"},
                        { "data": "ngay_hoc_chu"},
                        { "data": "tiet_ca"},
                        { "data": "button"},
                    ],
                    columnDefs: [{
                        targets: [-1], render: function (data, type, row, meta) {
                            var json = JSON.stringify(row);
                            if(DA_DANG_KY.includes(row.id_hoc_phan))
                                return '<button data="'+escapeHtml(json)+'" type="button" class="btn btn-secondary disabled">Đã đăng ký</button>';
                            if(row.tin_chi_th > 0)
                                return '<button data="'+escapeHtml(json)+'" type="button" class="btn btn-block btn-primary btnDangKyKem">Đăng ký</button>';
                            else
                                return '<button data="'+escapeHtml(json)+'" type="button" class="btn btn-block btn-success btnDangKy">Đăng ký</button>';
                        },
                    }],
                }
            );
        }
        function bangGoiYDangKyHocPhan_reload()
        {
            $('#bangDangKy').DataTable().clear();
            $('#bangDangKy').DataTable().destroy();
            $('#bangDangKy').dataTable(
                {
                    responsize: true,
                    ajax:{
                        "url": GET_LOP_HOC_PHAN_GOI_Y_DATATABLE,
                        "dataSrc": "",
                        "type": "POST",
                        'data': {
                            //Lọc theo học phần đề xuất, lọc theo các lớp mở
                            'id_dot_dang_ky': ID_DOT_DANG_KY,
                            'id_lop_chuyen_nganh': $('#id_lop_chuyen_nganh').val(),
                        }
                    },
                    "columns": [
                        { "data": "ma_lop_hoc_phan" },
                        { "data": "ten_hoc_phan" },
                        { "data": "tin_chi" },
                        { "data": "so_luong" },
                        { "data": "so_luong_dang_ky" },
                        { "data": "ho_ten"},
                        { "data": "ngay_hoc_chu"},
                        { "data": "tiet_ca"},
                        { "data": "button"},
                    ],
                    columnDefs: [{
                        targets: [-1], render: function (data, type, row, meta) {
                            var json = JSON.stringify(row);
                            if(DA_DANG_KY.includes(row.id_hoc_phan))
                                return '<button data="'+escapeHtml(json)+'" type="button" class="btn btn-secondary disabled">Đã đăng ký</button>';
                            if(row.tin_chi_th > 0)
                                return '<button data="'+escapeHtml(json)+'" type="button" class="btn btn-block btn-primary btnDangKyKem">Đăng ký</button>';
                            else
                                return '<button data="'+escapeHtml(json)+'" type="button" class="btn btn-block btn-success btnDangKy">Đăng ký</button>';
                        },
                    }],
                }
            );
        }
        $('.goiyHP').on('click', function () {
            bangGoiYDangKyHocPhan_reload();
        });
        var entityMap = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
            '/': '&#x2F;',
            '`': '&#x60;',
            '=': '&#x3D;'
        };
        function hocPhanDaDangKy_reload()
        {
            $('#hocPhanDaDangKy').DataTable().clear();
            $('#hocPhanDaDangKy').DataTable().destroy();
            $('#hocPhanDaDangKy').dataTable(
                {
                    reponsive: true,
                    ajax:{
                        url: LAY_HOC_PHAN_DA_DANG_KY,
                        type: "POST",
                        dataSrc: "",
                        data: {
                            'id_dot_dang_ky': ID_DOT_DANG_KY,
                            'id_hoc_vien' : ID_HOC_VIEN,
                        },
                    },
                    "columns": [
                        { "data": "ten_hoc_phan" },
                        { "data": "ma_lop_hoc_phan" },
                        { "data": "ho_ten" },
                        { "data": "ten_phong" },
                        { "data": "ngay_hoc_chu" },
                        { "data": "tiet_ca" },
                        { "data": "button"},
                    ],
                    columnDefs: [{
                        targets: [-1], render: function (data, type, row, meta) {
                            var json = JSON.stringify(row);
                            return '<button data="'+escapeHtml(json)+'" type="button" class="btn btn-block btn-danger btnHuy">Hủy</button>';
                        },
                    }],
                }
            );
        }
        function dangKyHocPhan_sync()
        {
            $.ajax({
                url: SYNC_HOC_PHAN_DA_DANG_KY,
                type: "POST",
                dataSrc: "",
                data: {
                    'id_dot_dang_ky': ID_DOT_DANG_KY,
                    'id_hoc_vien' : ID_HOC_VIEN,
                },
                success: function (result) {
                    result = JSON.parse(result);
                    DA_DANG_KY = [];
                    SO_TIN_CHI = 0;
                    for(var key in result)
                    {
                        console.log(result[key].id_hoc_phan);
                        DA_DANG_KY.push(result[key].id_hoc_phan);
                        SO_TIN_CHI += result[key].so_tin_chi
                    }
                    $('#soTinChi').text(SO_TIN_CHI);
                    console.log(DA_DANG_KY);
                    console.log(SO_TIN_CHI);
                    bangDangKyHocPhan_reload();
                    hocPhanDaDangKy_reload();
                }
            });
        }
        function escapeHtml (string) {
            return String(string).replace(/[&<>"'`=\/]/g, function (s) {
                return entityMap[s];
            });
        }
        $('#dotDangKy').on('change', function () {
            dangKyHocPhan_sync();
        });
        $('#id_lop_chuyen_nganh').on('change', function () {
            dangKyHocPhan_sync();
        });

        $('#btnDangKyLopHocKem').on('click', function()
        {
            var id_lop_hoc_phan = $("input[name='idLopHocPhan']:checked").val();
            console.log(id_lop_hoc_phan);
            $.ajax({
                url: DANG_KY_LOP_HOC_PHAN_KEM,
                type: "PUT",
                data: {
                    'id_lop_hoc_phan_thuc_hanh': id_lop_hoc_phan,
                    'id_lop_hoc_phan_ly_thuyet' : ID_LOP_HOC_PHAN_LY_THUYET,
                    'id_dot_dang_ky' : ID_DOT_DANG_KY,
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        $('#modalDangKyKem').modal('toggle');
                        dangKyHocPhan_sync();
                        toastr.success(result.message, "Đăng ký học phần thành công!");
                        $('#modalDangKyKem').modal('close');
                        setTimeout(function () {
                        }, 500);
                    }
                    else {
                        toastr.error(result.message, "Đăng ký học phần thất bại!");
                    }
                }
            });
        });

        $(document).on('click', '.btnDangKyKem', function () {
            var data = JSON.parse($(this).attr('data'));
            console.log(data);
            var table = $("#tableMonHocKem");
            ID_LOP_HOC_PHAN_LY_THUYET = data.id_lop_hoc_phan;
            $.ajax({
                url: GET_LOP_THUC_HANH,
                type: "POST",
                data: {
                    'id_hoc_phan': data.id_hoc_phan
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        toastr.success('', "Lấy thông tin học phần thực hành thành công!");
                        table.find('tbody').empty();
                        for(var key in result.message)
                        {
                            var item = result.message[key];
                            table.find('tbody').append('<tr>' +
                                '<td>'+item.ma_lop_hoc_phan+'</td>' +
                                '<td>'+item.ten_hoc_phan+'</td>' +
                                '<td>'+item.so_luong+'</td>' +
                                '<td>'+item.so_luong_da_dang_ky+'</td>' +
                                '<td>'+item.ho_ten+'</td>' +
                                '<td>'+item.ten_phong+'</td>' +
                                '<td>'+item.ngay_hoc_chu+'</td>' +
                                '<td>'+item.tiet_ca+'</td>' +
                                '<td><input name="idLopHocPhan" value="'+item.id_lop_hoc_phan+'" type="radio" class="idLopHocPhan"></input></td>' +
                                '</tr>');
                        }
                    }
                    else {
                        toastr.error(result.message, "Lấy thông tin học phần thực hành thất bại!");
                    }
                }
            });
            $('#modalDangKyKem').modal('show');
        });
        $(document).on('click','.btnDangKy', function () {
            var data = JSON.parse($(this).attr('data'));
            console.log(data);
            $.ajax({
                url: DANG_KY_LOP_HOC_PHAN,
                type: "PUT",
                data: {
                    'id_lop_hoc_phan': data.id_lop_hoc_phan,
                    'id_dot_dang_ky': ID_DOT_DANG_KY,
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        dangKyHocPhan_sync();
                        toastr.success(result.message, "Đăng ký học phần thành công!");
                        setTimeout(function () {
                        }, 500);
                    }
                    else {
                        toastr.error(result.message, "Đăng ký học phần thất bại!");
                    }
                }
            });
        });

        $(document).on('click','.btnHuy', function () {
            var data = JSON.parse($(this).attr('data'));
            console.log(data);
            $.ajax({
                url: HUY_LOP_HOC_PHAN,
                type: "DELETE",
                data: {
                    'id_lop_hoc_phan': data.id_lop_hoc_phan,
                    'id_dot_dang_ky': ID_DOT_DANG_KY,
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        hocPhanDaDangKy_reload();
                        toastr.warning(result.message, "Hủy học phần phần thành công!");
                        dangKyHocPhan_sync();
                        setTimeout(function () {
                        }, 500);
                    }
                    else {
                        toastr.error(result.message, "Hủy học phần phần thất bại!");
                    }
                }
            });
        });
        $(document).ready(function () {
            dangKyHocPhan_sync();
        });
    </script>
@endsection
