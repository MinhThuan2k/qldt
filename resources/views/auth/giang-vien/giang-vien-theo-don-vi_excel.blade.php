@extends('auth.master')
@section('title') Quản lý Giảng Viên @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
               {{$ten_don_vi}} / Giảng viên
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonVi') }}"><i
                            class="fa fa-dashboard"></i>Đơn vị</a></li>
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonViCT',$id_don_vi) }}"><i
                            class="fa fa-dashboard"></i>{{$ten_don_vi}}</a></li>
                <li class="active">Giảng viên</li>
            </ol>
        </section>
        <section class="content">
            <button class="btn btn-success btnThem">Thêm mới</button>
            <button class="btn btn-success btnImport">Nhập Excel</button>
            <a class="btn btn-primary" href="{{action('App\Http\Controllers\GiangVienController@exportGiangVien',$id_don_vi)}}" >Xuất file</a>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Trình độ</th>
                                    <th>Chức vụ</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>CMND</th>
                                    <th style="width: 150px;">Trạng thái</th>
                                    <th style="width: 150px;">Ngày cập nhật</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($gv as $item)
                                    <tr>
                                        <td>{{$item->ho}} {{$item->ten }}</td>
                                        <td>{{$item->ten_hoc_vi}}</td>
                                        <td>{{$item->ten_chuc_vu}}</td>
                                        <td> {{$item->email}}</td>
                                        <td> {{$item->sdt}}</td>
                                        <td> {{$item->cmnd }}</td>
                                        @if($item->trang_thai === 1)
                                            <td><span class="label label-success">Kích hoạt</span></td>
                                        @else
                                            <td><span class="label label-warning">Khóa</span></td>
                                        @endif
                                        <td> {{$item->ngay_cap_nhat }}</td>
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item, ['id_giang_vien', 'id_chuc_vu','id_hoc_vi', 'ho','ten', 'email','sdt','dia_chi','cmnd','trang_thai']) }}"
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
                    <h5 class="text-bold">
                        Tiến sĩ:
                        @foreach($ts as $item)
                            {{$item->SL}}
                            @endforeach
                    </h5>
                    <h5 class="text-bold">
                        Thạc sĩ:
                        @foreach($ths as $item)
                            {{$item->SL}}
                        @endforeach
                    </h5>
                    <h5 class="text-bold">
                        Cao học:
                        @foreach($dh as $item)
                            {{$item->SL}}
                        @endforeach
                    </h5>
                    <h5 class="text-bold">
                        Nghiên cứu sinh:
                        @foreach($ncs as $item)
                            {{$item->SL}}
                        @endforeach
                    </h5>
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
                            <div class="col-md-12">
                                <label for="">Họ và tên (*)</label>
                                <input class="form-control hoten" type="text" placeholder="Họ và tên">
                            </div>
                            <div class="col-md-6">
                                <label for="">Trình độ (*)</label>
                                <select class="form-control id_hoc_vi">
                                    @foreach($hv as $item)
                                        <option value={{$item->id_hoc_vi}}>{{$item->ten_hoc_vi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Chức vụ (*)</label>
                                <select class="form-control id_chuc_vu">
                                    @foreach($cv as $item)
                                        <option value={{$item->id_chuc_vu}}>{{$item->ten_chuc_vu}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email (*)</label>
                                <input class="form-control email" type="email" placeholder="Email">
                            </div>
                            <div class="col-md-6">
                                <label for="">Số điện thoại (*)</label>
                                <input class="form-control sdt" type="tel" maxlength="10" placeholder="Số điện thoại">
                            </div>

                            <div class="col-md-6">
                                <label for="">CMND (*)</label>
                                <input class="form-control cmnd" type="tel" maxlength="9" placeholder="Số CMND">
                            </div>
                            <div class="col-md-6">
                                <label for="">Trạng thái (*)</label>
                                <select class="form-control trang_thai">
                                    <option value="1" selected>Kích hoạt</option>
                                    <option value="0">Khóa</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">Địa chỉ</label>
                                <textarea cols="30" rows="3" class="form-control dia_chi"
                                          placeholder="Địa chỉ"></textarea>
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
    <form method="post" action="{{action('App\Http\Controllers\GiangVienController@importGiangVien', $id_don_vi)}}"
          enctype="multipart/form-data">
        <div class="modal fade" id="importGiangVien">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Import dữ liệu Giảng viên</h4>
                    </div>
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Chọn file (*.xlsx) hoặc Tải về
                                    <a target="_blank" href="{{asset('excel-mau/nhap-giang-vien.xlsx')}}">
                                        file mẫu
                                    </a>
                                </label>
                                <input accept=".xlsx" name="file-excel" type="file" class="form-control">
                                <br>
                                <p class="text-danger">Khi "Import thông tin Giảng viên", dữ liệu cũ sẽ được xóa khỏi hệ thống</p>
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
        var PUT_GIANG_VIEN ="{{ action('App\Http\Controllers\GiangVienController@putGiangVien') }}";
        var DELETE_GIANG_VIEN = "{{ action('App\Http\Controllers\GiangVienController@deleteGiangVien') }}";
        var POST_GIANG_VIEN = "{{ action('App\Http\Controllers\GiangVienController@updateGiangVien') }}";
        $(document).ready(function () {

            $('.table').dataTable({
                "ordering": false
            } );

            $('.btnThem').click(function () {
                $('.id_giang_vien,.id_hoc_vi,.id_chuc_vu, .hoten,.email,.sdt,.dia_chi,.cmnd,.trang_thai').val('');
                $('#modal-default .modal-title').text('Thêm thông tin Giảng viên');
                $('.btnLuu').attr('type', 'insert');
                $('#modal-default').modal('show');
            });
            $('.btnImport').click(function (){
                $('#importGiangVien').modal('show');
            })
            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));

                var hoten = data.ho + " " + data.ten;
                $('.hoten').val(hoten);
                $('.email').val(data.email);
                $('.sdt').val(data.sdt);
                $('.dia_chi').val(data.dia_chi);
                $('.cmnd').val(data.cmnd);
                $('.id_hoc_vi').val(data.id_hoc_vi);
                $('.id_chuc_vu').val(data.id_chuc_vu);
                $('.trang_thai').val(data.trang_thai);
                $('#modal-default .modal-title').text('Cập nhật thông tin Giảng viên');
                $('.btnLuu').attr('data', data.id_giang_vien).attr('type', 'update');
                $('#modal-default').modal('show');
            });
            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.hoten').val())) {
                    toastr.error("Họ và tên không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.email').val())) {
                    toastr.error("Email không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.id_chuc_vu').val())) {
                    toastr.error("Chức vụ không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.id_hoc_vi').val())) {
                    toastr.error("Học vị không được bỏ trống", "Thao tác thất bại");
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
                            url: PUT_GIANG_VIEN,
                            type: "PUT",
                            data: {
                                'id_hoc_vi': $('.id_hoc_vi').val(),
                                'id_chuc_vu': $('.id_chuc_vu').val(),
                                'id_don_vi':"{{$id_don_vi}}",
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
                            url: POST_GIANG_VIEN,
                            type: "post",
                            data: {
                                'id_giang_vien': id_giang_vien,
                                'id_hoc_vi': $('.id_hoc_vi').val(),
                                'id_chuc_vu': $('.id_chuc_vu').val(),
                                'id_don_vi':"{{$id_don_vi}}",
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

                    url: DELETE_GIANG_VIEN,
                    type: "DELETE",
                    data: {
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
