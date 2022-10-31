@extends('auth.master')
@section('title') Học phí @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin Học phí
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
                                    <th>Hệ đào tạo</th>
                                    <th>Học kỳ</th>
                                    <th style="width: 100px;">Chuyên ngành</th>
                                    <th>Tiền lý thuyết</th>
                                    <th>Tiền thực hành</th>
                                    <th style="width: 100px;">Trạng thái</th>
                                    <th style="width: 150px;">Ngày cập nhật</th>
                                    <th style="width: 70px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td> {{$item->ten_he_dao_tao }}</td>
                                        <td> {{$item->ten_hoc_ky }}</td>
                                        <td> {{$item->ten_chuyen_nganh}}</td>
                                        <td> {{$item->ly_thuyet }} VND</td>
                                        <td> {{$item->thuc_hanh }} VND</td>
                                        @if($item->trang_thai === 1)
                                            <td><span class="label label-warning">Đã Đóng</span></td>
                                        @else
                                            <td><span class="label label-success">Còn mở</span></td>
                                        @endif
                                        <td> {{$item->ngay_cap_nhat }}</td>
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item, ['id_hoc_phi', 'id_he_dao_tao', 'id_hoc_ky', 'id_chuyen_nganh', 'ly_thuyet','ngay_tao','ngay_cap_nhat','thuc_hanh','trang_thai']) }}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_hoc_phi }}" class="itemXoa" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                        <h4 class="modal-title">Thêm thông tin học phí</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tên hệ đào tạo</label>
                                <select class="form-control id_he_dao_tao">
                                    @foreach($data1 as $item)
                                        <option value="{{$item->id_he_dao_tao}}">{{$item->ten_he_dao_tao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tên học kỳ</label>
                                <select class="form-control id_hoc_ky">
                                    @foreach($data2 as $item)
                                        <option value="{{$item->id_hoc_ky}}">{{$item->ten_hoc_ky}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tên chuyên ngành</label>
                                <select class="form-control id_chuyen_nganh">
                                    @foreach($data3 as $item)
                                        <option value="{{$item->id_chuyen_nganh}}">{{$item->ten_chuyen_nganh}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Lý thuyết (*)</label>
                                <input class="form-control ly_thuyet" type="text" placeholder="Số tiền lý thuyết">
                            </div>
                            <div class="col-md-6">
                                <label for="">Thực hành (*)</label>
                                <input class="form-control thuc_hanh" type="text" placeholder="Số tiền thực hành">
                            </div>
                            <div class="col-md-6">
                                <label for="">Trạng thái (*)</label>
                                <select class="form-control trang_thai">
                                    <option value="2">Mở</option>
                                    <option value="1">Đóng</option>
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
        var PUT_HOC_PHI ="{{ action('App\Http\Controllers\HocPhiController@putThemHocPhi') }}";
        var DELETE_HOC_PHI = "{{ action('App\Http\Controllers\HocPhiController@xoaHocPhi') }}";
        var POST_HOC_PHI = "{{ action('App\Http\Controllers\HocPhiController@updateHocKy') }}";

        $(document).ready(function () {
            $('.table').dataTable();

            $('.btnThem').click(function () {
                $('.id_chuyen_nganh, .id_he_dao_tao, .id_hoc_ky, .ten_hoc_ky, .ten_he_dao_tao, .ten_chuyen_nganh, .ly_thuyet, .thuc_hanh,.trang_thai').val('');
                $('#modal-default .modal-title').text('Thêm thông tin Học kỳ');
                $('.btnLuu').attr('type', 'insert');
                $('#modal-default').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.id_chuyen_nganh').val(data.id_chuyen_nganh);
                $('.id_he_dao_tao').val(data.id_he_dao_tao);
                $('.id_hoc_ky').val(data.id_hoc_ky);
                $('.ten_hoc_ky').val(data.ten_hoc_ky);
                $('.ten_he_dao_tao').val(data.ten_he_dao_tao);
                $('.ten_chuyen_nganh').val(data.ten_chuyen_nganh);
                $('.ly_thuyet').val(data.ly_thuyet);
                $('.thuc_hanh').val(data.thuc_hanh);
                $('.trang_thai').val(data.trang_thai);
                $('#modal-default .modal-title').text('Cập nhật thông tin Học phí');
                $('.btnLuu').attr('data', data.id_hoc_phi).attr('type', 'update');
                $('#modal-default').modal('show');
            });

            $('.btnLuu').click(function (){
                if (isNULLorEmpty($('.id_hoc_ky').val())) {
                    toastr.error("Lý thuyết không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.id_chuyen_nganh').val())) {
                    toastr.error("Thực hành không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.id_he_dao_tao').val())) {
                    toastr.error("Trạng thái không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.ly_thuyet').val())) {
                    toastr.error("Lý thuyết không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.thuc_hanh').val())) {
                    toastr.error("Thực hành không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if (isNULLorEmpty($('.trang_thai').val())) {
                    toastr.error("Trạng thái không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                if($('.ly_thuyet').val() < 0 ){
                    toastr.error("Số tiền lý thuyết không được nhỏ hơn 0", "Thao tác thất bại");
                    return;
                }
                if($('.thuc_hanh').val() < 0 ){
                    toastr.error("Số tiền thực hành không được nhỏ hơn 0", "Thao tác thất bại");
                    return;
                }
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_HOC_PHI,
                            type: "PUT",
                            data: {
                                'id_he_dao_tao': $('.id_he_dao_tao').val(),
                                'id_hoc_ky': $('.id_hoc_ky').val(),
                                'id_chuyen_nganh': $('.id_chuyen_nganh').val(),
                                'ly_thuyet': $('.ly_thuyet').val(),
                                'thuc_hanh': $('.thuc_hanh').val(),
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
                        var id_hoc_phi = $(this).attr('data');
                        $.ajax({
                            url : PUT_HOC_PHI,
                            type : "post",
                            data : {
                                'id_hoc_phi': id_hoc_phi,
                                'id_he_dao_tao': $('.id_he_dao_tao').val(),
                                'id_hoc_ky': $('.id_hoc_ky').val(),
                                'id_chuyen_nganh': $('.id_chuyen_nganh').val(),
                                'ly_thuyet': $('.ly_thuyet').val(),
                                'thuc_hanh': $('.thuc_hanh').val(),
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

                    url : DELETE_HOC_PHI,
                    type : "DELETE",
                    data : {
                        'id_hoc_phi': id,
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
