
@extends('auth.giao-dien-gv.main')
@section('title') GIẢNG VIÊN VLUTE @endsection
@section('content')

    <div class="content-wrapper" style="min-height: 251px;">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Nhập điểm
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@giaoDienGiangVien',session()->get('id'))}}"><i class="fa fa-home"></i> Trang chính</a></li>
                    <li><a href="#">Nhập điểm</a></li>
                    {{-- <li class="active"></li> --}}
                </ol>
            </section>
            
            <!-- Main content -->
            <section class="content">
                <div class="box box-default">
                    <div class="box-body">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="col-md-3">
                                    <select  class="form-control id_lop_hoc" id="id_lop_hoc" onchange="location = this.value;">
                                        <option  value="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDanhSachLop',
                                                            ['id_giang_vien'=> session()->get('id')])}}">Tất cả lớp học theo học kỳ</option>
                                        @foreach((new \App\Models\HocKyModel)->dsHocKy() as $item)
                                        <option @if($item->id_hoc_ky==$id_hoc_ky){{"selected= \"selected\""}}@endif value="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDanhSachLopTheoIDHocKy',
                                            ['id_giang_vien'=> session()->get('id'),'id_hoc_ky'=> $item->id_hoc_ky])}}" 
                                            value="{{$item->id_hoc_ky}}">{{ $item->ma_nam_hoc }} - {{ $item->ten_hoc_ky }}</option>
                                    @endforeach
                                    </select>
                            </div>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">STT</th>
                                        <th>Mã lớp học phần</th>
                                        <th>Học phần</th>
                                        <th style="width: 100px">Số TC(LT/TH)</th>
                                        <th style="width: 100px"></th>
                                        <th style="width: 100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gv as $item)  
                                    <tr>
                                        <td>{{$i=$i+1}}</td>
                                        <td>{{$item->ma_lop_hoc_phan}}</td>
                                        <td>{{$item->ten_hoc_phan}}</td>
                                        <td>{{$item->tin_chi_lt}}/{{$item->tin_chi_th}}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary" href="{{action('App\Http\Controllers\GiaoDienGiangVienController@nhapDiem',['id_lop_hoc_phan'=>$item->id_lop_hoc_phan])}}">Nhập điểm</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
{{--Kết thúc--}}
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>

    <style>
        .content-header{
            padding-left: 1px;
            padding-right: 0px;
        }
        .content{
            margin-left: -14px;
            padding-left: 1px;
            padding-right: 1px;
        }
        .picture {
            object-fit: cover;
        }
    </style>
@endsection

@section('script')
<script type="text/javascript">

    $.fn.modal.prototype.constructor.Constructor.DEFAULTS.backdrop = 'static';
    $.extend(true, $.fn.dataTable.defaults, {
        "sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
        "autoWidth": true,
        'stateSave': true
    });

    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });
</script>

