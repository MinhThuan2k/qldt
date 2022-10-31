@extends('auth.master')
@section('title') Quản lý thông tin Học phần @endsection
@section('content')
    <div class="container-fluid no-padding">
        <section class="content-header">
            <h1 class="text-bold">
                {{$ten_don_vi}} / Cây tiến trình {{$ten_chuong_trinh}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonViCT', $id_don_vi) }}">{{$ten_don_vi}}</a></li>
                </li>
                <li><a href="{{ action('App\Http\Controllers\ChuongTrinhDaoTaoController@getChuongTrinhDaoTao', ['id_don_vi'=>$id_don_vi]) }}">Chương trình đào tạo</a></li>
                <li class="active">{{ $ten_chuong_trinh  }}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success btnSua">Thêm học phần</button>
                    <div class="box" style="padding: 10px">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover" id="bang">
                                <thead>
                                <tr>
                                    <th style="width:100px">Mã học phần</th>
                                    <th style="width:300px">Tên học phần</th>
                                    <th style="width:300px">Tên tiếng Anh</th>
                                    <th style="width:300px">Môn tiên quyết</th>
                                    <th style="width:150px">Tín chỉ</th>
                                    <th style="width:150px">Học kỳ</th>
                                    <th style="width:50px"></th>
                                </tr>
                                </thead>
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
                    <h4 class="modal-title text-bold">Thêm thông tin Học phần</h4>
                </div>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Thêm học phần</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Tạo học phần</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Thêm học phần</label>
                                    <select name="hocphan" id="hocphan" class="form-control" >
                                        @foreach($hocphan as $item)
                                            <option value="{{$item->id_hoc_phan}}" @foreach($data as $i) @if($i->id_hoc_phan == $item->id_hoc_phan) selected @endif @endforeach>{{$item->ten_hoc_phan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="text-info">Môn tiên quyết</label>
                                    <select name="montienquyet[]" id="montienquyet" class="form-control" multiple="multiple">
                                        @foreach($hocphan as $item)
                                            <option value="{{$item->id_hoc_phan}}">{{$item->ten_hoc_phan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Học kỳ</label>
                                    <select name="hocky" id="hocky" class="form-control" >
                                        @for($i=1; $i<=8; $i++)
                                            <option value="{{$i}}">Học kỳ {{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Mã học phần </label>
                                    <input class="form-control _ma_hoc_phan" type="text" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tên học phần</label>
                                    <input class="form-control _ten_hoc_phan" type="text" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tên tiếng anh</label>
                                    <input class="form-control _ten_tieng_anh" type="text" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Số tín chỉ lý thuyết</label>
                                    <input class="form-control _tin_chi_lt" type="number" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Số tín chỉ thực hành</label>
                                    <input class="form-control _tin_chi_th" type="number" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Trạng thái</label>
                                    <select class="form-control trang_thai" readonly>
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-4 col-md-offset-8">
                                    <button type="button" class="btn btn-primary btn-block btnLuu">Thêm</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Mã học phần (*)</label>
                                    <input class="form-control ma_hoc_phan" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tên học phần(*)</label>
                                    <input class="form-control ten_hoc_phan" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Tên tiếng anh(*)</label>
                                    <input class="form-control ten_tieng_anh" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Số tín chỉ lý thuyết(*)</label>
                                    <input class="form-control tin_chi_lt" type="number">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Số tín chỉ thực hành(*)</label>
                                    <input class="form-control tin_chi_th" type="number">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Trạng thái(*)</label>
                                    <select class="form-control trang_thai">
                                        <option value="1">Bật</option>
                                        <option value="0">Tắt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-4 col-md-offset-8">
                                    <button type="button" class="btn btn-primary btn-block btnThemHocPhan">Lưu thông tin</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        var PUT_CAY_TIEN_TRINH = "{{action('App\Http\Controllers\CayTienTrinhController@putCayTienTrinh')}}";
        var PUT_HOC_PHAN = "{{action('App\Http\Controllers\HocPhanController@putHocPhan')}}";
        var DELETE_HOC_PHAN_THEO_CTDT = "{{action('App\Http\Controllers\CayTienTrinhController@deleteCayTienTrinh')}}";
        var GET_HOC_PHAN_BY_ID = "{{action('App\Http\Controllers\CayTienTrinhController@getHocPhanById')}}";

        var entityMap = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
            '/': '&#x2F;',
            '`': '&#x60;',
            '=': '&#x3D;'
        };

        function escapeHtml (string) {
            return String(string).replace(/[&<>"'`=\/]/g, function (s) {
                return entityMap[s];
            });
        }

        $(document).ready(function () {
            var groupColumn = 5;
            $('#bang').dataTable({
                reponsive: true,
                orderable: false,
                ajax:{
                    "url": "{{action('App\Http\Controllers\CayTienTrinhController@getCayTienTrinhDatatable')}}",
                    "dataSrc": "",
                    "type": "POST",
                    "data": {id_chuong_trinh: "{{$id_chuong_trinh}}"}
                },
                "columns": [
                    { "data": "ma_hoc_phan" },
                    { "data": "ten_hoc_phan" },
                    { "data": "ten_tieng_anh" },
                    { "data": "mon_tien_quyet" },
                    { "data": "tin_chi"},
                    { "data": "hoc_ky"},
                    { "data": "button"},
                ],
                columnDefs: [{
                    targets: [-1], render: function (data, type, row, meta) {
                        var json = JSON.stringify(row);
                        return '<a class="itemXoa" href="#" data="'+escapeHtml(json)+'"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>'
                    },
                },
                    {
                        orderable: false, targets: "_all"
                    },
                {
                    targets: '_all',
                    className: 'dt-body-center'}
                ],
                "order": [[groupColumn, 'asc']],
                "displayLength": 500,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var last = null;
                    api.column(groupColumn, {page: 'current'}).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td style="font-size: 16px; background-color: #ecf0f1; color:#e74c3c" class="text-bold" colspan="8">Học kỳ ' + group + '</td></tr>'
                            );
                            last = group;
                        }
                    });
                }
            });

            $('.changeModal').on('click', function () {
                $('.ma_hoc_phan, .ten_hoc_phan, .ten_tieng_anh, .tin_chi_lt, .tin_chi_th').val('');
                $('#modalThem').modal('toggle');
                $('#modalThemHocPhan').modal('toggle');
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
            $('#montienquyet').select2(
                {
                    placeholder: 'Chọn môn tiên quyết...',
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
            $('#hocphan').on('change', function () {
                $.ajax({
                    url: GET_HOC_PHAN_BY_ID,
                    type: "post",
                    data: {
                        'id_hoc_phan': $(this).val(),
                    },
                    success: function (result) {
                        item = JSON.parse(result);
                        $('._ma_hoc_phan').val(item.ma_hoc_phan);
                        $('._ten_hoc_phan').val(item.ten_hoc_phan);
                        $('._ten_tieng_anh').val(item.ten_tieng_anh);
                        $('._tin_chi_lt').val(item.tin_chi_lt);
                        $('._tin_chi_th').val(item.tin_chi_th);
                        $('._trang_thai').val(item.trang_thai);
                    }
                });
            });
            $('.btnSua').click(function () {
                $('#modalThem .modal-title').text('Thêm thông tin Học phần');
                $('.btnLuu').attr('type', 'insert');
                $('#modalThem').modal('show');
            });

            $('.btnLuu').on('click', function () {
                $.ajax({
                    url: PUT_CAY_TIEN_TRINH,
                    type: "PUT",
                    data: {
                        'id_chuong_trinh': {{$id_chuong_trinh}},
                        'id_hoc_phan': $('#hocphan').val(),
                        'id_mon_tien_quyet': $('#montienquyet').val(),
                        'hocky': $('#hocky').val(),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            $('#bang').DataTable().ajax.reload();
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }
                    }
                });
            });
            $('.btnThemHocPhan').on('click', function () {
                if (
                    isNULLorEmpty($('.ma_hoc_phan').val())
                    || isNULLorEmpty($('.ten_hoc_phan').val())
                    || isNULLorEmpty($('.ten_tieng_anh').val())
                ) {
                    toastr.error("Không được bỏ trống trường nào!", "Thao tác thất bại");
                    return;
                }
                $.ajax({
                    url: PUT_HOC_PHAN,
                    type: "PUT",
                    data: {
                        'ma_hoc_phan': $('.ma_hoc_phan').val(),
                        'ten_hoc_phan': $('.ten_hoc_phan').val(),
                        'ten_tieng_anh': $('.ten_tieng_anh').val(),
                        'tin_chi_lt': $('.tin_chi_lt').val(),
                        'tin_chi_th': $('.tin_chi_th').val(),
                        'trang_thai': $('.trang_thai').val(),
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            $('.ma_hoc_phan, .ten_hoc_phan, .ten_tieng_anh, .tin_chi_lt, .tin_chi_th').val('');
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }
                    }
                });
            });
            $('#bang tbody').on('click', 'a', function () {
                if (!confirm("Chọn vào 'YES' để xác nhận xóa thông tin?\nSau khi xóa dữ liệu sẽ không thể phục hồi lại được.")) {
                    return;
                }
                var data = JSON.parse($(this).attr('data'));
                $.ajax({
                    url: DELETE_HOC_PHAN_THEO_CTDT,
                    type: "DELETE",
                    data: {
                        'id_hoc_phan': data.id_hoc_phan,
                        'id_chuong_trinh': data.id_chuong_trinh
                    },
                    success: function (result) {
                        result = JSON.parse(result);
                        if (result.status === 200) {
                            toastr.success(result.message, "Thao tác thành công");
                            $('#bang').DataTable().ajax.reload();
                        } else {
                            toastr.error(result.message, "Thao tác thất bại");
                        }
                    }
                });
            });
        });
    </script>
@endsection
