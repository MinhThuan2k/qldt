@extends('auth.giao-dien-dk-hp.master')
@section('title') ĐĂNG KÝ HỌC PHẦN @endsection
@section('content')
    <div class="content-wrapper" style="min-height: 251px;">
        <div class="container">
            <section class="content-header">
                <h1>
                    Khảo sát đăng ký môn học
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
                        <h3 class="box-title">Chọn đợt khảo sát</h3>
                    </div>
                        <div class="box-body">
                            <select id="dotDangKy" class="form-control">
                                <option value="" selected>Chọn đợt khảo sát</option>
                                @foreach($ds as $item)
                                    <option value="{{$item->id_dang_ky_khao_sat}}">
                                        {{$item->ten_nam_hoc .' - '. $item->ten_hoc_ky}}
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
                                <p>*Học viên chọn môn học muốn đăng ký trong đợt sắp tới</p>
                            </div>
                            <div class="col-3 form-group">
                                <label for="">Học phần</label>
                                <select id="hocphan" multiple></select>
                            </div>
                            <div class="col-3 form-group">
                                <button class="btn btn-success" id="btnDangKy">ÁP DỤNG</button>
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
        var GET_CHI_TIET_DOT_DANG_KY = "{{action('App\Http\Controllers\KhaoSatDangKyHocPhanController@get_DotKhaoSat')}}";
        var DANG_KY_KHAO_SAT = "{{action('App\Http\Controllers\KhaoSatDangKyHocPhanController@dangKyMonHoc')}}";

        $('#dotDangKy').on('change', function () {
            $('#hocphan').val(null).trigger('change');
            $.ajax({
                url: GET_CHI_TIET_DOT_DANG_KY,
                type: "POST",
                dataSrc: "",
                data: {
                    'id_dang_ky_khao_sat': $(this).val()
                },
                success: function (result) {
                    var json = JSON.parse(result);
                    $('#tenHocKy').val(json.ten_hoc_ky);
                    $('#namHoc').val(json.ten_nam_hoc);
                    $('#thoiGianMo').val(json.ngay_mo);
                    $('#thoiGianDong').val(json.ngay_dong);
                    $('#btnDangKy').prop("disabled", false);
                }
            });
            var hocPhan = $('#hocphan');
            $.ajax({
                type: 'GET',
                url: '{{action('App\Http\Controllers\KhaoSatDangKyHocPhanController@getKhaoSat')}}',
                data:{
                    id_hoc_vien: '{{session()->get('id')}}',
                    id_dang_ky_khao_sat: $('#dotDangKy').val(),
                }
            }).then(function (result) {
                var result = JSON.parse(result);
                for(var i in result)
                {
                    var data = result[i];
                    console.log(data);
                    var option = new Option(data.ten_hoc_phan, data.id_hoc_phan, true, true);
                    hocPhan.append(option).trigger('change');
                    // manually trigger the `select2:select` event
                    hocPhan.trigger({
                        type: 'select2:select',
                        params: {
                            data: data
                        }
                    });
                }
            });
        });
        $('#btnDangKy').on('click', function () {
            $.ajax({
                url: DANG_KY_KHAO_SAT,
                type: "PUT",
                data: {
                    'id_dang_ky_khao_sat': $('#dotDangKy').val(),
                    'id_hoc_phan': $('#hocphan').val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        toastr.success(result.message, "Thao tác thành công");
                        setTimeout(function () {
                            // window.location.reload();
                        }, 500);
                    } else {
                        toastr.error(result.message, "Thao tác thất bại");
                    }
                }
            });
        });
        $('#hocphan').select2(
            {
                placeholder: 'Chọn học phần...',
                ajax: {
                    url: '{{action('App\Http\Controllers\ChuongTrinhDaoTaoController@timHocPhan')}}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.ten_hoc_phan,
                                    id: item.id_hoc_phan,
                                }
                            })
                        };
                    },
                    templateSelection: function (data, container) {
                        // Add custom attributes to the <option> tag for the selected option
                        $(data.element).attr('data-custom-attribute', data.customValue);
                        return data.text;
                    },
                    cache: true,
                }
            }
        );

    </script>
@endsection
