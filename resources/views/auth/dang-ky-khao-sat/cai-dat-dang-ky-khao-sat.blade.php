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
                    <button class="btn btn-success btnThem">Thêm mới</button>
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <th style="width: 100px;">Học kỳ</th>
                                    <th>Ngày mở</th>
                                    <th>Ngày đóng</th>
                                    <th style="width: 150px;">Cập nhật lúc</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                @foreach($ds as $item)
                                    <tr>
                                        <td><a href="{{action('App\Http\Controllers\KhaoSatDangKyHocPhanController@chiTiet', ['id_dang_ky_khao_sat'=>$item->id_dang_ky_khao_sat])}}">
                                                Chi tiết</a></td>
                                        <td>{{ $item->ten_hoc_ky}}</td>
                                        <td>{{ $item->ngay_mo}}</td>
                                        <td>{{ $item->ngay_dong}}</td>
                                        <td>{{ $item->ngay_cap_nhat}}</td>
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item) }}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_dang_ky_khao_sat }}" class="itemXoa" href="#"><i
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
                    <h4 class="modal-title text-bold">Thêm thông tin đợt khảo sát đăng ký môn</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Học kỳ (*)</label>
                            <select class="form-control idHocKy">
                                @foreach($hoc_ky as $item)
                                    <option value="{{$item->id_hoc_ky}}">{{$item->ten_nam_hoc .' - '. $item->ten_hoc_ky}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="">Ngày mở (*)</label>
                            <input class="form-control ngayMo" type="datetime-local" placeholder="Ngày mở" value="{{\Carbon\Carbon::today()->toDateTimeLocalString()}}">
                        </div>
                        <div class="col-md-12">
                            <label for="">Ngày đóng (*)</label>
                            <input class="form-control ngayDong" type="datetime-local" placeholder="Ngày đóng" value="{{\Carbon\Carbon::now()->setHour(0)->setMinute(0)->setSecond(0)->toDateTimeLocalString()}}">
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
        var PUT_DON_VI = "{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@them') }}";
        var DELETE_DON_VI = "{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@xoa') }}";
        var POST_DON_VI = "{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@sua') }}";

        $(document).ready(function () {

            $('.btnThem').click(function () {
                $('.idHocKy, .ngayMo, .ngayDong').val('');
                $('#modalThem .modal-title').text('Thêm thông tin đợt khảo sát đăng ký môn');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.idHocKy').val(data.id_dang_ky_khao_sat);
                $('.ngayMo').val(data.ngay_mo);
                $('.ngayDong').val(data.ngay_dong);
                $('#modalThem .modal-title').text('Cập nhật thông tin đợt khảo sát đăng ký môn');
                $('.btnLuu').attr('data', data.id_dang_ky_khao_sat).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.idHocKy').val())
                || isNULLorEmpty($('.ngayMo').val())
                || isNULLorEmpty($('.ngayDong').val())) {
                    toastr.error("Thông tin không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_DON_VI,
                            type: "PUT",
                            data: {
                                'id_hoc_ky': $('.idHocKy').val(),
                                'ngay_mo': $('.ngayMo').val(),
                                'ngay_dong': $('.ngayDong').val(),
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
                        break;

                    case 'update':
                        var id_dang_ky_khao_sat = $(this).attr('data');
                        $.ajax({
                            url: POST_DON_VI,
                            type: "POST",
                            data: {
                                'id_dang_ky_khao_sat': id_dang_ky_khao_sat,
                                'id_hoc_ky': $('.idHocKy').val(),
                                'ngay_mo': $('.ngayMo').val(),
                                'ngay_dong': $('.ngayDong').val(),
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
                        break;
                }
            });

            $('.itemXoa').click(function () {

                if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                    return;
                }

                var id_dang_ky_khao_sat = $(this).attr('data');
                $.ajax({
                    url: DELETE_DON_VI,
                    type: "DELETE",
                    data: {
                        'id_dang_ky_khao_sat': id_dang_ky_khao_sat,
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
