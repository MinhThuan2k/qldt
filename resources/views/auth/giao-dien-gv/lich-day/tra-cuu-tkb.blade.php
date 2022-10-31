<?php
use Carbon\Carbon;?>
@extends('auth.giao-dien-gv.main')
{{-- @section('style')
<link rel="stylesheet" href="https://ems.vlute.edu.vn/lib/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="https://ems.vlute.edu.vn/lib/fullcalendar/dist/fullcalendar.print.min.css" media="print">

<link rel="stylesheet" href="https://ems.vlute.edu.vn/lib/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://ems.vlute.edu.vn/lib/font-awesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://ems.vlute.edu.vn/lib/Ionicons/css/ionicons.min.css" />
<link rel="stylesheet" href="https://ems.vlute.edu.vn/lib/admin-lte/dist/css/AdminLTE.min.css" />
<link rel="stylesheet" href="https://ems.vlute.edu.vn/lib/admin-lte/dist/css/skins/_all-skins.min.css" />
<link rel="stylesheet" href="https://ems.vlute.edu.vn/lib/jquery-ui/themes/base/jquery-ui.min.css" />
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
<link rel="stylesheet" href="https://ems.vlute.edu.vn/css/site.min.css?v=tsUIeVdN_j9NnZf3FkNXWZdwVqYZybQ2Globh60qobQ" />
<script src="https://ems.vlute.edu.vn/lib/jquery/dist/jquery.min.js"></script>
<script src="https://ems.vlute.edu.vn/lib/jquery-ui/jquery-ui.min.js"></script>
    <style type="text/css">

    </style>
@endsection --}}
@section('title') Tra Cứu Thời Khóa Biểu @endsection
@section('content')


    <div class="container">
        <section class="content-header">
            <h1>
                Thời khóa biểu cá nhân
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@giaoDienGiangVien',session()->get('id'))}}"><i class="fa fa-home"></i> Trang chính</a></li>
                <li class="active">Thời khóa biểu....</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="form-group col-md-4">
                    <select class="form-control id_giang_vien" id="id_giang_vien">
                        {{-- @foreach((new \App\Models\HocVienModel())->getALLDSHocVien() as $item)
                          <option  value="{{ $item->id_hoc_vien }} " class="hidden">{{$id_hoc_vien=$item->id_hoc_vien}}</option
                        @endforeach --}}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <select class="form-control" id="hocky" name="hocky" onchange="location = this.value;">
                       @foreach((new \App\Models\GiaoĐienGiangVienModel())->getHocKy() as $item)
                          <option @if($item->id_hoc_ky==$id_hoc_ky){{"selected= \"selected\""}}@endif value="{{action('App\Http\Controllers\GiaoDienGiangVienController@lichdayTheoHK',
                          [session()->get('id'),$item->id_hoc_ky])}}" value="{{ $item->id_hoc_ky }}">{{$item->id_hoc_ky." - ".$item->ten_hoc_ky.", ".$item->ma_nam_hoc }}</option>--}}
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <button class="btn btn-success" id="btnViewData"><i class="fa fa-arrow-right"></i>Tra cứu</button>
                </div>
            </div>

            
{{--   TKb         --}}
            <div class="header">
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab_1" role="tab"><i class="fa fa-calendar-check-o"></i> Xem trong ngày</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_2" role="tab" ><i class="fa fa-list"></i> Xem dạng danh sách</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_3" role="tab"><i class="fa fa-table"></i> Xem dạng bảng</a>
                    </li> --}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab_2" role="tabpanel">
                        <div class="box-body no-padding">
                            <div class="hidden-sm hidden-xs">
                                <table class="table table-responsive table-striped table-bordered">
                                    <thead>
                                    <tr class="bg-blue-gradient">
                                        <th>Ngày</th>
                                        <th>
                                           Lớp học phần
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="vertical-align:middle; text-align:center">Thứ 2</td>
                                            <td class="warning">
                                                @foreach($lichday as $item)
                                                @if( $item->ngay_hoc_hoc ==2)
                                                    @if($check!=$item->id_lop_hoc_phan)
                                                    {{ $item->ma_lop_hoc_phan }}<br>
                                                        <strong> {{ $item->ma_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                                        GV: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                                        Phòng: <strong>{{$item->ten_phong}} </strong>  ({{$item->tiet_ca}},
                                                        <strong> {{$item->gio_bat_dau}} - {{$item->gio_ket_thuc}})</strong><br>
                                                        <label for=""class= "hidden"> {{$check=$item->id_lop_hoc_phan}}</label>
                                                        Tuần học:  
                                                        @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                        <span class="label label-warning">{{$demtuan}}</span>
                                                                    @else
                                                                        {{$demtuan}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                           
                                                        @endforeach     
                                                        <br>Ngày học:
                                                            @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                    <span class="label label-warning">{{$i->ngayhoc}} </span>&nbsp;
                                                                    @else
                                                                    {{$i->ngayhoc}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                        @endforeach 
                                                        <hr>  
                                                    @endif  
                                                @endif
                                     @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle; text-align:center">Thứ 3</td>
                                            <td class="warning">
                                                @foreach($lichday as $item)
                                                @if( $item->ngay_hoc_hoc ==3)
                                                    @if($check!=$item->id_lop_hoc_phan)
                                                    {{ $item->ma_lop_hoc_phan }}<br>
                                                        <strong> {{ $item->ma_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                                        GV: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                                        Phòng: <strong>{{$item->ten_phong}} </strong>  ({{$item->tiet_ca}},
                                                        <strong> {{$item->gio_bat_dau}} - {{$item->gio_ket_thuc}})</strong><br>
                                                        <label for=""class= "hidden"> {{$check=$item->id_lop_hoc_phan}}</label>
                                                        Tuần học:  
                                                        @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                        <span class="label label-warning">{{$demtuan}}</span>
                                                                    @else
                                                                        {{$demtuan}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                           
                                                        @endforeach     
                                                        <br>Ngày học:
                                                            @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                    <span class="label label-warning">{{$i->ngayhoc}} </span>&nbsp;
                                                                    @else
                                                                    {{$i->ngayhoc}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                        
                                                        @endforeach 

                                                        <hr> 
                                                    @endif  
                                                @endif
                                     @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle; text-align:center">Thứ 4</td>
                                            <td class="warning">
                                                @foreach($lichday as $item)
                                                @if( $item->ngay_hoc_hoc ==4)
                                                    @if($check!=$item->id_lop_hoc_phan)
                                                    {{ $item->ma_lop_hoc_phan }}<br>
                                                        <strong> {{ $item->ma_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                                        GV: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                                        Phòng: <strong>{{$item->ten_phong}} </strong>  ({{$item->tiet_ca}},
                                                        <strong> {{$item->gio_bat_dau}} - {{$item->gio_ket_thuc}})</strong><br>
                                                        <label for=""class= "hidden"> {{$check=$item->id_lop_hoc_phan}}</label>
                                                        Tuần học:  
                                                        @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                        <span class="label label-warning">{{$demtuan}}</span>
                                                                    @else
                                                                        {{$demtuan}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                           
                                                        @endforeach     
                                                        <br>Ngày học:
                                                            @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                    <span class="label label-warning">{{$i->ngayhoc}} </span>&nbsp;
                                                                    @else
                                                                    {{$i->ngayhoc}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                        
                                                        @endforeach 

                                                        <hr> 
                                                    @endif  
                                                @endif
                                     @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle; text-align:center">Thứ 5</td>
                                            <td class="warning">
                                                @foreach($lichday as $item)
                                                @if( $item->ngay_hoc_hoc ==5)
                                                    @if($check!=$item->id_lop_hoc_phan)
                                                    {{ $item->ma_lop_hoc_phan }}<br>
                                                        <strong> {{ $item->ma_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                                        GV: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                                        Phòng: <strong>{{$item->ten_phong}} </strong>  ({{$item->tiet_ca}},
                                                        <strong> {{$item->gio_bat_dau}} - {{$item->gio_ket_thuc}})</strong><br>
                                                        <label for=""class= "hidden"> {{$check=$item->id_lop_hoc_phan}}</label>
                                                        Tuần học:  
                                                        @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                        <span class="label label-warning">{{$demtuan}}</span>
                                                                    @else
                                                                        {{$demtuan}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                           
                                                        @endforeach     
                                                        <br>Ngày học:
                                                            @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                    <span class="label label-warning">{{$i->ngayhoc}} </span>&nbsp;
                                                                    @else
                                                                    {{$i->ngayhoc}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                        
                                                        @endforeach 

                                                        <hr>  
                                                    @endif  
                                                @endif
                                     @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle; text-align:center">Thứ 6</td>
                                            <td class="warning">
                                                @foreach($lichday as $item)
                                                @if( $item->ngay_hoc_hoc ==5)
                                                    @if($check!=$item->id_lop_hoc_phan)
                                                    {{ $item->ma_lop_hoc_phan }}<br>
                                                        <strong> {{ $item->ma_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                                        GV: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                                        Phòng: <strong>{{$item->ten_phong}} </strong>  ({{$item->tiet_ca}},
                                                        <strong> {{$item->gio_bat_dau}} - {{$item->gio_ket_thuc}})</strong><br>
                                                        <label for=""class= "hidden"> {{$check=$item->id_lop_hoc_phan}}</label>
                                                        Tuần học:  
                                                        @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                        <span class="label label-warning">{{$demtuan}}</span>
                                                                    @else
                                                                        {{$demtuan}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                           
                                                        @endforeach     
                                                        <br>Ngày học:
                                                            @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                    <span class="label label-warning">{{$i->ngayhoc}} </span>&nbsp;
                                                                    @else
                                                                    {{$i->ngayhoc}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                        
                                                        @endforeach 

                                                        <hr> 
                                                    @endif  
                                                @endif
                                     @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle; text-align:center">Thứ 7</td>
                                            <td class="warning">
                                                @foreach($lichday as $item)
                                                @if( $item->ngay_hoc_hoc ==7)
                                                    @if($check!=$item->id_lop_hoc_phan)
                                                    {{ $item->ma_lop_hoc_phan }}<br>
                                                        <strong> {{ $item->ma_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                                        GV: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                                        Phòng: <strong>{{$item->ten_phong}} </strong>  ({{$item->tiet_ca}},
                                                        <strong> {{$item->gio_bat_dau}} - {{$item->gio_ket_thuc}})</strong><br>
                                                        <label for=""class= "hidden"> {{$check=$item->id_lop_hoc_phan}}</label>
                                                        Tuần học:  
                                                        @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                        <span class="label label-warning">{{$demtuan}}</span>
                                                                    @else
                                                                        {{$demtuan}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                           
                                                        @endforeach     
                                                        <br>Ngày học:
                                                            @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                    <span class="label label-warning">{{$i->ngayhoc}} </span>&nbsp;
                                                                    @else
                                                                    {{$i->ngayhoc}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                        
                                                        @endforeach 

                                                        <hr>    
                                                    @endif  
                                                @endif
                                     @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="vertical-align:middle; text-align:center">Chủ nhật</td>
                                            <td class="warning" >
                                                @foreach($lichday as $item)
                                                @if( $item->ngay_hoc_hoc ==1)
                                                    @if($check!=$item->id_lop_hoc_phan)
                                                    {{ $item->ma_lop_hoc_phan }}<br>
                                                        <strong> {{ $item->ma_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                                        GV: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                                        Phòng: <strong>{{$item->ten_phong}} </strong>  ({{$item->tiet_ca}},
                                                        <strong> {{$item->gio_bat_dau}} - {{$item->gio_ket_thuc}})</strong><br>
                                                        <label for=""class= "hidden"> {{$check=$item->id_lop_hoc_phan}}</label>
                                                        Tuần học:  
                                                        @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                        <span class="label label-warning">{{$demtuan}}</span>
                                                                    @else
                                                                        {{$demtuan}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                           
                                                        @endforeach     
                                                        <br>Ngày học:
                                                            @foreach($demthoikhoabieu as $i)
                                                            @if($item->id_lop_hoc_phan==$i->id_lop_hoc_phan)
                                                            <label class="label label-warning hidden" >{{$demtuan=$i->tuaninnam}} </label>
                                                                @if($demtuan<=$i->tuan_ket_thuc)
                                                                    @if ($i->tuaninnam==date('W', strtotime(date('Y-m-d'))))
                                                                    <span class="label label-warning">{{$i->ngayhoc}} </span>&nbsp;
                                                                    @else
                                                                    {{$i->ngayhoc}}
                                                                    @endif  
                                                                @endif                                             
                                                            @endif
                                                        
                                                        @endforeach 

                                                        <hr> 
                                                    @endif  
                                                @endif
                                     @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab_1" role="tabpanel" >
                        <div class="col-md-6 no-padding">
                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <?php
                                    if(Carbon::now()->dayOfWeek == 1)
                                        $thu="thứ 2";
                                    elseif(Carbon::now()->dayOfWeek == 2)
                                            $thu="thứ 3";
                                        elseif(Carbon::now()->dayOfWeek == 3)
                                                $thu="thứ 4";
                                            elseif(Carbon::now()->dayOfWeek == 4)
                                                    $thu="thứ 5";
                                                elseif(Carbon::now()->dayOfWeek == 5)
                                                        $thu="thứ 6";
                                                    elseif(Carbon::now()->dayOfWeek == 6)
                                                            $thu="thứ 7";
                                                        else
                                                            $thu="chủ nhật";
                                    ?>
                                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp; Lịch học {{$thu}}, ngày {{$ldate = date('d-m-Y')}}</h3>
                                </div>
                                <div class="box-body">
                                    @foreach($lichday as $item)
                                            @if( $item->ngay_hoc==date('Y-m-d'))
                                                <h4 class="text-blue">{{$item->tiet_ca}}<strong> ({{$item->gio_bat_dau." - ".$item->gio_ket_thuc}}</strong>)</h4> 
                                                <span>Môn: <strong> {{ $item->ma_lop_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                            Giảng viên: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                            Phòng: <strong>{{$item->ten_phong}} </strong>
                                            </span>
                                        @endif
                                        {{-- <h3 class="box-title">{{$item->ngay_bat_dau."  ".date('d-m-Y') }}</h3> --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               

                </section>
                <div class="col-lg-8">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Lưu ý</div>
                        <div class="panel-body">
                            - Thời gian học lý thuyết:<ul><li>Tiết 1-2: <span class='text-blue'>07g00 - 07g40 - 08g20</span></li><li>Tiết 3: <span class='text-blue'>08g40 - 09g20</span></li><li>Tiết 4-5: <span class='text-blue'>09g30 - 10g10 - 10g50</span></li><li>Tiết 6-7: <span class='text-blue'>13g00 - 13g40 - 14g20</span></li><li>Tiết 8: <span class='text-blue'>14g40 - 15g20</span></li><li>Tiết 9-10: <span class='text-blue'>15g30 - 16g10 - 16g50</span></li><li>Tiết 11-12: <span class='text-blue'>18g30 - 19g10 - 19g50</span></li><li>Tiết 13: <span class='text-blue'>20g00 - 20g40</span></li></ul>- Thời gian học thực hành:<ul><li>Ca 1: <span class='text-orange'>06g30 - 09g00</span></li><li>Ca 2: <span class='text-orange'>09g20 - 11g30</span></li><li>Ca 3: <span class='text-orange'>12g30 - 15g00</span></li><li>Ca 4: <span class='text-orange'>15g20 - 17g30</span></li><li>Ca 5: <span class='text-orange'>18g30 - 20g40</span></li></ul>- Thời gian học GDTC:<ul><li>Buổi sáng: <span class='text-green'>07g00 - 08g20</span></li><li>Buổi chiều: <span class='text-green'>15g30 - 16g50</span></li><li>Buổi tối: <span class='text-green'>18g30 - 19g50</span></li></ul>- Thời gian học thực hành GDQP:<ul><li>Sáng: <span class='text-yellow'>07g00 - 08g30, 09g00 - 11g00</span></li><li>Chiều: <span class='text-yellow'>13g00 - 14g30, 15g00 - 17g00</span></li></ul>
                        </div>
                    </div>
                </div>
            </div>


@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function () {
            $('.id_giang_vien').select2(
                {
                    placeholder: 'Nhập tên giảng viên...',
                    ajax: {
                        url: '{{action('App\Http\Controllers\GiangVienController@timGiangVien')}}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results:  $.map(data, function (item) {
                                    return { 
                                        text:item.id_giang_vien+" - "+item.ho+' '+item.ten,
                                        id: item.id_giang_vien,
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
            $('#btnViewData').click(function () {
                        var id = $('.id_giang_vien').val();
                        $.ajax({
                            url: "{{URL::to('lich-day-gv')}}/"+id,
                            type: "GET",
                            data: {
                                'id_giang_vien' : $('.id_giang_vien').val(),
                            },
                            success: function (result) {
                               window.location="{{URL::to('lich-day-gv')}}/"+id;
                                
                            }
                        });
                    });        
});
 </script>
@endsection
