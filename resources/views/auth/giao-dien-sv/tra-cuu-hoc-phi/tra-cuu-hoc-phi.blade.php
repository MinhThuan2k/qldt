@extends('auth.giao-dien-sv.main')
@section('title') Tra Cứu Học Phí @endsection
@section('content')

    <div class="container">
        <section class="content-header">
            <h1>
                Học phí cá nhân
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Trang chính</a></li>
                <li class="active">Học phí cá nhân</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <div class="form-group col-md-4">

                    <select class="form-control" id="hocky" name="hocky" onchange="location = this.value;">
                        <option value="0">(Tất cả học kỳ)</option>
                        @foreach((new \App\Models\HocKyModel())->dsHocKy() as $item)
                            <option value="{{action('App\Http\Controllers\TraCuuHocPhiController@hocPhi', ['id_hoc_vien'=>session()->get('id'), 'id_hoc_ky'=>$item->id_hoc_ky])}}" value="{{ $item->id_hoc_ky }}">{{ $item->ten_hoc_ky }}, {{ $item->ma_nam_hoc }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-md-2">
                    <button class="btn btn-success" id="btnViewData"><i class="fa fa-arrow-right"></i> Xem điểm</button>
                </div>

            </div>

            <div class="box box-solid" id="HPDetail"><div class="box-header with-border no-margin">
                    @foreach($chitiet as $key => $item )
                    <h1 class="box-title text-blue">{{$item->id_hoc_vien}} - {{''.$item->ho. ' ' .$item->ten.''}} - Lớp
                        {{$item->ma_lop_hoc}} - Học phí {{$item->ten_hoc_ky}}, {{$item->ma_nam_hoc}}</h1>
                    @endforeach
                </div>
                <div class="box-body no-padding">
                    <div class="hidden-sm hidden-xs">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr class="info">
                                <td colspan="8">DANH SÁCH CÁC HỌC PHẦN SINH VIÊN ĐÃ CÓ THỜI KHÓA BIỂU</td>
                            </tr>
                            <tr>
                                <th>TT</th>
                                <th>Mã HP</th>
                                <th>Tên học phần</th>
                                <th>Mã lớp học phần</th>
                                <th>Số tín chỉ</th>
                                <th>Đơn giá (LT:TH)</th>
                                <th>Thành tiền (VND)</th>
                                <th>Ghi chú</th>
                            </tr></thead><tbody>
                            @foreach($hocphi as $key => $item )
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{ $item->ma_hoc_phan }}</td>
                                <td>{{ $item->ten_hoc_phan }}</td>
                                <td class="text-info">{{ $item->ma_lop_hoc_phan }}</td>
                                <td> {{ $item->tin_chi_lt + $item->tin_chi_th}} ({{ $item->tin_chi_lt }} : {{ $item->tin_chi_th }})</td>
                                <td>{{ $item->ly_thuyet }} : {{ $item->thuc_hanh }}</td>
                                <td>{{ $item->ly_thuyet * $item->tin_chi_lt + $item->thuc_hanh*$item->tin_chi_th}} (Đồng)</td>
                                <td>
                                    <span class="label label-success"></span>
                                    <span class="label label-info"></span>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="center">Tổng học phí của học kỳ</td>
                                @foreach($tinchi as $item)
                                <td>
                                    <strong>{{$item->tong}}</strong> (tín chỉ)
                                </td>

                                <td></td>
                                <td>
                                    <strong>{{$item->tongtien}}</strong> (đồng)
                                </td>
                                @endforeach
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center">Tổng số tiền đã nộp</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <strong>0</strong> (đồng)</td>
                                <td></td>
                            </tr>
                            <tr class="warning text-bold">
                                <td colspan="4" align="center">SỐ TIỀN THỪA</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <strong>0</strong> (đồng)</td>
                                <td></td>
                            </tr>
                            <tr style="text-align:right">
                                <td colspan="7">(Bằng chữ:)</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div></div>
        </section>
    </div>

@endsection

@section('script')
    <script>
        // Thu gọn table điểm


        function roundToTwo(num) {
            return +(Math.round(num + "e+2")  + "e-2");
        }
        $(document).ready(function () {
        });

    </script>

@endsection
