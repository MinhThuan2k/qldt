@extends('auth.master')
@section('title') Quản lí thông tin Hệ đào tạo @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý thông tin/Hệ đào tạo
            </h1>
        </section>
        <section class="content">

            <button class="btn btn-success btnThem">Thêm mới</button>

            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th style="width: 150px;">Mã hệ đào tạo</th>
                            <th>Tên hệ đào tạo</th>
                            <th style="width: 150px;">Cập nhật lúc</th>
                            <th style="width: 70px;"></th>
                        </tr>

                        @foreach( $data as $item)
                            <tr>
                                <td><b>{{ $item->ma_he_dao_tao }}</b></td>
                                <td>{{ $item->ten_he_dao_tao }}</td>
                                <td>{{ $item->ngay_cap_nhat }}</td>

                                <td class="text-center">
                                    <a data="{{ toAttrJson($item, ['id_he_dao_tao', 'ma_he_dao_tao', 'ten_he_dao_tao']) }}"
                                        class="itemCapNhat" href="#"><i
                                            class="fa fa-pencil" aria-hidden="true" ></i></a>
                                    <a data="{{ $item->id_he_dao_tao }}" class="itemXoa" href="#"><i
                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {{--            Hết bảng--}}

            {{--Modal thêm--}}
            <div class="modal fade" id="modalThem">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-bold">Thêm thông tin Hệ đào tạo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Mã hệ đào tạo (*)</label>
                                    <input class="form-control maHeDaoTao" type="text" placeholder="Mã hệ đào tạo">
                                </div>
                                <div class="col-md-8">
                                    <label for="">Tên hệ đào tạo (*)</label>
                                    <input class="form-control tenHeDaoTao" type="text" placeholder="Tên hệ đào tạo">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--Hết modal thêm--}}



        </section>
    </div>

@endsection

@section('script')
    <script>

        var PUT_HE_DAO_TAO = "{{ action('App\Http\Controllers\HeDaoTaoController@putHeDaoTao') }}";
        var DELETE_HE_DAO_TAO = "{{ action('App\Http\Controllers\HeDaoTaoController@deleteHeDaoTao') }}";
        var POST_HE_DAO_TAO = "{{ action('App\Http\Controllers\HeDaoTaoController@postHeDaoTao') }}"
        $(document).ready(function () {

            $('.btnThem').click(function (){
                $('.maHeDaoTao, .tenHeDaoTao').val('');
                $('#modalThem .modal-title').text('Thêm thông tin Hệ đào tạo');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });


            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.maHeDaoTao').val(data.ma_he_dao_tao);
                $('.tenHeDaoTao').val(data.ten_he_dao_tao);
                $('#modalThem .modal-title').text('Cập nhật thông tin Hệ đào tạo');
                $('.btnLuu').attr('data', data.id_he_dao_tao).attr('type', 'update');
                $('#modalThem').modal('show');
            });




            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.maHeDaoTao').val())) {
                    toastr.error("Mã hệ đào tạo không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.tenHeDaoTao').val())) {
                    toastr.error("Tên hệ đào tạo không được bỏ trống", "Thao tác thất bại");
                    return;
                }
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_HE_DAO_TAO,
                            type: "PUT",
                            data: {
                                'ma_he_dao_tao': $('.maHeDaoTao').val(),
                                'ten_he_dao_tao': $('.tenHeDaoTao').val(),
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
                        var id_he_dao_tao = $(this).attr('data');
                        $.ajax({
                            url: POST_HE_DAO_TAO,
                            type: "POST",
                            data: {
                                'id_he_dao_tao': id_he_dao_tao,
                                'ma_he_dao_tao': $('.maHeDaoTao').val(),
                                'ten_he_dao_tao': $('.tenHeDaoTao').val(),
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
                    url: DELETE_HE_DAO_TAO,
                    type: "DELETE",
                    data: {
                        'id_he_dao_tao': id,
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
