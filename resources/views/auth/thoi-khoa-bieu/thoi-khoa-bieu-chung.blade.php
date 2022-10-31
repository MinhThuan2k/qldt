@extends('auth.master')
@section('title') Quản lý Thời khóa biểu @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">

            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success btnThem">Thêm mới</button>
                    <div class="box">
                        <div class="box-body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 90px;text-align: center">Tên phòng</th>
                                    <th style="width: 90px;text-align: center">Tiết (ca)</th>
                                    <th style="width: 90px">Ngày học</th>
                                    <th>Giảng viên</th>
                                    <th>Phân công dạy</th>
                                    <th style="width: 70px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ds as $item)
                                    <tr>
                                        <td style="text-align: center">{{ $item->ten_phong }}</td>
                                        <td style="text-align: center">{{ $item->tiet_ca }}</td>
                                        <td>{{ $item->ngay_hoc }}</td>
                                        <td>{{ $item->ho.' '.$item->ten }}</td>
                                        <td>{{ $item->phan_cong_day }}</td>
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item, ['id_thoi_khoa_bieu','id_lop_hoc_phan' ,'id_thoi_gian_hoc','id_phong', 'id_giang_vien','id_hoc_ky','phan_cong_day', 'ngay_hoc'])}}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_thoi_khoa_bieu }}" class="itemXoa" href="#"><i
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
        <form method="post" action="{{action(['App\Http\Controllers\ThoiKhoaBieuController', 'importDanhba'])}}"
              enctype="multipart/form-data">
            <div class="modal fade" id="importModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Import dữ liệu khóa thi</h4>
                        </div>
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Chọn học kỳ</label>
                                    <select name="id_hoc_ky" id="id_hoc_ky" class="form-control">
                                        @foreach(\App\Models\HocKyModel::dsHocKy() as $item)
                                            <option value="{{$item->id_hoc_ky}}">{{$item->ten_hoc_ky . '-' . $item->ma_nam_hoc}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Chọn file (*.csv)
                                    </label>
                                    <input accept=".csv" name="file-excel" type="file" class="form-control">
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary luuTT">Tải lên</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            @if(isset($msg))
                toastr.success("{{$msg}}", "Đã xong");
            @endif
            $('.btnThem').on('click', function () {
                $('#importModal').modal('show');
            });
        });
    </script>
@endsection
