@extends('auth.master')
@section('title') Cài Đặt Đăng Ký Môn @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                Quản lý đăng ký học phần
            </h1>
        </section>
        <section class="content">
            <button class="btn btn-success btnSua">Thay đổi</button>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tbody>
                                @foreach($data as $item)
                                    <thead>
                                    <tr>
                                        <th style="width: 350px;">Tín chỉ tối đa (HS Yếu)</th>
                                        <td>
                                            <input class="center tcToiDaYeu" type="text" value="{{$item->tin_chi_toi_da_yeu}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tín Chỉ Tối Thiểu (HS Yếu)</th>
                                        <td>
                                            <input class="center tcToiThieuYeu" type="text" value="{{$item->tin_chi_toi_thieu_yeu}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tín chỉ tối đa (HS Bình Thường)</th>
                                        <td>
                                            <input class="center tcToiDaThuong" type="text" value="{{$item->tin_chi_toi_da_binh_thuong}}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tín chỉ tối thiểu (HS Bình Thường)</th>
                                        <td>
                                            <input class="center tcToiThieuThuong" type="text" value="{{$item->tin_chi_toi_thieu_binh_thuong }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Điều kiện được xem là học viên bình thường</th>
                                        <td>
                                            <input class="center dieuKien" type="text" value="{{$item->dieu_kien }}">
                                        </td>
                                    </tr>
                                    </thead>
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </section>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            var POST_CAI_DAT = "{{ action('App\Http\Controllers\CaiDatDangKyMonController@postCaiDat') }}"
            $(document).ready(function () {

                $('.btnSua').click(function () {
                    if (!confirm("Chọn vào 'YES' để xác nhận thay đổi cài đặt?\nSau khi thay đổi dữ liệu sẽ không thể phục hồi lại được.")) {
                        return;
                    }
                    if (isNULLorEmpty($('.tcToiDaYeu').val())) {
                        toastr.error("Tín chỉ tối đa của học viên yếu không được bỏ trống", "Thao tác thất bại");
                        return;
                    }
                    if (isNULLorEmpty($('.tcToiDaThuong').val())) {
                        toastr.error("Tín chỉ tối đa của học viên bình thường không được bỏ trống", "Thao tác thất bại");
                        return;
                    }
                    if (isNULLorEmpty($('.tcToiThieuYeu').val())) {
                        toastr.error("Tín chỉ tối thiểu của học viên yếu không được bỏ trống", "Thao tác thất bại");
                        return;
                    }
                    if (isNULLorEmpty($('.tcToiThieuThuong').val())) {
                        toastr.error("Tín chỉ tối thiểu của học viên bình thường không được bỏ trống", "Thao tác thất bại");
                        return;
                    }
                    if (isNULLorEmpty($('.dieuKien').val())) {
                        toastr.error("Điều kiện được xem là học viên bình thường không được bỏ trống", "Thao tác thất bại");
                        return;
                    }
                    if ($('.dieuKien').val() <=0 || $('.tcToiThieuYeu').val() <= 0  || $('.tcToiDaYeu').val() <= 0 || $('.tcToiDaThuong').val() <= 0 || $('.tcToiThieuThuong').val() <= 0) {
                        toastr.error("Dữ liệu thay đổi không được âm", "Thao tác thất bại");
                        return;
                    }

                    $.ajax({
                        url: POST_CAI_DAT,
                        type: "POST",
                        data: {
                            'id_cai_dat_dang_ky_mon': '1',
                            'tin_chi_toi_da_yeu': $('.tcToiDaYeu').val(),
                            'tin_chi_toi_thieu_yeu': $('.tcToiThieuYeu').val(),
                            'tin_chi_toi_da_binh_thuong': $('.tcToiDaThuong').val(),
                            'tin_chi_toi_thieu_binh_thuong': $('.tcToiThieuThuong').val(),
                            'dieu_kien': $('.dieuKien').val()
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
        });
    </script>
@endsection
