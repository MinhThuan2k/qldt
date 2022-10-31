@extends('auth.giao-dien-sv.main')
@section('style')
    <style type="text/css">
    </style>
@endsection
<?php
use Carbon\Carbon;?>
@section('title') Tra Cứu Thời Khóa Biểu @endsection
@section('content')

    <div class="container">
        <section class="content-header">
            <h1>
                Thời khóa biểu sinh viên
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Trang chính</a></li>
                <li class="active">Thời khóa biểu....</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="form-group col-md-4">
                    <select class="form-control id_hoc_vien" id="id_hoc_vien">
                        {{-- @foreach((new \App\Models\HocVienModel())->getALLDSHocVien() as $item)
                          <option  value="{{ $item->id_hoc_vien }} " class="hidden">{{$id_hoc_vien=$item->id_hoc_vien}}</option
                        @endforeach --}}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <select class="form-control" id="hocky" name="hocky" >
                        @foreach((new \App\Models\GiaoĐienGiangVienModel())->getHocKy() as $item)
                          <option @if($item->id_hoc_ky==$id_hoc_ky){{"selected= \"selected\""}}@endif  value="{{ $item->id_hoc_ky }}">{{$item->id_hoc_ky." - ".$item->ten_hoc_ky.", ".$item->ma_nam_hoc }}</option>--}}
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
                            @foreach($data as $key => $item )
                                <tr>
                                    <td style="vertical-align:middle; text-align:center">
                                        <class=''>Thứ 2</class=''>
                                    </td>
                                    <td class="warning">
                                        {{ $item->ma_lop_hoc_phan }}<br>
                                        <strong> {{ $item->ma_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                        GV: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                        Phòng: <strong>{{$item->ten_phong}} </strong>  ({{$item->tiet_ca}}, <strong> {{$item->gio_bat_dau}} - {{$item->gio_ket_thuc}})</strong>)<br>
                                        Tuần học:        ------
                                        @while ($item->tuan_bat_dau <= $item->tuan_ket_thuc )

                                            @if ($item->tuan_bat_dau==date('W', strtotime(date('Y-m-d'))))
                                            -<span class="label label-warning">{{$item->tuan_bat_dau ++}}</span>
                                            @else
                                                - {{$item->tuan_bat_dau ++}}
                                            @endif
                                        @endwhile <br>
                                        Ngày học:
                                        @foreach($ngayhoc as $key => $item1 )
                                            @if($item1->id_phong == $item->id_phong)
                                            {{-- <label class="label label-warning hidden" >{{$c=$item1->ngay_hoc}} </label> --}}
                                                @if ($item1->ngay_hoc==date('Y-m-d'))
                                                <span class="label label-warning">{{$item1->ngay_hoc}} </span>&nbsp;
                                                @else
                                                {{$item1->ngay_hoc}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
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
                                    @foreach($ngayhocTheoBang as $key => $item )

                                                <h4 class="text-blue">{{$item->tiet_ca}}<strong> ({{$item->gio_bat_dau." - ".$item->gio_ket_thuc}}</strong>)</h4>
                                                <span>Môn: <strong> {{ $item->ma_lop_hoc_phan }} - {{ $item->ten_hoc_phan }}</strong><br>
                                            Giảng viên: <strong>{{$item->ho}} {{$item->ten}}</strong><br>
                                            Phòng: <strong>{{$item->ten_phong}} </strong>
                                            </span>

                                        {{-- <h3 class="box-title">{{$item->ngay_bat_dau."  ".date('d-m-Y') }}</h3> --}}
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </div>



{{--   KẾt thúc         --}}
        </section>
    </div>

@endsection

@section('script')
 <script type="text/javascript">
  $(document).ready(function () {
        $('.id_hoc_vien').select2(
                        {
                            placeholder: 'Chọn học viên...',
                            ajax: {
                                url: '{{action('App\Http\Controllers\HocVienController@timHocVien')}}',
                                dataType: 'json',
                                delay: 250,
                                processResults: function (data) {
                                    return {
                                        results:  $.map(data, function (item) {
                                            return {
                                                text:item.id_hoc_vien+" - "+item.ho+' '+item.ten,
                                                id: item.id_hoc_vien,
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


                    $('#id_hoc_vien').val('15');

                    $('#hocky').on('change', function() {
                        var id_hoc_vien={{$id_hoc_vien}};
                        var id = $('.id_hoc_vien').val();
                        if(id==null)
                            id=id_hoc_vien;
                        var id_hoc_ky = this.value;
                        $.ajax({
                            url: "{{URL::to('tkb1')}}/"+id+"/"+id_hoc_ky,
                            type: "GET",
                            data: {
                                'id_hoc_vien' : $('.id_hoc_vien').val(),
                                'id_hoc_ky' : this.value,
                            },
                            success: function (result) {
                               window.location= "{{URL::to('tkb1')}}/"+id+"/"+id_hoc_ky;
                            }
                        });
                    });
                    $('#btnViewData').click(function () {
                        var id = $('.id_hoc_vien').val();
                        $.ajax({
                            url: "{{URL::to('tkb1')}}/"+id,
                            type: "GET",
                            data: {
                                'id_hoc_vien' : $('.id_hoc_vien').val(),
                            },
                            success: function (result) {
                               window.location="{{URL::to('tkb1')}}/"+id;

                            }
                        });
                    });
  });
 </script>
@endsection
