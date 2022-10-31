@extends('auth.master')
@section('title') Quản lý thông tin Thời gian học @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Thời gian học
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
                                    <th>Loại</th>
                                    <th>Giờ bắt đầu</th>
                                    <th>Giờ kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                @foreach($data as $item)
                                    <tr>
                                        <td><b>{{ $item->tiet_ca }}</b></td>
                                        <td>{{$item->gio_bat_dau}}</td>
                                        <td>{{$item->gio_ket_thuc}}</td>
                                        <td>{{$item->trang_thai == 1 ? "Bật":"Tắt"}}</td>
                                        <td>{{$item->ngay_tao}}</td>
                                        <td>{{$item->ngay_cap_nhat}}</td>
                                        <td>
                                            <a class="itemCapNhat" href="#" data="{{toAttrJson($item)}}"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                                            <a class="itemXoa" href="#" data="{{$item->id_thoi_gian_hoc}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
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
                    <h4 class="modal-title text-bold">Thêm thông tin Thời gian học</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Loại (*)</label>
                            <select class="form-control tiet_ca">
                                <option value="Tiết">Tiết</option>
                                <option value="Ca">Ca</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Thời gian bắt đầu(*)</label>
                            <input class="form-control gio_bat_dau" type="time">
                        </div>
                        <div class="col-md-4">
                            <label for="">Thời gian kết thúc(*)</label>
                            <input class="form-control gio_ket_thuc" type="time">
                        </div>
                        <div class="col-md-4">
                            <label for="">Trạng thái(*)</label>
                            <select class="form-control trang_thai">
                                <option value="1">Bật</option>
                                <option value="0">Tắt</option>
                            </select>
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
        var PUT_THOI_GIAN = "{{ action('App\Http\Controllers\ThoiGianController@putThoiGian') }}";
        var DELETE_THOI_GIAN = "{{ action('App\Http\Controllers\ThoiGianController@postThoiGian') }}";
        var POST_THOI_GIAN = "{{ action('App\Http\Controllers\ThoiGianController@deleteThoiGian') }}";

        $(document).ready(function () {

            $('.btnThem').click(function () {
                $('.maNganhHoc, .tenNganhHoc').val('');
                $('#modalThem .modal-title').text('Thêm thông tin Thời gian học');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $('.itemCapNhat').click(function(){
                var data = JSON.parse($(this).attr('data'));
                $('.tiet_ca').val(data.tiet_ca);
                $('.gio_bat_dau').val(data.gio_bat_dau);
                $('.gio_ket_thuc').val(data.gio_ket_thuc);
                $('.trang_thai').val(data.trang_thai);
                $('.btnLuu').attr('data', data.id_thoi_gian_hoc).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {
                if (
                    isNULLorEmpty($('.gio_bat_dau').val())
                    || isNULLorEmpty($('.gio_ket_thuc').val())
                ) {
                    toastr.error("Không được bỏ trống trường nào!", "Thao tác thất bại");
                    return;
                }
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_THOI_GIAN,
                            type: "PUT",
                            data: {
                                'tiet_ca': $('.tiet_ca').val(),
                                'gio_bat_dau': $('.gio_bat_dau').val(),
                                'gio_ket_thuc': $('.gio_ket_thuc').val(),
                                'trang_thai': $('.trang_thai').val(),
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
                        var id_thoi_gian_hoc = $(this).attr('data');
                        $.ajax({
                            url: POST_THOI_GIAN,
                            type: "POST",
                            data: {
                                'id_thoi_gian_hoc': id_thoi_gian_hoc,
                                'tiet_ca': $('.tiet_ca').val(),
                                'gio_bat_dau': $('.gio_bat_dau').val(),
                                'gio_ket_thuc': $('.gio_ket_thuc').val(),
                                'trang_thai': $('.trang_thai').val(),
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

                var id = $(this).attr('data');
                $.ajax({
                    url: DELETE_THOI_GIAN,
                    type: "DELETE",
                    data: {
                        'id_thoi_gian_hoc': id,
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
