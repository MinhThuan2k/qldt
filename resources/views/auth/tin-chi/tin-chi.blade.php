@extends('auth.master')
@section('title') Quản lý thông tin tín chỉ @endsection
@section('content')

<div class="container-fluid no-padding">
    <section class="content-header">
        <h1 class="text-bold">
            {{ $ten_don_vi  }}\Quản lý thông tin tín chỉ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ action('App\Http\Controllers\DonViController@getDonVi') }}"><i
                        class="fa fa-dashboard"></i>Đơn vị</a></li>
            <li><a href="{{ action('App\Http\Controllers\DonViController@getDonViCT', $id_don_vi) }}">
                    {{ $ten_don_vi  }}
                </a></li>
            <li class="active">Quản lý thông tin tín chỉ</li>
            
        </ol>
    </section>
    <section class="content-header">
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-1">
                <button class="btn btn-success btnThem">Thêm mới</button>
            </div>
             <div class="col-md-3">
                    <select class="form-control id_lop_hoc" id="id_lop_hoc" onchange="location = this.value;">
                        {{-- <option value="">Tìm theo lớp học</option> --}}
                        {{-- @foreach($lophoc as $item)
                            <option value="{{$item->id_lop_hoc}}">{{$item->ma_lop_hoc." - ".$item->ten_lop_hoc}}</option>
                        @endforeach --}}
                        @foreach((new \App\Models\LopHocModel)->dsLopHoc($id_don_vi) as $item)
                        <option value="{{action('App\Http\Controllers\TinChiController@getTinChiTheoLop',['id_don_vi'=> $id_don_vi,'id_lop_hoc'=> $item->id_lop_hoc])}}" value="{{ $item->id_lop_hoc }}">{{ $item->ma_lop_hoc }} - {{ $item->ten_lop_hoc }}</option>
                    @endforeach
                    </select>
            </div>
        </div>
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped" >
                            <thead>
                            <tr>
                                <th >Mã tín chỉ</th>
                                <th>Cấp cho</th>
                                <th>Ngoại Ngữ</th>
                                <th>Quốc Phòng</th>
                                <th>Tin học</th>
                                <th>Kỹ năng nghề</th>
                                <th>Ngày cập nhật</th>
                                <th style="width: 70px;">Trạng thái</th> 
                                <th style="width: 70px;">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                    <tr>
                                        <td> {{$item->id_van_bang }}</td>
                                        <td> {{$item->ho." ".$item->ten }}</td>
                                        @if ($item->ngoai_ngu === 1)
                                            <td><center><input data_ngoaingu="{{$item->id_van_bang}}" class="form-check-input "id="{{$item->id_van_bang}}" type="checkbox" checked="" disabled></center></td>
                                        @else 
                                            <td><center><input data_ngoaingu="{{$item->id_van_bang}}" class="form-check-input"id="{{$item->id_van_bang}}"type="checkbox" disabled></center></td>
                                            @endif    
                                        @if ($item->quoc_phong === 1)
                                            <td><center><input data_quocphong="{{$item->quoc_phong}}" class="form-check-input " type="checkbox" checked="" disabled></center></td>
                                        @else 
                                        <td><center><input data_quocphong="{{$item->quoc_phong}}" class="form-check-input " type="checkbox"disabled ></center></td>
                                        @endif
                                        @if ($item->tin_hoc === 1)
                                            <td><center><input data_tinhoc="{{$item->tin_hoc}}" class="form-check-input " type="checkbox" checked="" disabled></center></td>
                                        @else 
                                            <td><center><input data_tinhoc="{{$item->tin_hoc}}" class="form-check-input " type="checkbox" disabled></center></td>
                                        @endif
                                        @if ($item->ky_nang_nghe === 1)
                                        <td><center><input data_tinhoc="{{$item->ky_nang_nghe}}" class="form-check-input " type="checkbox" checked="" disabled></center></td>
                                    @else 
                                        <td><center><input data_tinhoc="{{$item->ky_nang_nghe}}" class="form-check-input " type="checkbox" disabled></center></td>
                                    @endif
                                        <td> {{$item->ngay_cap}}</td>
                                        @if($item->trang_thai === 1)
                                            <td><span class="label label-success">Còn học</span></td>
                                        @else
                                            <td><span class="label label-warning">Nghĩ học</span></td>
                                        @endif
                                        <td class="text-center">
                                            <a data="{{ toAttrJson($item, ['id_van_bang','id_hoc_vien','ngoai_ngu','tin_hoc','quoc_phong','ky_nang_nghe','ngay_cap','trang_thai',])}}"
                                               class="itemCapNhat" href="#">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a data="{{ $item->id_van_bang }}" class="itemXoa" href="#"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                </tr>
                            @endforeach
                            </tbody></table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thêm thông tin tín chỉ</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Mã tín chỉ</label>
                            <input class="form-control id_van_bang" type="text" placeholder="Số tiền thực hành">
                        </div>
                        <div class="col-md-6">
                            <label for="">Cấp cho</label>
                            <select class="form-control id_hoc_vien" id="id_hoc_vien">
                                <option selected value="-1">Tìm theo lớp học</option>
                                @foreach($hocvien as $item)
                                    <option selected value="{{$item->id_hoc_vien}}">{{$item->ho." ".$item->ten}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Tên tín chỉ</label><br>
                            <input class="form-check-input ktngoai_ngu" type="checkbox" title="a" id="ngoai_ngu"> <label for="ngoai_ngu">Ngoại ngữ</label> &nbsp;
                            <input class="form-check-input kttin_hoc" type="checkbox" id="tin_hoc"> <label for="tin_hoc">Tin học</label> &nbsp;
                            <input class="form-check-input ktquoc_phong" type="checkbox" id="quoc_phong"> <label for="quoc_phong">Ngoại ngữ</label>
                            <input class="form-check-input ktky_nang_nghe" type="checkbox" id="ky_nang_nghe"> <label for="quoc_phong">Kỹ năng nghề</label>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="">Ngày cập nhật</label>
                            <input class="form-control ngay_cap" type="date" placeholder="Số tiền lý thuyết">
                        </div>
                        <div class="col-md-6">
                            <label for="">Ghi chú</label>
                            <input class="form-control ghi_chu" type="text" placeholder="Ghi chú">
                        </div>
                        <div class="col-md-6">
                            <label for="">Trạng thái (*)</label>
                            <select  class="form-control trang_thai">
                                <option selected value="2">Còn học</option>
                                <option selected value="1">Nghĩ học</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">

        var PUT_VAN_BANG = "{{ action('App\Http\Controllers\TinChiController@putVanBang',$id_don_vi) }}";
       
        var POST_VAN_BANG = "{{ action('App\Http\Controllers\TinChiController@postVanBang',$id_don_vi) }}" ;

        var DELETE_VAN_BANG = "{{ action('App\Http\Controllers\TinChiController@deleteVanBang',$id_don_vi) }}" ;

        $(document).ready(function () {
            $('.table').dataTable();

            $('.btnThem').click(function () {
                $('id_van_bang','.id_hoc_vien, .ngay_cap, .ktngoai_ngu, .kttin_hoc, .ktquoc_phong, .ktky_nang_nghe ,.ghi_chu').val('');
                $('#modal-default .modal-title').text('Thêm thông tin văn bằng');
                $('.btnLuu').attr('type', 'insert');
                $('#modal-default').modal('show');
               
            });                                            
            $(document).on('click', '.itemCapNhat', function () {
                var data = JSON.parse($(this).attr('data'));
                $('.id_van_bang').val(data.id_van_bang);
                $('.id_hoc_vien').val(data.id_hoc_vien);
                // if($(this).attr('data_ngoaingu').prop("checked") == true){
                //     $('.ktngoai_ngu').prop("checked",true);
                // } 
                // else
                //      $('.ktngoai_ngu').prop("checked",false);

                $('.kttin_hoc').val(data.tin_hoc);
                $('.ktquoc_phong').val(data.quoc_phong);
                $('.ngay_cap').val(data.ngay_cap);
                $('.ghi_chu').val(data.ghi_chu);
                $(".id_van_bang").prop('disabled', true);    
                $('#modal-default .modal-title').text('Cập nhật thông tin Lớp học phần');
                $('.btnLuu').attr('data', data.id_van_bang).attr('type', 'update');
                $('#modal-default').modal('show');
            });
            $('.close').click(function () {
                window.location="{{ action('App\Http\Controllers\TinChiController@getTinChi',$id_don_vi) }}";

            });
            $('#id_hoc_vien').select2(
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
                                        text: item.ho+' '+item.ten,
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
            $('.btnLuu').click(function () {
                var check_ngoai_ngu;
                var check_quoc_phong;
                var check_quoc_phong;
                var check_ky_nang_nghe;
                if ($('.id_hoc_vien').val()=="-1"){
                        toastr.error("Hãy chọn học phần", "Thao tác thất bại");
                        return;
                }

                if($('.ktngoai_ngu').prop("checked") == true){
                     check_ngoai_ngu = 1;
                } 
                else
                     check_ngoai_ngu = 2;

                if($('.ktquoc_phong').prop("checked") == true){
                     check_quoc_phong = 1;
                }
                else
                      check_quoc_phong = 2;

               if($('.kttin_hoc').prop("checked") == true){
                      check_tin_hoc = 1;
               }
                else
                     check_tin_hoc = 2;
                 if($('.ktky_nang_nghe').prop("checked") == true){
                    check_ky_nang_nghe = 1;
               }
                else
                    check_ky_nang_nghe = 2;
                switch ($(this).attr('type')) {
                    case 'insert':
                        $.ajax({
                            url: PUT_VAN_BANG,
                            type: "PUT",
                            data: {
                                'id_van_bang' : $('.id_van_bang').val(),
                                'id_hoc_vien' : $('.id_hoc_vien').val(),
                                'ngay_cap': $('.ngay_cap').val(),
                                'ghi_chu': $('.ghi_chu').val(),
                                'trang_thai': $('.trang_thai').val(),
                                'tin_hoc': check_tin_hoc,
                                'quoc_phong': check_quoc_phong ,
                                'ngoai_ngu': check_ngoai_ngu,
                                'ky_nang_nghe': check_ky_nang_nghe  
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                   
                                    toastr.success(result.message, "Thao tác thành công");
                                } else if (result.status === 333){
                                    toastr.warning(result.message, "Cảnh báo thao tác");
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
                        var id_van_bang = $(this).attr('data');
                        
                        $.ajax({
                            url: POST_VAN_BANG,
                            type: "POST",
                            data: {
                                'id_van_bang' : $('.id_van_bang').val(),
                                'id_hoc_vien' : $('.id_hoc_vien').val(),
                                'ngay_cap': $('.ngay_cap').val(),
                                'ghi_chu': $('.ghi_chu').val(),
                                'trang_thai': $('.trang_thai').val(),
                                'tin_hoc': check_tin_hoc,
                                'quoc_phong': check_quoc_phong ,
                                'ngoai_ngu': check_ngoai_ngu,
                                'ky_nang_nghe': check_ky_nang_nghe 
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                if (result.status === 200) {
                                    toastr.success(result.message, "Thao tác thành công");
                                    window.location.reload();
                                } else if (result.status === 333){
                                    toastr.warning(result.message, "Cảnh báo thao tác");
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
                        url: DELETE_VAN_BANG,
                        type: "DELETE",
                        data: {
                            'id_van_bang': id,
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