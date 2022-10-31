@extends('auth.master')
@section('title') Quản lý thông tin Học viên @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                {{ $ten_don_vi.'/'.$ten_lop_hoc }}
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonViCT', $id_don_vi) }}"><i
                            class="fa fa-dashboard"></i>
                        {{ $ten_don_vi }}
                    </a></li>
                <li><a href="{{ action('App\Http\Controllers\LopHocController@getLopHoc', $id_don_vi) }}">
                        Lớp chuyên ngành
                    </a></li>
                <li class="active"><a>
                        {{ $ten_lop_hoc }}
                    </a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success btnThem">Thêm mới</button>
                    <button class="btn btn-success btnImport">Import Excel</button>
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-bordered display nowrap">
                                <thead>
                                <tr>

                                    <th>Họ tên</th>
                                    {{--                                    <th>Tên</th>--}}
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>CMND</th>
                                    <th>SDT gia đình</th>
                                    <th>Ghi chú</th>
                                    <th>Chuyên ngành</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 70px;">Ngày cập nhật</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $item)
                                    <tr>

                                        <td>{{$item->ho.' '.$item->ten}}</td>
{{--                                        <td>{{$item->ten}}</td>--}}
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->sdt}}</td>
                                        <td>{{$item->dia_chi}}</td>
                                        <td>{{$item->cmnd}}</td>
                                        <td>{{$item->sdt_gd}}</td>
                                        <td>{{$item->ghi_chu}}</td>
                                        <td>{{$item->ten_chuyen_nganh}}</td>
                                        <td>{{$item->trang_thai == 0 ? "Thôi học":"Còn học"}}</td>
                                        <td>{{$item->ngay_cap_nhat}}</td>
                                        <td>
                                            <a class="itemCapNhat" href="#" data="{{toAttrJson($item)}}"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a>
                                            <a class="itemXoa" href="#" data="{{$item->id_hoc_vien}}"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
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
                    <h4 class="modal-title text-bold">Thêm thông tin Học viên</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Họ (*)</label>
                            <input class="form-control ho" type="text" placeholder="Họ" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Tên (*)</label>
                            <input class="form-control ten" type="text" placeholder="Tên" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Tên Ngành (*)</label>
                            <select class="form-control id_chuyen_nganh">
                                @foreach($chuyen_nganh as $i)
                                    <option value="{{$i->id_chuyen_nganh}}">{{$i->ten_chuyen_nganh}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Email (*)</label>
                            <input class="form-control email" type="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="">Số điện thoại</label>
                            <input class="form-control sdt" type="number" placeholder="Số điện thoại" pattern="(\+84|0)\d{9,10}">
                        </div>
                        <div class="col-md-6">
                            <label for="">CMND(*)</label>
                            <input class="form-control cmnd" type="text" placeholder="CMND">
                        </div>
                        <div class="col-md-6">
                            <label for="">Số điện thoại gia đình</label>
                            <input class="form-control sdt_gd" type="text" placeholder="Số điện thoại gia đình">
                        </div>
                        <div class="col-md-6">
                            <label for="">Trạng thái</label>
                            <select class="form-control trang_thai">
                                <option value="1" selected>Còn học</option>
                                <option value="0">Thôi học</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Ghi chú</label>
                            <textarea class="form-control ghi_chu" placeholder="Ghi chú"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="">Địa chỉ</label>
                            <textarea class="form-control dia_chi" placeholder="Địa chỉ"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>




{{--    Import excel--}}
    <form method="post" action="{{ action('App\Http\Controllers\HocVienController@importDanhSachv2',
                                        ['id_don_vi'=>$id_don_vi,
                                        'id_lop_hoc'=>$id_lop_hoc]) }}"
          enctype="multipart/form-data">
        <div class="modal fade" id="importKhoa">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Import dữ liệu học viên</h4>
                    </div>
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Chọn file (*.xlsx) hoặc tải về
                                    <a target="_blank" href="#">
                                        file mẫu
                                    </a>
                                </label>
                                <input accept=".xlsx" name="file-excel" type="file" class="form-control">
                                <br>
                                <p class="text-danger">Khi "Import học viên", dữ liệu cũ sẽ được xóa khỏi hệ thống</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary luuTT">Tải lên</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection

@section('script')
    <script type="text/javascript">



        var PUT_HOC_VIEN = "{{ action('App\Http\Controllers\HocVienController@putHocVien',
                                        ['id_don_vi'=>$id_don_vi,
                                        'id_lop_hoc'=>$id_lop_hoc]) }}";
        var DELETE_HOC_VIEN = "{{ action('App\Http\Controllers\HocVienController@deleteHocVien',
                                        ['id_don_vi'=>$id_don_vi,
                                        'id_lop_hoc'=>$id_lop_hoc]) }}";
        var POST_HOC_VIEN = "{{ action('App\Http\Controllers\HocVienController@postHocVien',
                                          ['id_don_vi'=>$id_don_vi,
                                           'id_lop_hoc'=>$id_lop_hoc]) }}";

        $(document).ready(function () {

            $('.table').dataTable({
                "ordering": false,
                responsive: true
            });

            $('.btnImport').click(function (){
               $('#importKhoa').modal('show');
            });


            $('.btnThem').click(function () {
                $('.maNganhHoc, .tenNganhHoc').val('');
                $('#modalThem .modal-title').text('Thêm thông tin Học viên');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $('.itemCapNhat').click(function(){
                var data = JSON.parse($(this).attr('data'));
                $('.id_chuyen_nganh').val(data.id_chuyen_nganh);
                $('.ho').val(data.ho);
                $('.ten').val(data.ten);
                $('.email').val(data.email);
                $('.sdt').val(data.sdt);
                $('.dia_chi').val(data.dia_chi);
                $('.cmnd').val(data.cmnd);
                $('.sdt_gd').val(data.sdt_gd);
                $('.ghi_chu').val(data.ghi_chu);
                $('.trang_thai').val(data.trang_thai);
                $('#modalThem .modal-title').text('Cập nhật thông tin Học viên');
                $('.btnLuu').attr('data', data.id_hoc_vien).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {
                if (isNULLorEmpty($('.ho').val())) {
                    toastr.error("Họ không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.ten').val())) {
                    toastr.error("Tên không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.email').val())) {
                    toastr.error("Email không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_HOC_VIEN,
                            type: "PUT",
                            data: {
                                'id_lop_hoc': {{ $id_lop_hoc }},
                                'id_chuyen_nganh': $('.id_chuyen_nganh').val(),
                                'ho': $('.ho').val(),
                                'ten': $('.ten').val(),
                                'email': $('.email').val(),
                                'sdt': $('.sdt').val(),
                                'dia_chi': $('.dia_chi').val(),
                                'cmnd': $('.cmnd').val(),
                                'sdt_gd': $('.sdt_gd').val(),
                                'ghi_chu': $('.ghi_chu').val(),
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
                        var id_hoc_vien = $(this).attr('data');
                        $.ajax({
                            url: POST_HOC_VIEN,
                            type: "POST",
                            data: {
                                'id_hoc_vien': id_hoc_vien,
                                'id_lop_hoc': {{ $id_lop_hoc }},
                                'id_chuyen_nganh': $('.id_chuyen_nganh').val(),
                                'ho': $('.ho').val(),
                                'ten': $('.ten').val(),
                                'email': $('.email').val(),
                                'sdt': $('.sdt').val(),
                                'dia_chi': $('.dia_chi').val(),
                                'cmnd': $('.cmnd').val(),
                                'sdt_gd': $('.sdt_gd').val(),
                                'ghi_chu': $('.ghi_chu').val(),
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
                    url: DELETE_HOC_VIEN,
                    type: "DELETE",
                    data: {
                        'id_hoc_vien': id,
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
