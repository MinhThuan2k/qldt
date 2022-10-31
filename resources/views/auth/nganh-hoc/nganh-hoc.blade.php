@extends('auth.master')
@section('title') Quản lý thông tin Ngành đào tạo @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Ngành đào tạo
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
                                    <th style="width: 100px;">Mã ngành</th>
                                    <th style="width: 300px;">Tên ngành</th>
                                    <th style="width: 70px;">Ngày cập nhật</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                @foreach($data as $item)
                                    <tr>
                                        <td><b>{{ $item->ma_nganh }}</b></td>
                                        <td>{{$item->ten_nganh}}</td>
                                        <td>{{$item->ngay_cap_nhat}}</td>
                                        <td>
                                            <a class="itemCapNhat" href="#" data="{{toAttrJson($item,['id_nganh','ma_nganh','ten_nganh'])}}"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                                            <a class="itemXoa" href="#" data="{{$item->id_nganh}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
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
                    <h4 class="modal-title text-bold">Thêm thông tin Ngành đào tạo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Mã Ngành (*)</label>
                            <input class="form-control maNganhHoc" type="text" placeholder="Mã Ngành đào tạo">
                        </div>
                        <div class="col-md-9">
                            <label for="">Tên Ngành (*)</label>
                            <input class="form-control tenNganhHoc" type="text" placeholder="Tên Ngành đào tạo">
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
        var PUT_NGANH_HOC = "{{ action('App\Http\Controllers\NganhHocController@putNganhHoc') }}";
        var DELETE_NGANH_HOC = "{{ action('App\Http\Controllers\NganhHocController@deleteNganhHoc') }}";
        var POST_NGANH_HOC = "{{ action('App\Http\Controllers\NganhHocController@postNganhHoc') }}";

        $(document).ready(function () {

            $('.btnThem').click(function () {
                $('.maNganhHoc, .tenNganhHoc').val('');
                $('#modalThem .modal-title').text('Thêm thông tin Ngành Đào Tạo');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $('.itemCapNhat').click(function(){
                var data = JSON.parse($(this).attr('data'));
                $('.maNganhHoc').val(data.ma_nganh);
                $('.tenNganhHoc').val(data.ten_nganh);
                $('#modalThem .modal-title').text('Cập nhật thông tin Ngành Đào Tạo');
                $('.btnLuu').attr('data', data.id_nganh).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.maNganhHoc').val())) {
                    toastr.error("Mã Ngành đào tạo không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.tenNganhHoc').val())) {
                    toastr.error("Tên Ngành đào tạo không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_NGANH_HOC,
                            type: "PUT",
                            data: {
                                'ma_nganh_hoc': $('.maNganhHoc').val(),
                                'ten_nganh_hoc': $('.tenNganhHoc').val(),
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
                        var id_don_vi = $(this).attr('data');
                        $.ajax({
                            url: POST_NGANH_HOC,
                            type: "POST",
                            data: {
                                'id': id_don_vi,
                                'ma_nganh': $('.maNganhHoc').val(),
                                'ten_nganh': $('.tenNganhHoc').val(),
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
                    url: DELETE_NGANH_HOC,
                    type: "DELETE",
                    data: {
                        'id_nganh': id,
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
