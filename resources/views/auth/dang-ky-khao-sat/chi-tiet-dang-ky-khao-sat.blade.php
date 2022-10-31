@extends('auth.master')
@section('title') Quản lý việc khảo sát đăng ký học phần @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">
                Quản lý việc khảo sát đăng ký học phần
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success btnDuyetCheck" >Duyệt</button>
                    <button class="btn btn-danger btnKhongDuyetCheck" >Không duyệt</button>
                    <button class="btn btn-primary btnCaiDat" style="float:right;"><i class="fa fa-cogs"></i></button>
                    <button class="btn btn-info btnTaoDeXuat" style="float:right;">Tạo đề xuất</button>
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover" id="tableHienThi">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;" id="checkHet">
                                        <input type="checkbox" class=" btnChonHet" data="false">
                                    </th>
                                    <th>Tên học phần</th>
                                    <th style="width: 80px">Số lượng</th>
                                    <th class="text-center" style="width: 150px">Đề xuất</th>
                                    <th class="text-center" style="width: 80px">Tùy chỉnh</th>
                                    <th style="width: 40px" rowspan="2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ds as $item)
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle">
                                            <input type="checkbox" class="checkXuLy" value="{{ $item->id_hoc_phan }}">
                                        </td>
                                        <td style="vertical-align: middle">{{$item->ten_hoc_phan}}</td>
                                        <td class="text-center" style="vertical-align: middle">{{$item->so_luong}}</td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <b>Lý thuyết:</b>
                                            @if($item->so_luong_lop_lt) {{$item->so_luong_lop_lt}}
                                            @else 0
                                            @endif lớp <br>

                                            <b>Thực hành:</b>
                                            @if($item->so_luong_lop_th) {{$item->so_luong_lop_th}}
                                            @else 0
                                            @endif lớp
                                        </td>
                                        <td class="text-center _{{ $item->id_hoc_phan }}" style="vertical-align: middle" >
                                        </td>
                                        <td style="vertical-align: middle">
                                            <button type="button" class="btn btn-block btn-primary btn-sm btnTuyChinh"
                                                    data="{{ toAttrJson($item) }}">
                                                Tùy chỉnh</button>
                                        </td>
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





    <div class="modal fade" id="modalTuyChinh" data="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close xoaDataTable" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tùy chỉnh lớp học phần</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-success btnThemLop" >Thêm lớp</button>
                            <span style="float: right">Tổng số lượng đăng ký: <strong class="so_luong">90</strong></span>
                            <div class="box">
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover" id="tablelopHocPhan">
                                        <thead>
                                        <tr>
                                            <th>Tên lớp</th>
                                            <th>Số lượng</th>
                                            <th>Loại lớp</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary xoaDataTable" data-dismiss="modal">Đóng</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->




    <div class="modal fade" id="modalCaiDat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Cài đặt tạo lớp học phần</b></h4>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <td>Chỗ trống dự phòng:</td>
                                        <td>
                                            <input class="center soDuPhong" type="text" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 350px;"><h4><strong>Lớp lý thuyết</strong></h4></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng lớp tối đa:</td>
                                        <td>
                                            <input class="center soLopLT" type="text" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 350px;">Số lượng sinh viên tối thiểu 1 lớp:</td>
                                        <td>
                                            <input class="center svToiThieuLT" type="text" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng sinh viên mặc định 1 lớp:</td>
                                        <td>
                                            <input class="center svMacDinhLT" type="text" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng sinh viên tối đa 1 lớp:</td>
                                        <td>
                                            <input class="center svToiDaLT" type="text" value="">
                                        </td>
                                    </tr>


                                    <tr>
                                        <th style="width: 350px;"><h4><strong>Lớp thực hành</strong></h4></th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng lớp tối đa:</td>
                                        <td>
                                            <input class="center soLopTH" type="text" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 350px;">Số lượng sinh viên tối thiểu 1 lớp:</td>
                                        <td>
                                            <input class="center svToiThieuTH" type="text" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng sinh viên mặc định 1 lớp:</td>
                                        <td>
                                            <input class="center svMacDinhTH" type="text" value="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số lượng sinh viên tối đa 1 lớp:</td>
                                        <td>
                                            <input class="center svToiDaTH" type="text" value="">
                                        </td>
                                    </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btnLuuCaiDat">Lưu thay đổi</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->





@endsection


@section('script')
    <script>

        var GET_CAI_DAT = '{{action('App\Http\Controllers\KhaoSatDangKyHocPhanController@getCaiDatLopHocPhan')}}';
        var UPDATE_CAI_DAT = '{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@updateCaiDatLopHocPhan') }}';
        var TAO_DE_XUAT = '{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@taoLopDeXuat',$id_dang_ky_khao_sat) }}';
        var GET_DATATABLE = '{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@getDataTable',$id_dang_ky_khao_sat) }}';

        var THEM_LOP_DE_XUAT = '{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@themLopDeXuat',$id_dang_ky_khao_sat) }}';
        var SUA_LOP_DE_XUAT = '{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@suaLopDeXuat') }}';
        var XOA_LOP_DE_XUAT = '{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@xoaLopDeXuat') }}';

        var DUYET_LOP_DE_XUAT = '{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@duyetLopDeXuat',$id_dang_ky_khao_sat) }}';
        var XOA_DUYET_LOP_DE_XUAT = '{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@xoaDuyetLopDeXuat',$id_dang_ky_khao_sat) }}';


        $(document).ready(function () {

            $('.xoaDataTable').click(function (){
                $('#tablelopHocPhan').DataTable().destroy();
            });


            $('.btnChonHet').click(function (){
                if ($(this).attr('data')==='false') {
                    $('.checkXuLy').prop('checked',true);
                    $(this).attr('data','true');
                }else {
                    $('.checkXuLy').prop('checked',false);
                    $(this).attr('data','false');
                }
            });

            $('.checkXuLy').change(function (){
                var btnChonHet = $('.btnChonHet');
                if (btnChonHet.attr('data')==='true'){
                    btnChonHet.prop('checked',false);
                    btnChonHet.attr('data','false');
                }

            });

            $('.btnCaiDat').click(function (){
                $('.modal-title').html('<b>Cài đặt tạo lớp học phần</b>');
                $.ajax({
                    url: GET_CAI_DAT,
                    type: "GET",
                    data: {
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        $('.soLopLT').val(result.lopLT.so_luong_lop_toi_da);
                        $('.svToiDaLT').val(result.lopLT.so_luong_toi_da);
                        $('.svMacDinhLT').val(result.lopLT.so_luong_mac_dinh);
                        $('.svToiThieuLT').val(result.lopLT.so_luong_toi_thieu);

                        $('.soLopTH').val(result.lopTH.so_luong_lop_toi_da);
                        $('.svToiDaTH').val(result.lopTH.so_luong_toi_da);
                        $('.svMacDinhTH').val(result.lopTH.so_luong_mac_dinh);
                        $('.svToiThieuTH').val(result.lopTH.so_luong_toi_thieu);

                        $('.soDuPhong').val(result.lopTH.so_luong_du_phong);

                    }
                });
                $('#modalCaiDat').modal('show');
            });

            $('.btnLuuCaiDat').click(function (){
                var soDuPhong = $('.soDuPhong').val();

                $.ajax({
                    url: UPDATE_CAI_DAT,
                    type: "POST",
                    data: {
                        'so_luong_toi_thieu_lt': $('.svToiThieuLT').val(),
                        'so_luong_mac_dinh_lt': $('.svMacDinhLT').val(),
                        'so_luong_toi_da_lt': $('.svToiDaLT').val(),
                        'so_luong_lop_toi_da_lt': $('.soLopLT').val(),
                        'so_luong_du_phong_lt': soDuPhong,

                        'so_luong_toi_thieu_th': $('.svToiThieuTH').val(),
                        'so_luong_mac_dinh_th': $('.svMacDinhTH').val(),
                        'so_luong_toi_da_th': $('.svToiDaTH').val(),
                        'so_luong_lop_toi_da_th': $('.soLopTH').val(),
                        'so_luong_du_phong_th': soDuPhong,
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            $('#modalCaiDat').modal('hide');
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }

                    }
                });
            });


            $('.btnTaoDeXuat').click(function (){
                $.ajax({
                    url: TAO_DE_XUAT,
                    type: "POST",
                    data: {
                        'id_hoc_ky' : 6,
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




            $(document).on('click','.btnTuyChinh',function (){
                var data = JSON.parse($(this).attr('data'));
                $('.modal-title').html('<b>Tách lớp học phần ' + data.ten_hoc_phan + ' (' + data.tin_chi_lt + ':' + data.tin_chi_th+')</b>');
                $('.so_luong').html(data.so_luong);
                $('#modalTuyChinh').attr('data',data.id_hoc_phan);



                $('#tablelopHocPhan').dataTable({
                    "bLengthChange": false,
                    searching: false,
                    "ordering": false,
                    ajax:{
                        "url": GET_DATATABLE,
                        "dataSrc": "",
                        "type": "GET",
                        "data": {
                            'id_hoc_phan' : data.id_hoc_phan,
                        },
                    },
                    "columns": [
                        {"data": "ma_lop_hoc_phan_de_xuat"},
                        {"data": "so_luong"},
                        {"data": "loai_lop_hoc_phan_de_xuat"},
                        {"data": null},
                    ],
                    "columnDefs": [
                        {
                            "targets": 1,
                            "data": "so_luong",
                            "render": function (data, type, row, meta) {
                                return '<input class="form-control soLuong soLuong'+row.id_lop_hoc_phan_de_xuat+'" ' +
                                    'data="'+row.id_lop_hoc_phan_de_xuat+'" value="'+ data +'">';
                            }
                        },
                        {
                            "targets": -2,
                            "data": "loai_lop_hoc_phan_de_xuat",
                            "render": function (data, type, row, meta) {
                                if (data === 0)
                                    return '<select class="form-control selectLoaiLop loaiLop'+row.id_lop_hoc_phan_de_xuat+'" ' +
                                                'data="'+ row.id_lop_hoc_phan_de_xuat +'">\
                                                <option value="0" selected>Lý thuyết</option>\
                                                <option value="1">Thực hành</option>\
                                            </select>';
                                return '<select class="form-control selectLoaiLop loaiLop'+row.id_lop_hoc_phan_de_xuat+'" ' +
                                            'data="'+ row.id_lop_hoc_phan_de_xuat +'">\
                                            <option value="0">Lý thuyết</option>\
                                            <option value="1" selected>Thực hành</option>\
                                        </select>';
                            }
                        },
                        {
                            "targets": -1,
                            "data": null,
                            "render": function (data, type, row, meta) {
                                return '<a class="itemCapNhat save'+row.id_lop_hoc_phan_de_xuat+'" href="#" data="'+
                                    row.id_lop_hoc_phan_de_xuat +
                                    '" style="margin-right: 10px; visibility: hidden" ><i class="fa fa-check" aria-hidden="true"></i></a>' +
                                    '<a class="itemXoa" href="#" data="'+
                                    row.id_lop_hoc_phan_de_xuat +
                                    '"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            }
                        },
                    ]

                });


                $('#modalTuyChinh').modal('show');
            });


            $('.btnThemLop').click(function (){
                $.ajax({
                    url: THEM_LOP_DE_XUAT,
                    type: "PUT",
                    data: {
                        'loai_lop_hoc_phan_de_xuat': 0,
                        'id_hoc_ky': 6,
                        'id_hoc_phan': $('#modalTuyChinh').attr('data'),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            $('td._'+$('#modalTuyChinh').attr('data')).html('<span class="label label-success">Đã chỉnh sửa</span>');
                            $('#tablelopHocPhan').DataTable().ajax.reload();
                        }

                    }
                });
            });


            $(document).on('change','.selectLoaiLop',function (){
                $('td._'+$('#modalTuyChinh').attr('data')).html('<span class="label label-success">Đã chỉnh sửa</span>');

                $('.save'+$(this).attr('data')).css('visibility','visible');
            });

            $(document).on('keyup','.soLuong',function (){
                $('td._'+$('#modalTuyChinh').attr('data')).html('<span class="label label-success">Đã chỉnh sửa</span>');

                $('.save'+$(this).attr('data')).css('visibility','visible');
            });

            $(document).on('click','.itemCapNhat',function (){
                var item = $(this);
                $.ajax({
                    url: SUA_LOP_DE_XUAT,
                    type: "POST",
                    data: {
                        'id_hoc_phan': $('#modalTuyChinh').attr('data'),
                        'loai_lop_hoc_phan_de_xuat': $('.loaiLop'+$(this).attr('data')).val(),
                        'so_luong': $('.soLuong'+$(this).attr('data')).val(),
                        'id_lop_hoc_phan_de_xuat': $(this).attr('data'),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            item.css('visibility','hidden');
                            $('#tablelopHocPhan').DataTable().ajax.reload();
                        }
                    }
                });
            });

            $(document).on('click','.itemXoa',function (){

                $.ajax({
                    url: XOA_LOP_DE_XUAT,
                    type: "DELETE",
                    data: {
                        'id_lop_hoc_phan_de_xuat': $(this).attr('data'),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            $('#tablelopHocPhan').DataTable().ajax.reload();
                        }
                    }
                });
            });





            $('.btnDuyetCheck').click(function (){

                var mang = [];

                $('#tableHienThi :checked').each(function (){
                    if ($(this).val() !== 'on')
                        mang.push($(this).val());
                });

                $.ajax({
                    url: DUYET_LOP_DE_XUAT,
                    type: "PUT",
                    data: {
                        'mang_id_hoc_phan': mang,
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


            $('.btnKhongDuyetCheck').click(function (){

                if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                    return;
                }

                var mang = [];

                $('#tableHienThi :checked').each(function (){
                    if ($(this).val() !== 'on')
                        mang.push($(this).val());
                });

                $.ajax({
                    url: XOA_DUYET_LOP_DE_XUAT,
                    type: "DELETE",
                    data: {
                        'mang_id_hoc_phan': mang,
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
@endsection

