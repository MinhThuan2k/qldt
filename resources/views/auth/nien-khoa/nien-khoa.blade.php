@extends('auth.master')
@section('title') Thông tin niên khóa @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin khóa học
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
                                    <th style="width: 150px;">Mã khóa học</th>
                                    <th>Năm nhập học</th>
                                    <th style="width: 150px;">Niên khóa</th>
                                    <th>Năm hết hạn</th>
                                    <th style="width: 150px;">Ngày tạo</th>
                                    <th style="width: 150px;">Ngày cập nhập</th>
                                </tr>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $item->ma_khoa_hoc }}</td>
                                        <td>{{ $item->nam_nhap_hoc }}</td>
                                        <td>{{ $item->nien_khoa }}</td>
                                        <td>{{ $item->nam_het_han }}</td>
                                        <td>{{ $item->ngay_tao }}</td>
                                        <td>{{ $item->ngay_cap_nhat }}</td>
                                        <td class="text-center">
                                            <a class="itemCapNhat" href="#" data="{{ toAttrJson($item, ['id_khoa_hoc', 'ma_khoa_hoc', 'nam_nhap_hoc', 'nien_khoa', 'nam_het_han']) }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a class="itemXoa" data="{{ $item->id_khoa_hoc}}" href="#">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
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
                    <h4 class="modal-title text-bold">Thêm thông tin khóa học</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Mã khóa học (*)</label>
                            <input class="form-control maKhoaHoc" type="text" placeholder="Mã khóa học">
                        </div>
                        <div class="col-md-6">
                            <label for="">Năm nhập học (*)</label>
                            <input class="form-control namNhapHoc" type="text" placeholder="Năm nhập học">
                        </div>
                        <div class="col-md-6">
                            <label for="">Niên Khóa (*)</label>
                            <input class="form-control nienKhoa" type="text" placeholder="Niên Khoa">
                        </div>
                        <div class="col-md-6"   >
                            <label for="">Năm hết hạn</label>
                            <input class="form-control namHetHan" type="text" placeholder="Năm hết hạn">
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

        var PUT_NIEN_KHOA = "{{ action('App\Http\Controllers\NienKhoaController@putNienKhoa') }}";
        var DELETE_NIEN_KHOA = "{{ action('App\Http\Controllers\NienKhoaController@deleteNienKhoa') }}";
        var POST_NIEN_KHOA = "{{ action('App\Http\Controllers\NienKhoaController@postNienKhoa') }}";


        $(document).ready(function () {

            $('.btnThem').click(function () {
                $(' .maKhoaHoc, .namNhapHoc, .nienKhoa, .namHetHan').val('');
                $('#modalThem .modal-title').text('Thêm thông khóa học');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show')
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.maKhoaHoc').val(data.ma_khoa_hoc);
                $('.namNhapHoc').val(data.nam_nhap_hoc);
                $('.nienKhoa').val(data.nien_khoa);
                $('.namHetHan').val(data.nam_het_han);
                $('#modalThem .modal-title').text('Cập nhật thông tin khóa học');
                $('.btnLuu').attr('data', data.id_chuong_trinh).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.maKhoaHoc').val())) {
                    toastr.error("Mã khóa học không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.namNhapHoc').val())) {
                    toastr.error("Năm nhập học không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.nienKhoa').val())) {
                    toastr.error("Niên khóa không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if ($('.namHetHan').val() <= $('.namNhapHoc').val()) {
                    toastr.error("Năm hết hạn không được nhỏ hơn năm nhập học", "Thao tác thất bại");
                    return;
                }

                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_NIEN_KHOA,
                            type: "PUT",
                            data: {
                                'ma_khoa_hoc': $('.maKhoaHoc').val(),
                                'nam_nhap_hoc': $('.namNhapHoc').val(),
                                'nien_khoa': $('.nienKhoa').val(),
                                'nam_het_han': $('.namHetHan').val(),
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
                        var id_khoa_hoc = $(this).attr('data');
                        $.ajax({
                            url: POST_NIEN_KHOA,
                            type: "POST",
                            data: {
                                'id_khoa_hoc': id_khoa_hoc,
                                'ma_khoa_hoc': $('.maKhoaHoc').val(),
                                'nam_nhap_hoc': $('.namNhapHoc').val(),
                                'nien_khoa': $('.nienKhoa').val(),
                                'nam_het_han': $('.namHetHan').val()
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

                var id_khoa_hoc = $(this).attr('data');
                $.ajax({
                    url: DELETE_NIEN_KHOA,
                    type: "DELETE",
                    data: {
                        'id_khoa_hoc': id_khoa_hoc,
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
