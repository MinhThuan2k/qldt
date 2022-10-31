@extends('auth.giao-dien-sv.main')
@section('title') Sinh Viên VLUTE @endsection
@section('content')

    <div class="container">
        <section class="content-header">
            <h1>
                Tra cứu tốt nghiệp
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Trang chính</a></li>
                <li class="active"> Tra cứu tốt nghiệp</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-solid" id="ViewDetail"><div class="box-body no-padding">
                <div class="hidden-sm hidden-xs">
                    <div class="col-md-12 no-padding">
                        <div class="box box-success" style="margin-bottom:0px">
                            <div class="box-header with-border no-margin">
                                <h3 class="box-title text-blue">Chứng chỉ</h3>
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
                                        <th style="text-align: center">Ngoại ngữ</th>
                                        <th style="text-align: center">Tin học</th>
                                        <th style="text-align: center">Quốc phòng</th>
                                        <th style="text-align: center">Kỹ năng nghề</th>
                                        {{-- <th>Sư phạm</th> --}}
                                        <th style="text-align: center">Điều kiện</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vanbang as $item)
                                            <tr>
                                                @if ($item->ngoai_ngu === 1)
                                                    <td><center><span class="label label-success">Đạt</span></center></td>
                                                @else
                                                    <td><center><span class="label label-warning">Không đạt</span></center></td>
                                                @endif

                                                @if ($item->quoc_phong === 1)
                                                    <td><center><span class="label label-success">Đạt</span></center></td>
                                                @else
                                                    <td><center><span class="label label-warning">Không đạt</span></center></td>
                                                @endif

                                                @if ($item->tin_hoc === 1)
                                                    <td><center><span class="label label-success">Đạt</span></center></td>
                                                @else
                                                    <td><center><span class="label label-warning">Không đạt</span></center></td>
                                                @endif

                                                @if($item->ky_nang_nghe === 1)
                                                    <td><center><span class="label label-success">Đạt</span></center></td>
                                                @else
                                                    <td><center><span class="label label-warning">Không đạt</span></center></td>
                                                @endif

                                                {{-- @if($item->su_pham === 1)
                                                    <td><center><input class="form-check-input " type="checkbox" checked="" disabled></center></td>
                                                @else
                                                    <td><center><input class="form-check-input " type="checkbox" disabled></center></td>
                                                @endif --}}

                                                @if($item->ngoai_ngu === 1 && $item->ky_nang_nghe === 1 && $item->quoc_phong === 1 && $item->tin_hoc === 1)
                                                     <td><center><span class="label label-success">Đủ điều kiện</span></center></td>
                                                @else
                                                    <td><center><span class="label label-warning">Không đủ</span></center> </td>
                                                @endif
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer"></div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        @for($i=1;$i<=8;$i++)
        <div class="box box-solid" id="ViewDetail"><div class="box-body no-padding">
            <div class="hidden-sm hidden-xs">
                <div class="col-md-12 no-padding">
                    <div class="box box-success" style="margin-bottom:0px">
                        <div class="box-header with-border no-margin">
                            <h3 class="box-title text-blue">Học phần học kỳ {{$i}}</h3>
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

                                    <th>Mã HP</th>
                                    <th style="width: 210px">Tên học phần</th>
                                    <th>Số TC(LT/TH)</th>
                                    <th>Điểm chữ</th>
                                    <th>Hệ 4</th>
                                    <th>Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($dsHocPhanTheoCTDT as $item)
                                    @if ($item->hoc_ky==$i)
                                    <tr>

                                        <td style="width: 120px">{{$item->ma_hoc_phan}}</td>
                                        <td>{{$item->ten_hoc_phan}}</td>
                                        <td style="width: 100px"><center>{{$item->tin_chi_lt.":".$item->tin_chi_th}}</center></td>
                                        <td style="width: 100px">
                                            @foreach($getDiemHPTheoHocVien as $item1)
                                                @if ($item->id_hoc_phan==$item1->id_hoc_phan)
                                                    @if($item1->diem10>=8.5)
                                                             {{"A"}}
                                                        @else
                                                            @if($item1->diem10 >=7.8 && $item1->diem10<=8.4 )
                                                                {{"B+"}}
                                                            @else
                                                                @if($item1->diem10>=7 && $item1->diem10<=7.7 )
                                                                    {{"B"}}
                                                                    @else
                                                                        @if($item1->diem10>=6.3 && $item1->diem10<=6.9 )
                                                                           {{"C+"}}
                                                                        @else
                                                                            @if($item1->diem10>=5.5 && $item1->diem10<=6.2 )
                                                                                {{"C"}}
                                                                            @else
                                                                                @if($item1->diem10>=4.8 && $item1->diem10<=5.4 )
                                                                                    {{"D+"}}
                                                                                @else
                                                                                    @if($item1->diem10>=4 && $item1->diem10<=4.7 )
                                                                                        {{"D"}}
                                                                                    @else
                                                                                        {{"F"}}
                                                                                        @endif
                                                                                        @endif
                                                                                        @endif
                                                                                        @endif
                                                                                        @endif
                                                                                        @endif
                                                                                        @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td style="width: 100px">
                                            @foreach($getDiemHPTheoHocVien as $item1)
                                                @if ($item->id_hoc_phan==$item1->id_hoc_phan)
                                                    @if($item1->diem10>=8.5)
                                                             {{"4.0"}}
                                                        @else
                                                            @if($item1->diem10 >=7.8 && $item1->diem10<=8.4 )
                                                                {{"3.5"}}
                                                            @else
                                                                @if($item1->diem10>=7 && $item1->diem10<=7.7 )
                                                                    {{"3.0"}}
                                                                    @else
                                                                        @if($item1->diem10>=6.3 && $item1->diem10<=6.9 )
                                                                           {{"2.5"}}
                                                                        @else
                                                                            @if($item1->diem10>=5.5 && $item1->diem10<=6.2 )
                                                                                {{"2.0"}}
                                                                            @else
                                                                                @if($item1->diem10>=4.8 && $item1->diem10<=5.4 )
                                                                                    {{"1.5"}}
                                                                                @else
                                                                                    @if($item1->diem10>=4 && $item1->diem10<=4.7 )
                                                                                        {{"1.0"}}
                                                                                    @else
                                                                                        @if($item1->diem10 <4 )
                                                                                            {{"0.0"}}
                                                                                                @endif
                                                                                                @endif
                                                                                                @endif
                                                                                                @endif
                                                                                                @endif
                                                                                                @endif
                                                                                                @endif
                                                                                                @endif
                                                @endif
                                            @endforeach
                                        </td>
                                        <td style="width: 100px">

                                            @foreach($getDiemHPTheoHocVien as $item1)
                                            @if ($item->id_hoc_phan==$item1->id_hoc_phan)
                                                @if($item1->diem10>=4.0)
                                                    <span class="label label-success">Đã hoàn thành</span>
                                                @else
                                                        @if($item1->diem10 < 4 )
                                                            <span class="label label-warning">Chưa hoàn thành</span>
                                                        @endif
                                                            @endif

                                            @endif
                                        @endforeach
                                        </td>
                                    </tr>
                                    @endif
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer"></div>

                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Điểm tích lũy hiện tại</label>
                <span class="label label-success">
                  {{$diemtb}}
                </span>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Điểm tích lũy cần học</label>
                <span class="label label-success">{{$diemTichLuyCanHoc}}</span>
            </div>
            @foreach($vanbang as $item)
                @if($diemTichLuyCanHoc>=2.0 && $item->ngoai_ngu === 1 && $item->ky_nang_nghe === 1 && $item->quoc_phong === 1 && $item->tin_hoc === 1)
                        @if ($dem ==0)
                            <div class="col-md-6">
                                <br><label for="inputEmail3" class="col-2 col-form-label">Kết quả</label>
                                <span class="label label-success" style="font-size: 15px"> Bạn đủ điều kiện xét tốt nghiệp.</span><br><br>
                                <a href="{{ action('App\Http\Controllers\XetTotNghiepController@exportfile',session()->get('id')) }}"target="_blank">
                                    <button class="btn btn-success" id="btnViewData"><i class="fa fa-arrow-right"></i> Xuất file</button>
                                </a>
                                <a href="{{ action('App\Http\Controllers\XetTotNghiepController@exportdiemtotnghiep',session()->get('id')) }}"target="_blank">
                                    <button class="btn btn-success" id="btnViewData"><i class="fa fa-arrow-right"></i> Xuất điểm</button>
                                </a>
                            </div>
                        @else
                            <div class="col-md-6">
                                <label for="inputEmail3" class="col-2 col-form-label">Kết quả: </label>
                                <span class="label label-warning" style="font-size: 15px">Bạn chưa đủ điều kiện xét tốt nghiệp. </span>
                            </div>
                        @endif
                @else
                        <div class="col-md-6">
                            <label for="inputEmail3" class="col-2 col-form-label">Kết quả: </label>
                            <span class="label label-warning" style="font-size: 15px">Bạn chưa đủ điều kiện xét tốt nghiệp.</span>
                        </div>
                @endif
            @endforeach

        </section>
    </div>

@endsection

@section('script')
<script type="text/javascript">
        $(document).ready(function () {

        });
    </script>

@endsection
