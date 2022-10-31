@extends('auth.master')
@section('title') Thông tin năm học @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin năm học
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
                                    <th style="width: 150px;">Mã năm học</th>
                                    <th style="width: 250px;">Tên năm học</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 150px;">Cập nhật lúc</th>
                                </tr>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $item->ma_nam_hoc }}</td>
                                        <td>{{ $item->ten_nam_hoc }}</td>
                                        <td>{{ $item->ngay_tao }}</td>
                                        <td>{{ $item->ngay_cap_nhat }}</td>
                                        <td class="text-center">
                                            <a class="itemCapNhat" href="#" data="{{ toAttrJson($item, ['id_nam_hoc', 'ma_nam_hoc', 'ten_nam_hoc']) }}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a class="itemXoa" data="{{ $item->id_nam_hoc}}" href="#">
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
                    <h4 class="modal-title text-bold">Thêm thông tin năm học</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Mã năm học (*)</label>
                            <input class="form-control maNamHoc" type="text" placeholder="Mã năm học">
                        </div>
                        <div class="col-md-9">
                            <label for="">Tên năm học (*)</label>
                            <input class="form-control tenNamHoc" type="text" placeholder="Tên năm học">
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

        var PUT_NAM_HOC = "{{ action('App\Http\Controllers\NamHocController@putNamHoc') }}";
        var DELETE_NAM_HOC = "{{ action('App\Http\Controllers\NamHocController@deleteNamHoc') }}";
        var POST_NAM_HOC = "{{ action('App\Http\Controllers\NamHocController@postNamHoc') }}";


        $(document).ready(function () {

            $('.btnThem').click(function () {
                $('.maNamHoc, .tenNamHoc').val('');
                $('#modalThem .modal-title').text('Thêm thông Năm học');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show')
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.maNamHoc').val(data.ma_nam_hoc);
                $('.tenNamHoc').val(data.ten_nam_hoc);
                $('#modalThem .modal-title').text('Cập nhật thông tin năm học');
                $('.btnLuu').attr('data', data.id_nam_hoc).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.maNamHoc').val())) {
                    toastr.error("Mã năm học không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.tenNamHoc').val())) {
                    toastr.error("Tên năm học không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_NAM_HOC,
                            type: "PUT",
                            data: {
                                'ma_nam_hoc': $('.maNamHoc').val(),
                                'ten_nam_hoc': $('.tenNamHoc').val(),
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
                        var id_nam_hoc = $(this).attr('data');
                        $.ajax({
                            url: POST_NAM_HOC,
                            type: "POST",
                            data: {
                                'id_nam_hoc': id_nam_hoc,
                                'ma_nam_hoc': $('.maNamHoc').val(),
                                'ten_nam_hoc': $('.tenNamHoc').val(),
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
                    url: DELETE_NAM_HOC,
                    type: "DELETE",
                    data: {
                        'id_nam_hoc': id,
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
