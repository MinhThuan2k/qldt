@extends('auth.master')
@section('title') Quản lý Thời khóa biểu @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">
                {{ $chiTiet->ma_lop_hoc_phan.' ('.$chiTiet->ten_hoc_phan.')' }}
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
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 90px;text-align: center">Tên phòng</th>
                                    <th style="width: 90px;text-align: center">Tiết (ca)</th>
                                    <th style="width: 90px">Ngày học</th>
                                    <th>Giảng viên</th>
                                    <th>Phân công dạy</th>
                                    <th style="width: 70px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ds as $item)
                                    <tr>
                                        <td style="text-align: center">{{ $item->ten_phong }}</td>
                                        <td style="text-align: center">{{ $item->tiet_ca }}</td>
                                        <td>{{ $item->ngay_hoc }}</td>
                                        <td>{{ $item->ho.' '.$item->ten }}</td>
                                        <td>{{ $item->phan_cong_day }}</td>
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item, ['id_thoi_khoa_bieu','id_lop_hoc_phan' ,'id_thoi_gian_hoc','id_phong', 'id_giang_vien','id_hoc_ky','phan_cong_day', 'ngay_hoc'])}}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_thoi_khoa_bieu }}" class="itemXoa" href="#"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>
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


    <div class="modal fade" id="modalThem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-bold">Thêm thông tin Thời khóa biểu</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Phòng học(*)</label>
                            <select class="form-control id_phong">
                                <option selected value="-1">Tên phòng học</option>
                                @foreach($dsPhongHoc as $item)
                                    <option value="{{$item->id_phong}}">{{$item->ten_phong}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Thời gian(*)</label>
                            <select class="form-control id_thoi_gian_hoc">
                                <option selected value="-1">Tiết (ca)</option>
                                @foreach($dsThoiGian as $item)
                                    <option value="{{$item->id_thoi_gian_hoc}}">{{$item->tiet_ca.' ('.$item->gio_bat_dau.'-'.$item->gio_ket_thuc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Giảng viên(*)</label>
                            <select class="form-control id_giang_vien">
                                <option selected value="-1">Tên giảng viên</option>
                                @foreach($dsGiangVien as $item)
                                    <option value="{{$item->id_giang_vien}}">{{$item->ho.' '.$item->ten.' ('.$item->ma_don_vi.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Học kỳ(*)</label>
                            <select class="form-control id_hoc_ky">
                                <option selected value="-1">Học kỳ</option>
                                @foreach($dsHocKy as $item)
                                    <option value="{{$item->id_hoc_ky}}">{{$item->ten_hoc_ky .' ('.$item->ten_nam_hoc.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Phân công dạy</label>
                            <input class="form-control phanCongDay" type="text">
                        </div>
                        <div class="col-md-6">
                            <label>Ngày học</label>
                            <input type="date" class="form-control pull-right ngayHoc">
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

        var PUT_THOIKHOABIEU = '{{ action('App\Http\Controllers\ThoiKhoaBieuController@putTKB') }}';
        var POST_THOIKHOABIEU = '{{ action('App\Http\Controllers\ThoiKhoaBieuController@postTKB') }}';
        var DELETE_THOIKHOABIEU = '{{ action('App\Http\Controllers\ThoiKhoaBieuController@deleteTKB') }}';

        $(document).ready(function () {

            $('.table').dataTable({
                "ordering": false,
            });

            $('.btnThem').click(function () {
                $('.id_phong').val(-1);
                $('.id_thoi_gian_hoc').val(-1);
                $('.id_giang_vien').val(-1);
                $('.id_hoc_ky').val(-1);
                $('.phanCongDay').val('');
                $('.ngayHoc').val('');

                $('#modalThem .modal-title').text('Thêm thông tin Thời khóa biểu');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));

                $('.id_phong').val(data.id_phong);
                $('.id_thoi_gian_hoc').val(data.id_thoi_gian_hoc);
                $('.id_giang_vien').val(data.id_giang_vien);
                $('.id_hoc_ky').val(data.id_hoc_ky);
                $('.phanCongDay').val(data.phan_cong_day);
                $('.ngayHoc').val(data.ngay_hoc);

                $('#modalThem .modal-title').text('Cập nhật thông tin Thời khóa biểu');
                $('.btnLuu').attr('data', data.id_thoi_khoa_bieu).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if ($('.id_phong').val()=="-1"){
                    toastr.error("Hãy chọn phòng học", "Thao tác thất bại");
                    return;
                }
                if ($('.id_thoi_gian_hoc').val()=="-1"){
                    toastr.error("Hãy chọn thời gian học", "Thao tác thất bại");
                    return;
                }
                if ($('.id_giang_vien').val()=="-1"){
                    toastr.error("Hãy chọn giảng viên", "Thao tác thất bại");
                    return;
                }
                if ($('.id_hoc_ky').val()=="-1"){
                    toastr.error("Hãy chọn học kỳ", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmptyNumBer($('.ngayHoc').val())) {
                    toastr.error("Ngày học không được bỏ trống", "Thao tác thất bại");
                    return;
                }



                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_THOIKHOABIEU,
                            type: "PUT",
                            data: {
                                'id_lop_hoc_phan': {{ $chiTiet->id_lop_hoc_phan }},
                                'id_phong': $('.id_phong').val(),
                                'id_thoi_gian_hoc': $('.id_thoi_gian_hoc').val(),
                                'id_giang_vien': $('.id_giang_vien').val(),
                                'id_hoc_ky': $('.id_hoc_ky').val(),
                                'ngay_hoc': $('.ngayHoc').val(),
                                'phan_cong_day': $('.phanCongDay').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    toastr.success(result.message, "Thao tác thành công");
                                    // $('.table').DataTable().ajax.reload();
                                    $('#modalThem').modal('toggle');
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 500);
                                } else {
                                    toastr.error(result.message, "Thao tác thất bại");
                                }
                            }
                        });
                        break;

                    case 'update':
                        var id_thoi_khoa_bieu = $(this).attr('data');
                        $.ajax({
                            url: POST_THOIKHOABIEU,
                            type: "POST",
                            data: {
                                'id_lop_hoc_phan': {{ $chiTiet->id_lop_hoc_phan }},
                                'id_phong': $('.id_phong').val(),
                                'id_thoi_gian_hoc': $('.id_thoi_gian_hoc').val(),
                                'id_giang_vien': $('.id_giang_vien').val(),
                                'id_hoc_ky': $('.id_hoc_ky').val(),
                                'ngay_hoc': $('.ngayHoc').val(),
                                'phan_cong_day': $('.phanCongDay').val(),
                                'id_thoi_khoa_bieu': id_thoi_khoa_bieu,
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    toastr.success(result.message, "Thao tác thành công");
                                    // $('.table').DataTable().ajax.reload();
                                    $('#modalThem').modal('toggle');
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 500);
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

                var id_thoi_khoa_bieu= $(this).attr('data');

                $.ajax({
                    url: DELETE_THOIKHOABIEU,
                    type: "DELETE",
                    data: {
                        'id_thoi_khoa_bieu': id_thoi_khoa_bieu,
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            // $('.table').DataTable().ajax.reload();
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
