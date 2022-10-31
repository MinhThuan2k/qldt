@extends('auth.master')
@section('title') Học kỳ @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Học kỳ
            </h1>
        </section>
        <section class="content-header">
        </section>
        <section class="content">
                <button class="btn btn-success btnThem">Thêm mới</button>
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                        <table class="table table-striped" >
                            <thead>
                            <tr>
                                <th>Năm học</th>
                                <th>Tên học kỳ</th>
                                <th style="width: 100px;">Tuần</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th style="width: 100px;">Trạng thái</th>
                                <th style="width: 150px;">Ngày cập nhật</th>
                                <th style="width: 70px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td> {{$item->ten_nam_hoc }}</td>
                                <td> {{$item->ten_hoc_ky }}</td>
                                <td> {{$item->tuan_bat_dau}} - {{$item->tuan_ket_thuc }}</td>
                                <td> {{$item->ngay_bat_dau }}</td>
                                <td> {{$item->ngay_ket_thuc }}</td>
                                @if($item->trang_thai === 1)
                                <td><span class="label label-success">Kích hoạt</span></td>
                                @else
                                <td><span class="label label-warning">Khóa</span></td>
                                @endif
                                <td> {{$item->ngay_cap_nhat }}</td>
                                <td class="text-center">
                                    <a data="{{ toAttrJson($item, ['id_hoc_ky', 'id_nam_hoc', 'ma_hoc_ky', 'ten_hoc_ky', 'ngay_bat_dau','tuan_bat_dau','ngay_ket_thuc','tuan_ket_thuc','trang_thai']) }}"
                                       class="itemCapNhat" href="#">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a data="{{ $item->id_hoc_ky }}" class="itemXoa" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody></table>
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
                        <h4 class="modal-title">Thêm thông tin học kỳ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tên năm học</label>
                                <select class="form-control id_nam_hoc">
                                    @foreach($data2 as $item)
                                    <option value="{{$item->id_nam_hoc}}">{{$item->ten_nam_hoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Mã học kỳ (*)</label>
                                <input class="form-control ma_hoc_ky" type="text" placeholder="Mã học kỳ">
                            </div>
                            <div class="col-md-6">
                                <label for="">Tên học kỳ (*)</label>
                                <input class="form-control ten_hoc_ky" type="text" placeholder="Tên học kỳ">
                            </div>
                            <div class="col-md-6">
                                <label for="">Ngày bắt đầu (*)</label>
                                <input class="form-control ngay_bat_dau" type="date" >
                            </div>
                            <div class="col-md-6">
                                <label for="">Tuần bắt đầu (*)</label>
                                <input class="form-control tuan_bat_dau" type="number" min="1" placeholder="Tuần bắt đầu">
                            </div>
                            <div class="col-md-6">
                                <label for="">Ngày kết thúc (*)</label>
                                <input class="form-control ngay_ket_thuc" type="date">
                            </div>
                            <div class="col-md-6">
                                <label for="">Tuần kết thúc (*)</label>
                                <input class="form-control tuan_ket_thuc" type="number" min="1" placeholder="Tuần kết thúc">
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
    <script type="text/javascript">
        var PUT_HOC_KY ="{{ action('App\Http\Controllers\HocKyController@putThemHocKy') }}";
        var DELETE_HOC_KY = "{{ action('App\Http\Controllers\HocKyController@deleteXoaHocKy') }}";
        var POST_HOC_KY = "{{ action('App\Http\Controllers\HocKyController@updateHocKy') }}";
        $(document).ready(function () {
            $('.table').dataTable();
            $('.btnThem').click(function () {
                $('.id_nam_hoc, .ma_hoc_ky, .ten_hoc_ky,.ngay_bat_dau,.tuan_bat_dau,.ngay_ket_thuc,.tuan_ket_thuc,.trang_thai').val('');
                $('#modal-default .modal-title').text('Thêm thông tin Học kỳ');
                $('.btnLuu').attr('type', 'insert');
                $('#modal-default').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.id_nam_hoc').val(data.id_nam_hoc);
                $('.ma_hoc_ky').val(data.ma_hoc_ky);
                $('.ten_hoc_ky').val(data.ten_hoc_ky);
                $('.ngay_bat_dau').val(data.ngay_bat_dau);
                $('.tuan_bat_dau').val(data.tuan_bat_dau);
                $('.ngay_ket_thuc').val(data.ngay_ket_thuc);
                $('.tuan_ket_thuc').val(data.tuan_ket_thuc);
                $('.trang_thai').val(data.trang_thai);
                $('#modal-default .modal-title').text('Cập nhật thông tin Học kỳ');
                $('.btnLuu').attr('data', data.id_hoc_ky).attr('type', 'update');
                $('#modal-default').modal('show');
            });



            $('.btnLuu').click(function (){
                if (isNULLorEmpty($('.id_nam_hoc').val())) {
                    toastr.error("ID năm học không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.ma_hoc_ky').val())) {
                    toastr.error("Mã học kỳ không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.ten_hoc_ky').val())) {
                    toastr.error("Tên học kỳ không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.ngay_bat_dau').val())) {
                    toastr.error("Ngày bắt đầu không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if($('.ngay_bat_dau').val()>$('.ngay_ket_thuc').val()){
                    toastr.error("Ngày bắt đầu không được lớn hơn ngày kết thúc", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.tuan_bat_dau').val())) {
                    toastr.error("Tuần bắt đầu không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.ngay_ket_thuc').val())) {
                    toastr.error("Ngày kết thúc không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.tuan_ket_thuc').val())) {
                    toastr.error("Tuần kết thúc không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.trang_thai').val())) {
                    toastr.error("Trạng thái không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_HOC_KY,
                            type: "PUT",
                            data: {
                                'id_nam_hoc': $('.id_nam_hoc').val(),
                                'ma_hoc_ky': $('.ma_hoc_ky').val(),
                                'ten_hoc_ky': $('.ten_hoc_ky').val(),
                                'ngay_bat_dau': $('.ngay_bat_dau').val(),
                                'tuan_bat_dau': $('.tuan_bat_dau').val(),
                                'ngay_ket_thuc': $('.ngay_ket_thuc').val(),
                                'tuan_ket_thuc': $('.tuan_ket_thuc').val(),
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
                        });break;
                    case 'update':
                        var id_hoc_ky = $(this).attr('data');
                        $.ajax({
                            url : POST_HOC_KY,
                            type : "post",
                            data : {
                                'id_hoc_ky': id_hoc_ky,
                                'id_nam_hoc': $('.id_nam_hoc').val(),
                                'ma_hoc_ky': $('.ma_hoc_ky').val(),
                                'ten_hoc_ky': $('.ten_hoc_ky').val(),
                                'ngay_bat_dau': $('.ngay_bat_dau').val(),
                                'tuan_bat_dau': $('.tuan_bat_dau').val(),
                                'ngay_ket_thuc': $('.ngay_ket_thuc').val(),
                                'tuan_ket_thuc': $('.tuan_ket_thuc').val(),
                                'trang_thai': $('.trang_thai').val(),
                            },
                            success : function (result){
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
                        });break;
                }

            });

            $('.itemXoa').click(function (){
                if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                    return;
                }
                var id = $(this).attr('data');

                $.ajax({

                    url : DELETE_HOC_KY,
                    type : "DELETE",
                    data : {
                        'id_hoc_ky': id,
                    },
                    success : function (result){
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
