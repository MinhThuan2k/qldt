@extends('auth.master')
@section('title') Quản lý thông tin Học phần @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Học phần
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
                                    <th>Mã học phần</th>
                                    <th>Tên học phần</th>
                                    <th>Tên tiếng Anh</th>
                                    <th>Tín chỉ lý thuyết</th>
                                    <th>Tín chỉ thực hành</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->ma_hoc_phan}}</td>
                                        <td>{{$item->ten_hoc_phan}}</td>
                                        <td>{{$item->ten_tieng_anh}}</td>
                                        <td>{{$item->tin_chi_lt}}</td>
                                        <td>{{$item->tin_chi_th}}</td>
                                        <td>{{$item->trang_thai}}</td>
                                        <td>{{$item->ngay_cap_nhat}}</td>
                                        <td>
                                            <a class="itemCapNhat" href="#" data="{{toAttrJson($item)}}"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                                            <a class="itemXoa" href="#" data="{{$item->id_hoc_phan}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
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
                    <h4 class="modal-title text-bold">Thêm thông tin Học phần</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Mã học phần (*)</label>
                            <input class="form-control ma_hoc_phan" type="text">
                        </div>
                        <div class="col-md-4">
                            <label for="">Tên học phần(*)</label>
                            <input class="form-control ten_hoc_phan" type="text">
                        </div>
                        <div class="col-md-4">
                            <label for="">Tên tiếng anh(*)</label>
                            <input class="form-control ten_tieng_anh" type="text">
                        </div>
                        <div class="col-md-4">
                            <label for="">Số tín chỉ lý thuyết(*)</label>
                            <input class="form-control tin_chi_lt" type="number">
                        </div>
                        <div class="col-md-4">
                            <label for="">Số tín chỉ thực hành(*)</label>
                            <input class="form-control tin_chi_th" type="number">
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
        var PUT_HOC_PHAN = "{{action('App\Http\Controllers\HocPhanController@putHocPhan')}}";
        var DELETE_HOC_PHAN = "{{ action('App\Http\Controllers\HocPhanController@postHocPhan') }}";
        var POST_HOC_PHAN = "{{ action('App\Http\Controllers\HocPhanController@deleteHocPhan') }}";

        $(document).ready(function () {

            $('.btnThem').click(function () {
                $('.ma_hoc_phan, .ten_hoc_phan, .ten_tieng_anh, .tin_chi_lt, .tin_chi_th').val('');
                $('#modalThem .modal-title').text('Thêm thông tin Học phần');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $('.itemCapNhat').click(function(){
                var data = JSON.parse($(this).attr('data'));
                $('.ma_hoc_phan').val(data.ma_hoc_phan);
                $('.ten_hoc_phan').val(data.ten_hoc_phan);
                $('.ten_tieng_anh').val(data.ten_tieng_anh);
                $('.tin_chi_lt').val(data.tin_chi_lt);
                $('.tin_chi_th').val(data.tin_chi_th);
                $('.trang_thai').val(data.trang_thai);
                $('.btnLuu').attr('data', data.id_hoc_phan).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {
                if (
                    isNULLorEmpty($('.ma_hoc_phan').val())
                    || isNULLorEmpty($('.ten_hoc_phan').val())
                    || isNULLorEmpty($('.ten_tieng_anh').val())
                ) {
                    toastr.error("Không được bỏ trống trường nào!", "Thao tác thất bại");
                    return;
                }
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_HOC_PHAN,
                            type: "PUT",
                            data: {
                                'ma_hoc_phan': $('.ma_hoc_phan').val(),
                                'ten_hoc_phan': $('.ten_hoc_phan').val(),
                                'ten_tieng_anh': $('.ten_tieng_anh').val(),
                                'tin_chi_lt': $('.tin_chi_lt').val(),
                                'tin_chi_th': $('.tin_chi_th').val(),
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
                        var id_hoc_phan = $(this).attr('data');
                        $.ajax({
                            url: POST_HOC_PHAN,
                            type: "POST",
                            data: {
                                'id_hoc_phan' : id_hoc_phan,
                                'ma_hoc_phan': $('.ma_hoc_phan').val(),
                                'ten_hoc_phan': $('.ten_hoc_phan').val(),
                                'ten_tieng_anh': $('.ten_tieng_anh').val(),
                                'gio_ket_thuc': $('.gio_ket_thuc').val(),
                                'tin_chi_lt': $('.tin_chi_lt').val(),
                                'tin_chi_th': $('.tin_chi_th').val(),
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
                    url: DELETE_HOC_PHAN,
                    type: "DELETE",
                    data: {
                        'id_hoc_phan': id,
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
