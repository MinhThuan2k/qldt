@extends('auth.master')
@section('title') Quản lý Giảng Viên @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Giảng viên
            </h1>
        </section>
        <section class="content">
            <button class="btn btn-success btnThem">Thêm mới</button>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>CMND</th>
                                    <th>Đơn vị</th>
                                    <th style="width: 150px;">Trạng thái</th>
                                    <th style="width: 150px;">Ngày cập nhật</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td> {{$item->ho}}  {{$item->ten }}</td>
                                        <td> {{$item->email}}</td>
                                        <td> {{$item->sdt}}</td>
                                        <td> {{$item->cmnd }}</td>
                                        <td> {{$item->ten_don_vi }}</td>
                                        @if($item->trang_thai === 1)
                                            <td><span class="label label-success">Kích hoạt</span></td>
                                        @else
                                            <td><span class="label label-warning">Khóa</span></td>
                                        @endif
                                        <td> {{$item->ngay_cap_nhat }}</td>
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item, ['id_giang_vien', 'id_don_vi', 'ho','ten', 'email','sdt','dia_chi','cmnd','trang_thai']) }}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_giang_vien }}" class="itemXoa" href="#"><i class="fa fa-trash"
                                                                                                             aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </section>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Thêm thông tin giảng viên</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tên đơn vị (*)</label>
                                <select class="form-control id_don_vi">
                                    @foreach($data2 as $item)
                                        <option value="{{$item->id_don_vi}}">{{$item->ten_don_vi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Họ và tên (*)</label>
                                <input class="form-control hoten" type="text" placeholder="Họ và tên">
                            </div>

                            <div class="col-md-6">
                                <label for="">Email (*)</label>
                                <input class="form-control email" type="email" placeholder="Email">
                            </div>
                            <div class="col-md-6">
                                <label for="">Số điện thoại (*)</label>
                                <input class="form-control sdt" type="tel" maxlength="10" placeholder="Số điện thoại">
                            </div>
                            <div class="col-md-12">
                                <label for="">Địa chỉ</label>
                                <textarea cols="30" rows="3" class="form-control dia_chi"
                                          placeholder="Địa chỉ"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">CMND (*)</label>
                                <input class="form-control cmnd" type="tel" maxlength="9" placeholder="Số CMND">
                            </div>
                            <div class="col-md-6">
                                <label for="">Trạng thái (*)</label>
                                <select class="form-control trang_thai">
                                    <option value="2">Khóa</option>
                                    <option value="1">Kích hoạt</option>
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
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('.table').dataTable();

            $('.btnThem').click(function () {
                $('.id_giang_vien, .id_don_vi, .ten,.ho,.email,.sdt,.dia_chi,.cmnd,.anh,.trang_thai').val('');
                $('#modal-default .modal-title').text('Thêm thông tin Giảng viên');
                $('.btnLuu').attr('type', 'insert');
                $('#modal-default').modal('show');
            });
            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.id_don_vi').val(data.id_don_vi);
                var hoten = data.ho + " " + data.ten;
                $('.hoten').val(hoten);
                $('.email').val(data.email);
                $('.sdt').val(data.sdt);
                $('.dia_chi').val(data.dia_chi);
                $('.cmnd').val(data.cmnd);
                //  $('.anh').val(data.anh);
                $('.trang_thai').val(data.trang_thai);
                $('#modal-default .modal-title').text('Cập nhật thông tin Giảng viên');
                $('.btnLuu').attr('data', data.id_giang_vien).attr('type', 'update');
                $('#modal-default').modal('show');
            });
            $('.btnLuu').click(function () {
                if (isNULLorEmpty($('.id_don_vi').val())) {
                    toastr.error("ID đơn vị không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.hoten').val())) {
                    toastr.error("Họ và tên không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.email').val())) {
                    toastr.error("Email không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if ($('.sdt').val().length !== 10) {
                    toastr.error("Số điện thoại chưa đúng", "Thao tác thất bại");
                    return;
                }
                if ($('.cmnd').val().length !== 9) {
                    toastr.error("Số CMND chưa đúng", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.dia_chi').val())) {
                    toastr.error("Địa chỉ không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.trang_thai').val())) {
                    toastr.error("Trạng thái không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                var m = $('.hoten').val();

                m = m.trim();
                while (m.indexOf('  ') != -1) {
                    m = m.replace('  ', ' ')
                }
                var n = m.split(' ');
                var ho = n[0];
                var ten = n[n.length - 1];
                var ten_dem = "";
                for (i = 1; i <= n.length - 2; i++) {
                    ten_dem += n[i] + " ";
                }
                var hovatendem = ho + " " + ten_dem;

                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: "{{ action('App\Http\Controllers\GiangVienController@putGiangVien') }}",
                            type: "PUT",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id_don_vi': $('.id_don_vi').val(),
                                'ho': hovatendem,
                                'ten': ten,
                                'email': $('.email').val(),
                                'sdt': $('.sdt').val(),
                                'dia_chi': $('.dia_chi').val(),
                                'cmnd': $('.cmnd').val(),
                                'anh': $('.anh').val(),
                                'trang_thai': $('.trang_thai').val()
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
                        var id_giang_vien = $(this).attr('data');

                        $.ajax({
                            url: "{{ action('App\Http\Controllers\GiangVienController@updateGiangVien') }}",
                            type: "post",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id_giang_vien': id_giang_vien,
                                'id_don_vi': $('.id_don_vi').val(),
                                'ho': hovatendem,
                                'ten': ten,
                                'email': $('.email').val(),
                                'sdt': $('.sdt').val(),
                                'dia_chi': $('.dia_chi').val(),
                                'cmnd': $('.cmnd').val(),
                                'anh': $('.anh').val(),
                                'trang_thai': $('.trang_thai').val()
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

                    url: "{{ action('App\Http\Controllers\GiangVienController@deleteGiangVien') }}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id_giang_vien': id,
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
