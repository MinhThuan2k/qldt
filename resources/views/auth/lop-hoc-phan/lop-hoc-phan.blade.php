@extends('auth.master')
@section('title') Quản lý thông tin Lớp học phần @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">
                {{ $ten_don_vi  }}/Lớp học phần
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonVi') }}"><i
                            class="fa fa-dashboard"></i>Đơn vị</a></li>
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonViCT', $id_don_vi) }}">
                        {{ $ten_don_vi  }}
                    </a></li>
                <li class="active">Lớp học phần</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success btnThem">Thêm mới</button>
                    <button class="btn btn-success btnExportModal">Export</button>
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 90px"></th>
                                    <th style="width: 50px"></th>
                                    <th>Mã lớp học phần</th>
                                    <th>Tên học phần</th>
                                    <th>Tên năm học</th>
                                    <th style="width: 70px; text-align: center">Loại</th>
                                    <th style="width: 70px">Nhập điểm</th>
                                    <th style="width: 120px; text-align: center">Cập nhật lúc</th>
                                    <th style="width: 70px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ds as $item)
                                    <tr>
                                        <td><a href="{{ action('App\Http\Controllers\ThoiKhoaBieuController@getViewTKB',[
                                                        'id_don_vi' => $id_don_vi,
                                                        'id_lop_hoc_phan'=> $item->id_lop_hoc_phan,
                                                        ]) }}">Thời khóa biểu</a> </td>
                                        <td><a href="{{ action('App\Http\Controllers\LopHocPhanController@getLopHocPhanChiTiet',[
                                                        'id_don_vi' => $id_don_vi,
                                                        'id_lop_hoc_phan'=> $item->id_lop_hoc_phan,
                                                        ]) }}">Chi tiết</a> </td>
                                        <td>{{ $item->ma_lop_hoc_phan }}</td>
                                        <td>{{ $item->ten_hoc_phan }}</td>
                                        <td>{{ $item->ten_hoc_ky.' - '.$item->ten_nam_hoc }}</td>
                                        <td style="text-align: center">
                                            @if($item->loai_lop_hoc_phan === 0)
                                                Lý thuyết
                                            @else
                                                Thực hành
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if($item->nhap_diem === 1)
                                                <span class="label label-success">Kích hoạt</span>
                                            @else
                                                <span class="label label-warning">Khóa</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->ngay_cap_nhat }}</td>
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item, ['id_hoc_phan' ,'so_luong','ma_lop_hoc_phan', 'loai_lop_hoc_phan','nhap_diem','id_lop_hoc_phan','id_hoc_ky'])}}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_lop_hoc_phan }}" class="itemXoa" href="#"><i
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
                    <h4 class="modal-title text-bold">Thêm thông tin Lớp học phần</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Mã lớp học phần</label>
                            <input class="form-control maLopHocPhan" type="text">
                        </div>
                        <div class="col-md-6">
                            <label for="">Tên học phần(*)</label>
                            <select class="form-control id_hoc_phan">
                                <option selected value="-1">Tên học phần</option>
                                @foreach($dsHocPhan as $item)
                                    <option value="{{$item->id_hoc_phan}}">{{$item->ten_hoc_phan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Học kỳ(*)</label>
                            <select class="form-control id_hoc_ky">
                                <option selected value="-1">Học kỳ</option>
                                @foreach($dsHocKy as $item)
                                    <option value="{{$item->id_hoc_ky}}">{{$item->ten_hoc_ky .' ('.$item->ten_nam_hoc.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Loại lớp học phần</label>
                            <select class="form-control loaiLopHocPhan">
                                <option selected value="0">Lý thuyết</option>
                                <option value="1">Thực hành</option>
                            </select>
                        </div>
                        <div class="col-md-4 boxSoLuongLop">
                            <label for="">Số lượng lớp</label>
                            <input class="form-control soLuong" type="number" value="1">
                        </div>
                        <div class="col-md-4">
                            <label for="">Số sinh viên tối đa</label>
                            <input class="form-control soLuongSV" type="number" value="1">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nhập điểm</label>
                            <select class="form-control nhapDiem">
                                <option selected value="0">Khóa</option>
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




    <div class="modal fade" id="modalExport">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Export lớp học phần</h4>
                </div>
                <div class="modal-body">
                    <label for="">Học kỳ(*)</label>
                    <select class="form-control id_hoc_ky_export">
                        <option selected value="-1">Học kỳ</option>
                        @foreach($dsHocKy as $item)
                            <option value="{{$item->id_hoc_ky}}">{{$item->ten_hoc_ky .' ('.$item->ten_nam_hoc.')'}}</option>
                        @endforeach
                    </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                    <button type="button" data="" class="btn btn-primary btnExport">EXPORT</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection

@section('script')
    <script type="text/javascript">
        var PUT_LOP_HOC_PHAN = "{{ action('App\Http\Controllers\LopHocPhanController@putLopHocPhan') }}";
        var DELETE_LOP_HOC_PHAN = "{{ action('App\Http\Controllers\LopHocPhanController@deleteLopHocPhan') }}";
        var POST_LOP_HOC_PHAN = "{{ action('App\Http\Controllers\LopHocPhanController@postLopHocPhan') }}";


        $(document).ready(function () {

            $('.table').dataTable({
                "ordering": false,
            });

            $('.btnThem').click(function () {
                $('.maLopHocPhan').val('');
                $('.soLuongSV').val('');
                $('.soLuong').val('');
                $('.id_hoc_ky').val(-1);
                $('.id_hoc_phan').val(-1);
                $('.loaiLopHocPhan').val(0);

                $('.boxSoLuongLop').show();
                $('#modalThem .modal-title').text('Thêm thông tin Lớp học phần');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.boxSoLuongLop').hide();

                $('.soLuongSV').val(data.so_luong);
                $('.maLopHocPhan').val(data.ma_lop_hoc_phan);
                $('.id_hoc_phan').val(data.id_hoc_phan);
                $('.id_hoc_ky').val(data.id_hoc_ky);
                $('.loaiLopHocPhan').val(data.loai_lop_hoc_phan);
                $('.nhapDiem').val(data.nhap_diem);
                $('#modalThem .modal-title').text('Cập nhật thông tin Lớp học phần');
                $('.btnLuu').attr('data', data.id_lop_hoc_phan).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.maLopHocPhan').val())) {
                    toastr.error("Mã lớp học phần không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if ($('.id_hoc_phan').val()=="-1"){
                    toastr.error("Hãy chọn học phần", "Thao tác thất bại");
                    return;
                }
                if ($('.id_hoc_ky').val()=="-1"){
                    toastr.error("Hãy chọn học kỳ", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.soLuong').val())) {
                    toastr.error("Số lượng lớp được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.soLuongSV').val())) {
                    toastr.error("Số sinh viên tối đa không được bỏ trống", "Thao tác thất bại");
                    return;
                }


                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_LOP_HOC_PHAN,
                            type: "PUT",
                            data: {
                                'so_luong_lop' : $('.soLuong').val(),
                                'so_luong' : $('.soLuongSV').val(),
                                'id_hoc_phan': $('.id_hoc_phan').val(),
                                'ma_lop_hoc_phan': $('.maLopHocPhan').val(),
                                'loai_lop_hoc_phan': $('.loaiLopHocPhan').val(),
                                'nhap_diem': $('.nhapDiem').val(),
                                'id_hoc_ky': $('.id_hoc_ky').val(),
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    toastr.success(result.message, "Thao tác thành công");
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 500);
                                } else if (result.status === 333){
                                    toastr.warning(result.message, "Cảnh báo thao tác");
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
                        var id_lop_hoc_phan = $(this).attr('data');
                        $.ajax({
                            url: POST_LOP_HOC_PHAN,
                            type: "POST",
                            data: {
                                'so_luong' : $('.soLuongSV').val(),
                                'id_lop_hoc_phan': id_lop_hoc_phan,
                                'id_hoc_phan': $('.id_hoc_phan').val(),
                                'ma_lop_hoc_phan': $('.maLopHocPhan').val(),
                                'loai_lop_hoc_phan': $('.loaiLopHocPhan').val(),
                                'nhap_diem': $('.nhapDiem').val(),
                                'id_hoc_ky': $('.id_hoc_ky').val(),
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

            $(document).on('click', '.itemXoa', function () {

                if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                    return;
                }

                var id = $(this).attr('data');
                $.ajax({
                    url: DELETE_LOP_HOC_PHAN,
                    type: "DELETE",
                    data: {
                        'id_lop_hoc_phan': id,
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


            $('.btnExportModal').click(function (){
                $('#modalExport').modal('show');
            });

            $('.btnExport').click(function (){
                if ($('.id_hoc_ky_export').val()=="-1"){
                    toastr.error("Hãy chọn học kỳ", "Thao tác thất bại");
                    return;
                }
                var loc = "{{action(['App\Http\Controllers\LopHocPhanController@exportCSV'], ['id_hoc_ky'=>1])}}";
                window.location.href = loc.slice(0, -1) + $(this).attr('data');
            });

            $('.id_hoc_ky_export').on('change',function (){
                $('.btnExport').attr('data',$(this).val());
            });

        });
    </script>
@endsection
