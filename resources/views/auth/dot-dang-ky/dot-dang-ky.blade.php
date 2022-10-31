@extends('auth.master')
@section('title') Đợt đăng ký @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Đợt đăng ký
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
                                <th>Tên đợt đăng ký</th>
                                <th>Tên học kỳ</th>
                                <th>Tên năm học</th>
                                <th style="width: 150px;">Thời gian mở</th>
                                <th style="width: 150px;">Thời gian đóng</th>
                                <th style="width: 150px;">Ngày tạo</th>
                                <th style="width: 70px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td> {{$item->ten_dot_dang_ky }}</td>
                                <td> {{$item->ten_hoc_ky }}</td>
                                <td> {{$item->ten_nam_hoc}}</td>
                                <td> {{$item->thoi_gian_mo }}</td>
                                <td> {{$item->thoi_gian_dong }}</td>
                                <td> {{$item->thoi_gian_tao }}</td>
                                <td class="text-center">
                                    <a data="{{ toAttrJson($item, ['id_dot_dang_ky','ten_dot_dang_ky','id_hoc_ky','thoi_gian_mo','thoi_gian_dong']) }}"
                                       class="itemCapNhat" href="#">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a data="{{ $item->id_dot_dang_ky }}" class="itemXoa" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                        <h4 class="modal-title">Thêm thông tin Đợt đăng ký</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tên đợt đăng ký (*)</label>
                                <input class="form-control ten_dot_dang_ky" type="text" placeholder="Tên đợt đăng ký">
                            </div>
                            <div class="col-md-6">
                                <label for="">Tên học kỳ</label>
                                <select class="form-control id_hoc_ky">
                                    @foreach($dsHocKy as $item)
                                    <option value="{{$item->id_hoc_ky}}"> {{$item->ten_hoc_ky.' ('.$item->ten_nam_hoc.')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Thời gian mở (*)</label>
                                <input class="form-control thoi_gian_mo" type="date" >
                            </div>
                            <div class="col-md-6">
                                <label for="">Thời gian đóng (*)</label>
                                <input class="form-control thoi_gian_dong" type="date" >
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
        var PUT_DOT_DANG_KY ="{{ action('App\Http\Controllers\DotDangKyController@putDotDangKy') }}";
        var DELETE_DOT_DANG_KY = "{{ action('App\Http\Controllers\DotDangKyController@deleteDotDangKy') }}";
        var POST_DOT_DANG_KY = "{{ action('App\Http\Controllers\DotDangKyController@updateDotDangKy') }}";
        $(document).ready(function () {
            $('.table').dataTable();
            $('.btnThem').click(function () {
                $('.id_hoc_ky, .ten_dot_dang_ky, .thoi_gian_mo,.thoi_gian_dong').val('');
                $('#modal-default .modal-title').text('Thêm thông tin Đợt đăng ký');
                $('.btnLuu').attr('type', 'insert');
                $('#modal-default').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.ten_dot_dang_ky').val(data.ten_dot_dang_ky);
                $('.id_hoc_ky').val(data.id_hoc_ky);
                $('.thoi_gian_mo').val(data.thoi_gian_mo);
                $('.thoi_gian_dong').val(data.thoi_gian_dong);
                $('#modal-default .modal-title').text('Cập nhật thông tin Đợt đăng ký');
                $('.btnLuu').attr('data', data.id_dot_dang_ky).attr('type', 'update');
                $('#modal-default').modal('show');
            });



            $('.btnLuu').click(function (){
                if (isNULLorEmpty($('.ten_dot_dang_ky').val())) {
                    toastr.error("Tên đợt đăng ký không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.thoi_gian_mo').val())) {
                    toastr.error("Thời gian mở không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.thoi_gian_dong').val())) {
                    toastr.error("Thời gian đóng không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.id_hoc_ky').val())) {
                    toastr.error("Hoc kỳ không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if($('.thoi_gian_mo').val()>$('.thoi_gian_dong').val()){
                    toastr.error("Thời gian mở không được nằm sau thời gian đóng", "Thao tác thất bại");
                    return;
                }


                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_DOT_DANG_KY,
                            type: "PUT",
                            data: {
                                'ten_dot_dang_ky': $('.ten_dot_dang_ky').val(),
                                'id_hoc_ky': $('.id_hoc_ky').val(),
                                'thoi_gian_mo': $('.thoi_gian_mo').val(),
                                'thoi_gian_dong': $('.thoi_gian_dong').val(),
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
                        var id_dot_dang_ky = $(this).attr('data');
                        $.ajax({
                            url : POST_DOT_DANG_KY,
                            type : "post",
                            data : {
                                'id_dot_dang_ky': id_dot_dang_ky,
                                'ten_dot_dang_ky': $('.ten_dot_dang_ky').val(),
                                'id_hoc_ky': $('.id_hoc_ky').val(),
                                'thoi_gian_mo': $('.thoi_gian_mo').val(),
                                'thoi_gian_dong': $('.thoi_gian_dong').val(),
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

                    url : DELETE_DOT_DANG_KY,
                    type : "DELETE",
                    data : {
                        'id_dot_dang_ky': id,
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
