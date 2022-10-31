@extends('auth.giao-dien-dk-hp.master')
@section('title') ĐĂNG KÝ HỌC PHẦN @endsection
@section('content')
    <div class="content-wrapper" style="min-height: 251px;">
        <div class="container">
            <section class="content-header">
                <h1>
                    Đăng ký lớp học phần
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                    <li><a href="#">Đăng ký...</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chọn học phần</h3>
                    </div>
                        <div class="box-body">
                            <select id="dotDangKy" class="form-control">
                                <option value="" selected>Chọn đợt đăng ký</option>
                                @foreach($dot_dang_ky as $item)
                                    <option value="{{$item->id_dot_dang_ky}}">
                                        {{$item->ten_dot_dang_ky}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="col-3 form-group">
                                <label for="">Tên học kỳ</label>
                                <input type="text" id="tenHocKy" class="form-control" readonly>
                            </div>
                            <div class="col-3 form-group">
                                <label for="">Năm học</label>
                                <input type="text" id="namHoc" class="form-control" readonly>
                            </div>
                            <div class="col-3 form-group">
                                <label for="">Thời gian mở</label>
                                <input type="text" id="thoiGianMo" class="form-control" readonly>
                            </div>
                            <div class="col-3 form-group">
                                <label for="">Thời gian đóng</label>
                                <input type="text" id="thoiGianDong" class="form-control" readonly>
                            </div>
                            <div class="col-3 form-group">
                                <a href="{{route('dangKyHocPhan',['id_dot_dang_ky'=>'0'])}}" id="dangKy">
                                    <button class="btn btn-success" id="btnDangKy" disabled>ĐĂNG KÝ</button>
                                </a>
                            </div>
                        </div>
                </div>
            </section>
            <!-- /.content -->


        </div>

    </div>

@endsection

@section('script')
    <script>
        var GET_CHI_TIET_DOT_DANG_KY = "{{action('App\Http\Controllers\DangKyHocPhanController@getChiTietDotDangKy')}}";
        $('#dotDangKy').on('change', function () {
            $.ajax({
                url: GET_CHI_TIET_DOT_DANG_KY,
                type: "POST",
                dataSrc: "",
                data: {
                    'id_dot_dang_ky': $(this).val()
                },
                success: function (result) {
                    var json = JSON.parse(result);
                    $('#tenHocKy').val(json.ten_hoc_ky);
                    $('#namHoc').val(json.ten_nam_hoc);
                    $('#thoiGianMo').val(json.thoi_gian_mo);
                    $('#thoiGianDong').val(json.thoi_gian_dong);
                    var url = $('#dangKy').attr('href').slice(0,$('#dangKy').attr('href').length-1);
                    $('#dangKy').attr('href', url + json.id_dot_dang_ky);
                    $('#btnDangKy').prop( "disabled", false );
                }
            });
        });
    </script>
@endsection
