@extends('auth.giao-dien-sv.main')
@section('title') Sinh Viên VLUTE @endsection
@section('content')

    <div class="container">
        <section class="content-header">
            <h1>
                Bảng điểm cá nhân
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Trang chính</a></li>
                <li class="active">Bảng điểm cá nhân</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">

                <div class="form-group col-md-4">
                    <select class="form-control" id="hocky" name="hocky" onchange="location = this.value;">
                        <option >Tìm theo học kỳ</option>
                        <option value="{{action('App\Http\Controllers\BangDiemSinhVienController@getAllbangDiem', 
                                    ['id_hoc_vien'=>session()->get('id')])}}" value="">(Tất cả học kỳ)</option>
                        @foreach((new \App\Models\HocKyModel())->dsHocKy() as $item)
                            <option value="{{action('App\Http\Controllers\BangDiemSinhVienController@bangDiemTheoHk',
                             ['id_hoc_vien'=>session()->get('id'), 'id_hoc_ky'=>$item->id_hoc_ky])}}" value="{{ $item->id_hoc_ky }}">{{ $item->ten_hoc_ky }}, {{ $item->ma_nam_hoc }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-md-2">
                    <button class="btn btn-success" id="btnViewData"><i class="fa fa-arrow-right"></i> Xem điểm</button>
                </div>
            </div>
            <div class="box box-solid" id="ViewDetail"><div class="box-body no-padding">
                    <div class="hidden-sm hidden-xs">
                        <div class="col-md-12 no-padding">
                            <div class="box box-success" style="margin-bottom:0px">
                                @foreach($hocky as $itemhk)
                                <div class="box-header with-border no-margin">
                                    <h3 class="box-title text-blue">{{ $itemhk->ten_hoc_ky }}, {{ $itemhk->ma_nam_hoc }}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool btnID" data-widget="collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã HP</th>
                                            <th style="width: 200px">Tên học phần</th>
                                            <th>Số TC(LT/TH)</th>
                                            <th>Quá trình</th>
                                            <th>Giữa kỳ</th>
                                            <th>Điểm Thi</th>
                                            <th>Điểm HP</th>
                                            <th>Điểm chữ</th>
                                            <th>Hệ 4</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bangdiem as $key => $item )
                                            @if($item->id_hoc_ky == $itemhk->id_hoc_ky)
                                            <tr>
                                                <td>{{$i=$i+1}}</td>
                                                <td>{{ $item->ma_hoc_phan }}</td>
                                                <td>{{ $item->ten_hoc_phan }}</td>
                                                <td> {{ $item->tin_chi_lt + $item->tin_chi_th}} ({{ $item->tin_chi_lt }} : {{ $item->tin_chi_th }})</td>
                                                <td>{{ $item->diem_10 }}</td>
                                                <td>{{ $item->diem_40 }}</td>
                                                <td>{{ $item->diem_50 }}</td>
                                                <td>{{ round ($item -> diem_hp = ($item->diem_10 + $item->diem_40 * 4 + $item->diem_50 * 5) / 10,1) }}</td>
                                                <td>
                                                    @if($item -> diem_hp >= 8.5 && $item -> diem_hp <= 10 )
                                                        {{ $item->dienchu ='A' }}
                                                    @elseif($item -> diem_hp >= 8 && $item -> diem_hp < 8.5 )
                                                        {{ $item->dienchu ='B+' }}
                                                    @elseif($item -> diem_hp >= 7 && $item -> diem_hp < 8 )
                                                        {{ $item->dienchu ='B' }}
                                                    @elseif($item -> diem_hp >= 6.5 && $item -> diem_hp < 7 )
                                                        {{ $item->dienchu ='C+' }}
                                                    @elseif($item -> diem_hp >= 5.5 && $item -> diem_hp < 6.5 )
                                                        {{ $item->dienchu ='C' }}
                                                    @elseif($item -> diem_hp >= 5 && $item -> diem_hp < 5.5 )
                                                        {{ $item->dienchu ='D+' }}
                                                    @elseif($item -> diem_hp >= 4 && $item -> diem_hp < 5 )
                                                        {{ $item->dienchu ='D' }}
                                                    @elseif($item -> diem_hp < 4 )
                                                        {{ $item->dienchu ='F' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item -> diem_hp >= 8.5 && $item -> diem_hp <= 10 )
                                                        {{ $item->diem4 ='4.0' }}
                                                    @elseif($item -> diem_hp >= 8 && $item -> diem_hp < 8.5 )
                                                        {{ $item->diem4 ='3.5' }}
                                                    @elseif($item -> diem_hp >= 7 && $item -> diem_hp < 8 )
                                                        {{ $item->diem4 ='3' }}
                                                    @elseif($item -> diem_hp >= 6.5 && $item -> diem_hp < 7 )
                                                        {{ $item->diem4 ='2.5' }}
                                                    @elseif($item -> diem_hp >= 5.5 && $item -> diem_hp < 6.5 )
                                                        {{ $item->diem4 ='2' }}
                                                    @elseif($item -> diem_hp >= 5 && $item -> diem_hp < 5.5 )
                                                        {{ $item->diem4 ='1.5' }}
                                                    @elseif($item -> diem_hp >= 4 && $item -> diem_hp < 5 )
                                                        {{ $item->diem4 ='1' }}
                                                    @elseif($item -> diem_hp < 4 )
                                                        {{ $item->diem4 ='0' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="label label-danger"></span>
                                                </td>
                                                <td></td>
                                            </tr>

                                            @endif

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div></div>
            <div class="form-group col-md-2">
                <a href="{{action('App\Http\Controllers\BangDiemController@hoc_vien', ['id_hoc_vien'=>session()->get('id'), 'id_hoc_ky'=>$item->id_hoc_ky])}}">
                    <button class="btn btn-success" id="btnViewData"><i class="fa fa-arrow-right"></i> Xuất bảng điểm</button>
                </a>
            </div>
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
