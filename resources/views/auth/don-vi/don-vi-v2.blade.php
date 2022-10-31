@extends('auth.master')
@section('title') Quản lý thông tin Đơn vị/Khoa chuyên môn @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Đơn vị/Khoa chuyên môn
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
                                    <th style="width: 100px;">Mã đơn vị</th>
                                    <th style="width: 300px;">Tên đơn vị</th>
                                    <th style="width: 150px;">Loại đơn vị</th>
                                    <th>Vị trí</th>
                                    <th style="width: 150px;">Cập nhật lúc</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                @foreach($ds as $item)
                                    <tr>
                                        <td><b>{{ $item->ma_don_vi }}</b></td>
                                        <td>{{ $item->ten_don_vi }}</td>
                                        <td>{{ $item->khoa_chuyen_mon == 1 ? "Khoa chuyên môn" : "Đơn vị" }}</td>
                                        <td>{{ $item->vi_tri }}</td>
                                        <td>{{ $item->ngay_cap_nhat }}</td>
                                        <td class="text-center">
                                            <a href="{{action('App\Http\Controllers\ChuongTrinhDaoTaoController@getChuongTrinhDaoTao',['id_don_vi'=>$item->id_don_vi])}}"
                                               class="itemXemThem"><i class="fa fa-info" aria-hidden="true"></i></a>
                                            <a data="{{ toAttrJson($item, ['id_don_vi', 'ma_don_vi', 'ten_don_vi', 'vi_tri', 'khoa_chuyen_mon']) }}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_don_vi }}" class="itemXoa" href="#"><i
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
                    <h4 class="modal-title text-bold">Thêm thông tin Đơn vị/Khoa chuyên môn</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Mã đơn vị (*)</label>
                            <input class="form-control maDonVi" type="text" placeholder="Mã đơn vị">
                        </div>
                        <div class="col-md-9">
                            <label for="">Tên đơn vị (*)</label>
                            <input class="form-control tenDonVi" type="text" placeholder="Tên đơn vị">
                        </div>
                        <div class="col-md-12">
                            <label for="">Vị trí (*)</label>
                            <textarea cols="30" rows="3" class="form-control viTri" placeholder="Vị trí"></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="khoaChuyenMon"> Khoa chuyên môn
                                </label>
                            </div>
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
        var PUT_DON_VI = "{{ action('App\Http\Controllers\DonViController@putDonVi') }}";
        var DELETE_DON_VI = "{{ action('App\Http\Controllers\DonViController@deleteDonVi') }}";
        var POST_DON_VI = "{{ action('App\Http\Controllers\DonViController@deleteDonVi') }}";

        $(document).ready(function () {

            $('.btnThem').click(function () {
                $('.maDonVi, .tenDonVi, .viTri').val('');
                $('#modalThem .modal-title').text('Thêm thông tin Đơn vị/Khoa chuyên môn');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.maDonVi').val(data.ma_don_vi);
                $('.tenDonVi').val(data.ten_don_vi);
                $('.viTri').val(data.vi_tri);
                $('.khoaChuyenMon').prop('checked', parseInt(data.khoa_chuyen_mon) === 1);
                $('#modalThem .modal-title').text('Cập nhật thông tin Đơn vị/Khoa chuyên môn');
                $('.btnLuu').attr('data', data.id_don_vi).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.maDonVi').val())) {
                    toastr.error("Mã đơn vị không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.tenDonVi').val())) {
                    toastr.error("Tên đơn vị không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_DON_VI,
                            type: "PUT",
                            data: {
                                'ma_don_vi': $('.maDonVi').val(),
                                'ten_don_vi': $('.tenDonVi').val(),
                                'vi_tri': $('.viTri').val(),
                                'khoa_chuyen_mon': $('.khoaChuyenMon').is(":checked") === true ? 1 : 0,
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
                            url: POST_DON_VI,
                            type: "POST",
                            data: {
                                'id_don_vi': id_don_vi,
                                'ma_don_vi': $('.maDonVi').val(),
                                'ten_don_vi': $('.tenDonVi').val(),
                                'vi_tri': $('.viTri').val(),
                                'khoa_chuyen_mon': $('.khoaChuyenMon').is(":checked") === true ? 1 : 0,
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
                    url: DELETE_DON_VI,
                    type: "DELETE",
                    data: {
                        'id_don_vi': id,
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
