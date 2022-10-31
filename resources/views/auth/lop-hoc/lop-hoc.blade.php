@extends('auth.master')
@section('title') Quản lý thông tin Lớp chuyên ngành @endsection
@section('content')
    <div class="container-fluid no-padding">


        <section class="content-header">
            <h1 class="text-bold">
                {{ $ten_don_vi.'/Lớp chuyên ngành'  }}
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonVi') }}"><i
                            class="fa fa-dashboard"></i>Đơn vị</a></li>
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonViCT', $id_don_vi) }}">
                        {{ $ten_don_vi  }}
                    </a></li>
                <li class="active">Lớp chuyên ngành</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success btnThem">Thêm mới</button>
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 60px"></th>
{{--                                    <th style="width: 90px">Mã lớp</th>--}}
                                    <th style="width: 190px">Lớp</th>
                                    <th>Ngành đào tạo</th>
                                    <th style="width: 100px">Khóa học</th>
{{--                                    <th>Niên khóa</th>--}}
                                    <th>Cố vấn học tập</th>
                                    <th style="width: 50px">Sỉ số</th>
                                    {{--                                    <th>Ghi chú</th>--}}
                                    <th style="width: 140px">Cập nhật lúc</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($ds as $item)
                                    <tr>
                                        <td><a href="{{ action('App\Http\Controllers\HocVienController@getHocVienTheoLop',
                                                        ['id_don_vi'=>$id_don_vi,
                                                        'id_lop_hoc'=>$item->id_lop_hoc]) }}">
                                                Chi tiết</a></td>
                                        <td>{{ $item->ma_lop_hoc.' - '.$item->ten_lop_hoc }}</td>
{{--                                        <td>{{ $item->ten_lop_hoc }}</td>--}}
                                        <td>{{ $item->ten_nganh }}</td>
                                        <td>{{ $item->ten_he_dao_tao.'-'.$item->nien_khoa }}</td>
{{--                                        <td>{{ $item->nien_khoa }}</td>--}}
                                        <td>{{ $item->ho." ".$item->ten }}</td>
                                        <td>{{ $item->si_so}}</td>
{{--                                        <td>{{ $item->ghi_chu }}</td>--}}
                                        <td>{{ $item->ngay_cap_nhat }}</td>
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item, ['id_lop_hoc', 'ma_lop_hoc', 'ten_lop_hoc','si_so', 'ghi_chu','id_nganh','id_he_dao_tao','id_khoa_hoc','id_don_vi','id_giang_vien'])}}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_lop_hoc }}" class="itemXoa" href="#"><i
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
                    <h4 class="modal-title text-bold">Thêm thông tin Lớp chuyên ngành</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Mã lớp (*)</label>
                            <input class="form-control maLopHoc" type="text" placeholder="Mã lớp học">
                        </div>
{{--                        <div class="col-md-3">--}}
{{--                            <label for="">Sỉ số (*)</label>--}}
{{--                            <input class="form-control siSo" type="number" placeholder="Sỉ số">--}}
{{--                        </div>--}}
                        <div class="col-md-9">
                            <label for="">Tên lớp (*)</label>
                            <input class="form-control tenLopHoc" type="text" placeholder="Tên lớp học">
                        </div>
                        <div class="col-md-6" style="margin-top: 10px">
                            <label for="">Tên ngành đào tạo(*)</label>
                            <select class="form-control id_nganh" >
                                <option selected value="-1">Tên ngành</option>
                                @foreach($dsNganhHoc as $item)
                                    <option value="{{$item->id_nganh}}">{{$item->ten_nganh}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="col-md-6" style="margin-top: 10px">
                            <label for="">Tên hệ đào tạo (*)</label>
                            <select class="form-control id_he_dao_tao" >
                                <option selected value="-1">Tên hệ đào tạo</option>
                                @foreach($dsHeDaoTao as $item)
                                    <option value="{{$item->id_he_dao_tao}}">{{$item->ten_he_dao_tao}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px">
                            <label for="">Niên khóa (*)</label>
                            <select class="form-control id_khoa_hoc" >
                                <option selected value="-1">Niên khóa</option>
                                @foreach($dsNienKhoa as $item)
                                    <option value="{{$item->id_khoa_hoc}}">{{$item->nien_khoa}}</option>
                                @endforeach
                            </select>
                        </div>
{{--                        <div class="col-md-6" style="margin-top: 10px">--}}
{{--                            <label for="">Tên đơn vị (*)</label>--}}
{{--                            <select class="form-control id_don_vi" style="width: 70%">--}}
{{--                                <option selected value="-1">Tên đơn vị</option>--}}
{{--                                @foreach($dsDonVi as $item)--}}
{{--                                    <option value="{{$item->id_don_vi}}">{{$item->ten_don_vi}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="col-md-6" style="margin-top: 10px">
                            <label for="">Tên cố vấn học tập (*)</label>
                            <select class="form-control id_giang_vien" >
                                <option selected value="-1">Cố vấn học tập</option>
                                @foreach($dsGiangVien as $item)
                                    <option value="{{$item->id_giang_vien}}">{{$item->ho." ".$item->ten." (".$item->cmnd.")"}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12" style="margin-top: 10px">
                            <label for="">Ghi chú</label>
                            <textarea class="form-control ghiChu" rows="3" cols="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        // $('.table').dataTable();

        var PUT_LOP_HOC = "{{ action('App\Http\Controllers\LopHocController@putLopHoc', $id_don_vi) }}";
        var DELETE_LOP_HOC = "{{ action('App\Http\Controllers\LopHocController@deleteLopHoc') }}";
        var POST_LOP_HOC = "{{ action('App\Http\Controllers\LopHocController@postLopHoc',$id_don_vi) }}";

        $(document).ready(function () {

            $('.btnThem').click(function () {
                $('.maLopHoc, .tenLopHoc, .ghiChu').val('');
                $('#modalThem .modal-title').text('Thêm thông tin Lớp chuyên ngành');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.maLopHoc').val(data.ma_lop_hoc);
                $('.tenLopHoc').val(data.ten_lop_hoc);
                // $('.siSo').val(data.si_so);
                $('.id_nganh').val(data.id_nganh);
                $('.id_he_dao_tao').val(data.id_he_dao_tao);
                $('.id_khoa_hoc').val(data.id_khoa_hoc);
                $('.id_don_vi').val(data.id_don_vi);
                $('.id_giang_vien').val(data.id_giang_vien);
                $('.ghiChu').val(data.ghi_chu);
                $('#modalThem .modal-title').text('Cập nhật thông tin Lớp chuyên ngành');
                $('.btnLuu').attr('data', data.id_lop_hoc).attr('type', 'update');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').click(function () {

                if (isNULLorEmpty($('.maLopHoc').val())) {
                    toastr.error("Mã lớp chuyên ngành không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                if (isNULLorEmpty($('.tenLopHoc').val())) {
                    toastr.error("Tên lớp chuyên ngành không được bỏ trống", "Thao tác thất bại");
                    return;
                }

                // if (isNULLorEmpty($('.siSo').val())) {
                //     toastr.error("Sỉ số lớp học không được bỏ trống", "Thao tác thất bại");
                //     return;
                // }

                if ($('.id_nganh').val()=="-1"){
                    toastr.error("Hãy chọn ngành đào tạo", "Thao tác thất bại");
                    return;
                }

                if ($('.id_he_dao_tao').val()=="-1"){
                    toastr.error("Hãy chọn hệ đào tạo", "Thao tác thất bại");
                    return;
                }

                if ($('.id_khoa_hoc').val()=="-1"){
                    toastr.error("Hãy chọn niên khóa", "Thao tác thất bại");
                    return;
                }

                if ($('.id_giang_vien').val()=="-1"){
                    toastr.error("Hãy chọn cố vấn học tập", "Thao tác thất bại");
                    return;
                }

                if ($('.id_don_vi').val()=="-1"){
                    toastr.error("Hãy chọn đơn vị", "Thao tác thất bại");
                    return;
                }

                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_LOP_HOC,
                            type: "PUT",
                            data: {
                                'ma_lop_hoc': $('.maLopHoc').val(),
                                'ten_lop_hoc': $('.tenLopHoc').val(),
                                // 'si_so': $('.siSo').val(),
                                'id_nganh': $('.id_nganh').val(),
                                'id_he_dao_tao': $('.id_he_dao_tao').val(),
                                'id_khoa_hoc': $('.id_khoa_hoc').val(),
                                'id_don_vi': {{ $id_don_vi }},
                                'id_giang_vien': $('.id_giang_vien').val(),
                                'ghi_chu': $('.ghiChu').val(),
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
                        var id_lop_hoc = $(this).attr('data');
                        $.ajax({
                            url: POST_LOP_HOC,
                            type: "POST",
                            data: {
                                'id_lop_hoc': id_lop_hoc,
                                'ma_lop_hoc': $('.maLopHoc').val(),
                                'ten_lop_hoc': $('.tenLopHoc').val(),
                                // 'si_so': $('.siSo').val(),
                                'id_nganh': $('.id_nganh').val(),
                                'id_he_dao_tao': $('.id_he_dao_tao').val(),
                                'id_khoa_hoc': $('.id_khoa_hoc').val(),
                                'id_don_vi': {{ $id_don_vi }},
                                'id_giang_vien': $('.id_giang_vien').val(),
                                'ghi_chu': $('.ghiChu').val(),
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
                    url: DELETE_LOP_HOC,
                    type: "DELETE",
                    data: {
                        'id_lop_hoc': id,
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
