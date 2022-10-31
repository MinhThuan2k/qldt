@extends('auth.master')
@section('title') Quản lý thông tin Chi tiết lớp học phần @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">
                {{ $ten_don_vi  }}/Lớp học phần/{{ $chiTiet->ma_lop_hoc_phan }}
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonViCT', $id_don_vi) }}"><i
                            class="fa fa-dashboard"></i>
                        {{ $ten_don_vi  }}
                    </a></li>
                <li><a href="{{ action('App\Http\Controllers\LopHocPhanController@getLopHocPhan', $id_don_vi) }}">
                        Lớp học phần
                    </a></li>
                <li class="active">{{ $chiTiet->ma_lop_hoc_phan  }}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success btnThem">Thêm mới</button>
                    <a href="{{ action('App\Http\Controllers\LopHocPhanController@exportExcel',$chiTiet->id_lop_hoc_phan) }}"><button class="btn btn-success btnExport">Export Excel</button></a>
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th style="width: 90px; text-align: center">Điểm 10%</th>
                                    <th style="width: 90px; text-align: center">Điểm 40%</th>
                                    <th style="width: 90px; text-align: center">Điểm 50%</th>
                                    <th style="width: 150px; text-align: center">Cập nhật lúc</th>
                                    <th style="width: 70px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalThem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-bold">Thêm thông tin</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Tên học viên(*)</label>
                            <select class="form-control id_hoc_vien">
                                <option selected value="-1">Tên học viên</option>
                                @foreach($dsHocVien as $item)
                                    <option value="{{$item->id_hoc_vien}}">{{$item->ho.' '.$item->ten.' ('.$item->cmnd.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Điểm 10%</label>
                            <input class="form-control diem_10" type="number" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="">Điểm 40%</label>
                            <input class="form-control diem_40" type="number" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="">Điểm 50%</label>
                            <input class="form-control diem_50" type="number" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        var PUT_LOP_HOC_PHAN_CHI_TIET = "{{ action('App\Http\Controllers\LopHocPhanController@putLopHocPhanChiTiet', $chiTiet->id_lop_hoc_phan) }}";
        var DELETE_LOP_HOC_PHAN_CHI_TIET = "{{ action('App\Http\Controllers\LopHocPhanController@deleteLopHocPhanChiTiet', $chiTiet->id_lop_hoc_phan) }}";
        var POST_LOP_HOC_PHAN_CHI_TIET = "{{ action('App\Http\Controllers\LopHocPhanController@postLopHocPhanChiTiet', $chiTiet->id_lop_hoc_phan) }}";
        var GET_DATATABLE = "{{ action('App\Http\Controllers\LopHocPhanController@getDataTable',$chiTiet->id_lop_hoc_phan) }}"

        $(document).ready(function () {

            $('.table').dataTable({
                "ordering": false,
                // "ajax": GET_DATATABLE,
                ajax:{
                    "url": GET_DATATABLE,
                    "dataSrc": "",
                    "type": "GET",
                    "data": "",
                },
                "columns": [
                    {"data": "ten"},
                    {"data": "diem_10"},
                    {"data": "diem_40"},
                    {"data": "diem_50"},
                    {"data": "ngay_cap_nhat"},
                    {"data": "button"},
                ],
                "columnDefs": [
                    {className: 'text-left', targets: [0]},
                    {className: 'text-center', targets: [1,2,3,4]},
                    {
                        "targets": 0,
                        "data": "ten",
                        "render": function (data, type, row, meta) {
                            return row.ho + ' ' + row.ten;
                        }
                    },
                    {
                        "targets": -1,
                        "data": "button",
                        "render": function (data, type, row, meta) {
                            return '<a diem_10 = "'+row.diem_10+
                                        '" diem_40 = "'+row.diem_40+
                                        '" diem_50 = "'+row.diem_50+
                                        '" id_hoc_vien = "'+row.id_hoc_vien+
                                        '" id_lop_hoc_phan = "'+row.id_lop_hoc_phan+
                                        '" class="itemCapNhat" href="#">\
                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>\
                                <a data1="'+row.id_hoc_vien+'"\
                                        data2="'+row.id_lop_hoc_phan+'"\
                                        class="itemXoa" href="#"><i\
                                        class="fa fa-trash" aria-hidden="true"></i></a>';
                        }
                    },
                ]

            });
            $('.btnThem').click(function () {
                $('.diem_10, .diem_40,.diem_50').val(0);
                $('.id_hoc_vien').val("-1");
                $('.id_hoc_vien').attr("disabled", false);
                $('#modalThem .modal-title').text('Thêm thông tin chi tiết');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                // var data = JSON.parse($(this).attr('data'));
                $('.diem_10').val($(this).attr('diem_10'));
                $('.diem_40').val($(this).attr('diem_40'));
                $('.diem_50').val($(this).attr('diem_50'));
                $('.id_hoc_vien').val($(this).attr('id_hoc_vien'));
                $('.id_hoc_vien').attr("disabled", true);
                $('#modalThem .modal-title').text('Cập nhật thông tin chi tiết');
                $('.btnLuu').attr('data1', $(this).attr('id_lop_hoc_phan')).attr('data2',$(this).attr('id_hoc_vien')).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if ($('.id_hoc_vien').val()=="-1"){
                    toastr.error("Hãy chọn học viên", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmptyNumBer($('.diem_10').val())) {
                    toastr.error("Điểm 10% không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmptyNumBer($('.diem_40').val())) {
                    toastr.error("Điểm 40% không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmptyNumBer($('.diem_50').val())) {
                    toastr.error("Điểm 50% không được bỏ trống", "Thao tác thất bại");
                    return;
                }



                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_LOP_HOC_PHAN_CHI_TIET,
                            type: "PUT",
                            data: {
                                'id_lop_hoc_phan': {{ $chiTiet->id_lop_hoc_phan }},
                                'id_hoc_vien': $('.id_hoc_vien').val(),
                                'diem_10': $('.diem_10').val(),
                                'diem_40': $('.diem_40').val(),
                                'diem_50': $('.diem_50').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    toastr.success(result.message, "Thao tác thành công");
                                    $('.table').DataTable().ajax.reload();
                                    $('#modalThem').modal('toggle');
                                    // setTimeout(function () {
                                    //     window.location.reload();
                                    // }, 500);
                                } else {
                                    toastr.error(result.message, "Thao tác thất bại");
                                }
                            }
                        });
                        break;

                    case 'update':
                        var id_lop_hoc_phan = $(this).attr('data1');
                        var id_hoc_vien = $(this).attr('data2');
                        $.ajax({
                            url: POST_LOP_HOC_PHAN_CHI_TIET,
                            type: "POST",
                            data: {
                                'id_lop_hoc_phan': id_lop_hoc_phan,
                                'id_hoc_vien': id_hoc_vien,
                                'diem_10': $('.diem_10').val(),
                                'diem_40': $('.diem_40').val(),
                                'diem_50': $('.diem_50').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    toastr.success(result.message, "Thao tác thành công");
                                    $('.table').DataTable().ajax.reload();
                                    $('#modalThem').modal('toggle');
                                    // setTimeout(function () {
                                    //     window.location.reload();
                                    // }, 500);
                                } else {
                                    toastr.error(result.message, "Thao tác thất bại");
                                }
                            }
                        });
                        break;
                }
            });

            $(document).on('click', '.itemXoa', function () {

                if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                    return;
                }

                var id_hoc_vien= $(this).attr('data1');
                var id_lop_hoc_phan= $(this).attr('data2');

                $.ajax({
                    url: DELETE_LOP_HOC_PHAN_CHI_TIET,
                    type: "DELETE",
                    data: {
                        'id_hoc_vien': id_hoc_vien,
                        'id_lop_hoc_phan': id_lop_hoc_phan,
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            $('.table').DataTable().ajax.reload();
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }
                    }
                });
            });
        });
    </script>
@endsection
