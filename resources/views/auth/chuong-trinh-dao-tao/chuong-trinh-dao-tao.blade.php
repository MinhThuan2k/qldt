@extends('auth.master')
@section('title') Quản lý thông tin Chương trình đào tạo @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                {{$ten_don_vi}} / Chương trình đào tạo
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonVi') }}"><i
                            class="fa fa-dashboard"></i>Đơn vị</a></li>
                </li>
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonViCT', $id_don_vi) }}">
                        {{$ten_don_vi}}</a></li>
                </li>
                <li><a href="{{ action('App\Http\Controllers\ChuongTrinhDaoTaoController@getChuongTrinhDaoTao', ['id_don_vi'=>$id_don_vi]) }}">
                        Chương trình đào tạo</a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box" style="padding: 10px">
                        <button class="btn btn-success btnThem">Thêm mới</button>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover" id="bang">
                                <thead>
                                <tr>
                                    <th style="width:50px">#</th>
                                    <th style="width:50px">Niên khóa</th>
                                    <th style="width:300px">Tên chương trình ĐT</th>
                                    <th style="width:100px">Ngày ban hành</th>
                                    <th style="width:100px">Tổng tín chỉ</th>
                                    <th style="width:80px" class="text-center">Trạng thái</th>
                                    <th style="width:100px">Ngày cập nhật</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td><a href="{{action('App\Http\Controllers\CayTienTrinhController@getCayTienTrinh',['id_chuong_trinh'=>$item->id_chuong_trinh, 'id_don_vi'=>$id_don_vi])}}"
                                               class="itemXemThem">Chi tiết</a></td>
                                        <td>{{$item->nien_khoa}}</td>
                                        <td>{{$item->ma_chuong_trinh}} - {{$item->ten_chuong_trinh}}</td>

                                        <td>{{$item->ngay_ban_hanh}}</td>
                                        <td>{{$item->sum_tong_tin_chi}}</td>
                                        @if($item->trang_thai == 1)
                                            <td class="text-center"><span class="label label-success">Mở</span></td>
                                        @else
                                            <td class="text-center"><span class="label label-danger">Đóng</span></td>
                                        @endif
                                        <td>{{$item->ngay_cap_nhat}}</td>
                                        <td>
                                            <a class="itemCapNhat" href="#" data="{{toAttrJson($item)}}"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                                            <a class="itemXoa" href="#" data="{{$item->id_chuong_trinh}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
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
                    <h4 class="modal-title text-bold">Thêm thông tin Chương trình đào tạo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Mã chương trình</label>
                            <input class="form-control ma_chuong_trinh" type="text" placeholder="Mã Chương trình đào tạo">
                        </div>
                        <div class="col-md-9">
                            <label for="">Tên chương trình</label>
                            <input class="form-control ten_chuong_trinh" type="text" placeholder="Tên Chương trình đào tạo">
                        </div>
                        <div class="col-md-4">
                            <label for="">Ngày ban hành</label>
                            <input class="form-control ngay_ban_hanh" type="date">
                        </div>
                        <div class="col-md-4">
                            <label for="">Niên khóa</label>
                            <select class="form-control id_khoa_hoc">
                                @foreach($nien_khoa as $item)
                                    <option value="{{$item->id_khoa_hoc}}">{{$item->nien_khoa}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Trạng thái</label>
                            <select class="form-control trang_thai">
                                <option value="1">Mở</option>
                                <option value="0">Đóng</option>
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
        var PUT_CHUONG_TRINH_DAO_TAO = "{{action('App\Http\Controllers\ChuongTrinhDaoTaoController@putChuongTrinhDaoTao')}}";
        var DELETE_CHUONG_TRINH_DAO_TAO = "{{action('App\Http\Controllers\ChuongTrinhDaoTaoController@deleteChuongTrinhDaoTao')}}";
        var POST_CHUONG_TRINH_DAO_TAO = "{{action('App\Http\Controllers\ChuongTrinhDaoTaoController@postChuongTrinhDaoTao')}}";

        $(document).ready(function () {
            var groupColumn = 1;
            $('#bang').DataTable(
                {
                    reponsive: true,
                    paging: false,
                    "bInfo" : false,
                    "columnDefs": [
                        {"visible": false, "targets": groupColumn}
                    ],
                    "order": [[groupColumn, 'asc']],
                    "displayLength": 500,
                    "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({page: 'current'}).nodes();
                        var last = null;
                        api.column(groupColumn, {page: 'current'}).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td style="font-size: 16px;" class="text-bold text-danger" colspan="8">Khóa ' + group + '</td></tr>'
                                );
                                last = group;
                            }
                        });
                    }
                }
            );

            $('.btnThem').click(function () {
                $('.ma_chuong_trinh, .ten_chuong_trinh .ngay_ban_hanh .trang_thai').val('');
                $('#modalThem .modal-title').text('Thêm thông tin Chương trình đào tạo');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $('.itemCapNhat').click(function(){
                var data = JSON.parse($(this).attr('data'));
                $('.ma_chuong_trinh').val(data.ma_chuong_trinh);
                $('.ten_chuong_trinh').val(data.ten_chuong_trinh);
                $('.ngay_ban_hanh').val(data.ngay_ban_hanh);
                $('.trang_thai').val(data.trang_thai);
                $('#modalThem .modal-title').text('Cập nhật thông tin Chương trình đào tạo');
                $('.btnLuu').attr('data', data.id_chuong_trinh).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {
                if (isNULLorEmpty($('.ma_chuong_trinh').val())
                || isNULLorEmpty($('.ten_chuong_trinh').val())
                || isNULLorEmpty($('.ngay_ban_hanh').val())
                ) {
                    toastr.error("Không được bỏ trống trường nào!", "Thao tác thất bại");
                    return;
                }
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_CHUONG_TRINH_DAO_TAO,
                            type: "PUT",
                            data: {
                                'id_don_vi': "{{$id_don_vi}}",
                                'id_khoa_hoc': $('.id_khoa_hoc').val(),
                                'ma_chuong_trinh': $('.ma_chuong_trinh').val(),
                                'ten_chuong_trinh': $('.ten_chuong_trinh').val(),
                                'ngay_ban_hanh': $('.ngay_ban_hanh').val(),
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
                        var id_chuong_trinh = $(this).attr('data');
                        $.ajax({
                            url: POST_CHUONG_TRINH_DAO_TAO,
                            type: "POST",
                            data: {
                                'id_chuong_trinh': id_chuong_trinh,
                                'id_don_vi': "{{$id_don_vi}}",
                                'ma_chuong_trinh': $('.ma_chuong_trinh').val(),
                                'ten_chuong_trinh': $('.ten_chuong_trinh').val(),
                                'ngay_ban_hanh': $('.ngay_ban_hanh').val(),
                                'id_khoa_hoc': $('.id_khoa_hoc').val(),
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
                    url: DELETE_CHUONG_TRINH_DAO_TAO,
                    type: "DELETE",
                    data: {
                        'id_chuong_trinh': id,
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
