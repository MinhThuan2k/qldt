@extends('auth.master')
@section('title') Phòng học @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Phòng học
            </h1>
        </section>

        <section class="content-header">
        </section>
        <section class="content">
            <button class="btn btn-success btnThem">Thêm mới</button>
            <a class="btn btn-primary" href="{{action('App\Http\Controllers\PhongController@exportPhong')}}" >Xuất file</a>

            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                    <table class="table table-striped" >
                        <thead>
                        <tr>
                            <th></th>
                            <th style="width: 200px;">Tên phòng</th>
                            <th style="width: 100px;">Mã phòng</th>
                            <th>Sức chứa</th>
                            <th>Vị trí</th>
                            <th style="width: 150px;" hidden>Trạng thái</th>
                            <th style="width: 150px;">Ngày cập nhật</th>
                            <th style="width: 70px;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td></td>
                                <td> {{$item->ten_phong }}</td>
                                <td>Nhà {{$item->ma_phong }}</td>
                                <td>{{$item->suc_chua}}</td>
                                <td> {{$item->vi_tri }}</td>
                                @if($item->trang_thai === 1)
                                    <td hidden><span class="label label-success">Kích hoạt</span></td>
                                @else
                                    <td hidden><span class="label label-warning">Khóa</span></td>
                                @endif
                                <td> {{$item->ngay_cap_nhat }}</td>
                                <td class="text-center">
                                    <a data="{{ toAttrJson($item, ['id_phong','suc_chua', 'ma_phong', 'ten_phong', 'vi_tri','trang_thai']) }}"
                                       class="itemCapNhat" href="#">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a data="{{ $item->id_phong }}" class="itemXoa" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                        <h4 class="modal-title">Thêm thông tin phòng học</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tòa nhà (*)</label>
                                <input class="form-control ma_phong" type="text" placeholder="vd: A, B, C, ...">
                            </div>
                            <div class="col-md-6">
                                <label for="">Tên phòng (*)</label>
                                <input class="form-control ten_phong" type="text" placeholder="vd: C0606,...">
                            </div>
                            <div class="col-md-6">
                                <label for="">Sức chứa (*)</label>
                                <input class="form-control suc_chua" type="number" min="1" placeholder="Sức chứa">
                            </div>
                            <div class="col-md-6">
                                <label for="">Vị trí (*)</label>
                                <input class="form-control vi_tri" type="text" placeholder="vd: Tầng 6,...">
                            </div>
                            <div class="col-md-6">
                                <label for="">Trạng thái (*)</label>
                                <select class="form-control trang_thai">
                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Khóa</option>
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
        var PUT_PHONG ="{{ action('App\Http\Controllers\PhongController@putPhong') }}";
        var DELETE_PHONG = "{{ action('App\Http\Controllers\PhongController@updatePhong') }}";
        var POST_PHONG = "{{ action('App\Http\Controllers\PhongController@deletePhong') }}";
        $(document).ready(function () {
            $('.table').dataTable();
            $('.btnThem').click(function () {
                $('.ma_phong,.ten_phong,.vi_tri,.trang_thai').val('');
                $('#modal-default .modal-title').text('Thêm thông tin Phòng học');
                $('.btnLuu').attr('type', 'insert');
                $('#modal-default').modal('show');
            });
            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.ma_phong').val(data.ma_phong);
                $('.ten_phong').val(data.ten_phong);
                $('.vi_tri').val(data.vi_tri);
                $('.trang_thai').val(data.trang_thai);
                $('.suc_chua').val(data.suc_chua);
                $('#modal-default .modal-title').text('Cập nhật thông tin Phòng học');
                $('.btnLuu').attr('data', data.id_phong).attr('type', 'update');
                $('#modal-default').modal('show');
            });
            $('.btnLuu').click(function (){
                if (isNULLorEmpty($('.ma_phong').val())) {
                    toastr.error("Mã phòng học không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.ten_phong').val())) {
                    toastr.error("Tên phòng học không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_PHONG,
                            type: "PUT",
                            data: {
                                'ma_phong': $('.ma_phong').val(),
                                'ten_phong': $('.ten_phong').val(),
                                'vi_tri': $('.vi_tri').val(),
                                'trang_thai': $('.trang_thai').val(),
                                'suc_chua': $('.suc_chua').val(),
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
                        var id_phong = $(this).attr('data');
                        $.ajax({
                            url : POST_PHONG,
                            type : "post",
                            data : {
                                'id_phong': id_phong,
                                'ma_phong': $('.ma_phong').val(),
                                'ten_phong': $('.ten_phong').val(),
                                'vi_tri': $('.vi_tri').val(),
                                'trang_thai': $('.trang_thai').val(),
                                'suc_chua': $('.suc_chua').val(),
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
                    url : DELETE_PHONG,
                    type : "DELETE",
                    data : {
                        'id_phong': id,
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
        var groupColumn = 2;
        var table = $('.table').DataTable({
            "ordering": false,
            "columnDefs": [
                {"visible": false, "targets": groupColumn}
            ],
            "order": [[groupColumn, 'desc']],
            "displayLength": 50,
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                api.column(groupColumn, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group"><td style="font-size: 16px;" class="text-bold text-danger" colspan="8">' + group + '</td></tr>'
                        );
                        last = group;
                    }
                });
            }
        });

    </script>
@endsection
