
@extends('auth.giao-dien-gv.main')
@section('title') GIẢNG VIÊN VLUTE @endsection
@section('content')

    <div class="content-wrapper" style="min-height: 251px;">
        <div class="container">
            <!-- Content Header (Page header) -->
                        <section class="content-header">
                            <h1>
                                Danh sách sinh viên/Học phần: {{$ct->ten_hoc_phan}}
                            </h1>
                            <ol class="breadcrumb">
                                <li><a href="{{ action('App\Http\Controllers\GiaoDienGiangVienController@getDanhSachLop',$ct->id_giang_vien)}}"><i
                                            class="fa fa-dashboard"></i>Lớp học phần</a></li>
                                <li class="active">Nhập điểm</li>
                            </ol>
            
                        </section>
            <!-- Main content -->
                    <section class="content">
                        <td class="text-center">    
                            <a class="btn btn-primary" href="{{action('App\Http\Controllers\GiaoDienGiangVienController@exportBangDiem',$ct->id_lop_hoc_phan)}}" >Xuất file</a>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-success btnImport">Nhập Excel</button>  </td>
                       
                        <div class="box box-default">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">STT</th>
                                                    <th>Họ tên</th>
                                                    <th>Điểm 10%</th>
                                                    <th>Điểm 40%</th>
                                                    <th>Điểm 50%</th>
                                                    <th>Điểm học phần</th>
                                                    <th>Điểm chữ</th>
                                                    <th>Điểm hệ 4</th>
                                                    <th style="width: 100px"></th>
                                                    <th style="width: 100px"></th>
                                                </tr>
                                            </thead>
            
                                            <tbody>
                                                @foreach($gv as $item)
                                                <tr>
                                                    <td>{{$i=$i+1}}</td>
                                                    <td>{{$item->ho}} {{$item->ten}}</td>
                                                    <td>{{$item->diem_10}}</td>
                                                    <td>{{$item->diem_40}}</td>
                                                    <td>{{$item->diem_50}}</td>
                                                    <td>{{round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)}}</td>
                                                    {{-- {{round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)}} --}}
                                                    @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=8.5)
                                                    <td>{{"A"}}</td>
                                                    @else
                                                        @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1) >=7.8 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=8.4 )
                                                        <td>{{"B+"}}</td> 
                                                        @else
                                                            @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=7 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=7.7 )
                                                            <td>{{"B"}}</td> 
                                                                @else
                                                                    @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=6.3 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=6.9 )
                                                                    <td>{{"C+"}}</td> 
                                                                    @else
                                                                        @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=5.5 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=6.2 )
                                                                        <td>{{"C"}}</td> 
                                                                        @else
                                                                            @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=4.8 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=5.4 )
                                                                            <td>{{"D+"}}</td> 
                                                                            @else
                                                                                @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=4 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=4.7 )
                                                                                <td>{{"D"}}</td>  
                                                                                @else
                                                                                <td>{{"F"}}</td> 
                                                                                    @endif
                                                                                    @endif
                                                                                    @endif
                                                                                    @endif
                                                                                    @endif
                                                                                    @endif
                                                                                    @endif
                                                                                    @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=8.5)
                                                                                    <td>{{"4.0"}}</td>
                                                                                    @else
                                                                                        @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1) >=7.8 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=8.4 )
                                                                                        <td>{{"3.5"}}</td> 
                                                                                        @else
                                                                                            @if(round($item->diem_10+($item->diem_40*4)+($item->diem_50*5)/10,1)>=7 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=7.7 )
                                                                                            <td>{{"3.0"}}</td> 
                                                                                                @else
                                                                                                    @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=6.3 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=6.9 )
                                                                                                    <td>{{"2.5"}}</td> 
                                                                                                    @else
                                                                                                        @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=5.5 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=6.2 )
                                                                                                        <td>{{"2.0"}}</td> 
                                                                                                        @else
                                                                                                            @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=4.8 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=5.4 )
                                                                                                            <td>{{"1.5"}}</td> 
                                                                                                            @else
                                                                                                                @if(round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)>=4 && round(($item->diem_10+($item->diem_40*4)+($item->diem_50*5))/10,1)<=4.7 )
                                                                                                                <td>{{"1.0"}}</td>  
                                                                                                                @else
                                                                                                                <td>{{"0"}}</td> 
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                    @endif
                                                                                                                    @endif
                                                    <td class="text-center">
                                                        <a data="{{ toAttrJson($item, ['id_hoc_vien','diem_10','diem_40', 'diem_50'])}}" type="button" class=" btnThem"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
                            <!-- /.box-body -->
                        </div>
                        {{-- <span aria-hidden="true">{{$id}}</span>
                        <span aria-hidden="true">{{$id_lop}};</span>
                        <span aria-hidden="true">{{$diem10}};</span>
                        <span aria-hidden="true">{{$diem40}}</span>
                        <span aria-hidden="true">{{$diem50}}</span> --}}

                    </section>
            <!-- /.content -->


        </div>
      
    </div>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Nhập điểm sinh viên</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Điểm 10%</label>
                                    <input class="form-control diem_10" type="text" placeholder="Điểm 10%">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Điểm 40%</label>
                                    <input class="form-control diem_40" type="text" placeholder="Điểm 40%">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Điểm 50%</label>
                                    <input class="form-control diem_50" type="text" placeholder="Điểm 50%">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btnLuu">Lưu thông tin</button>
                        </div>
                    </div>
                </div>
            </div>
             <form method="post" action="{{action('App\Http\Controllers\GiaoDienGiangVienController@importDiem', $ct->id_lop_hoc_phan)}}"
            enctype="multipart/form-data">
          <div class="modal fade" id="importGiangVien">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Import dữ liệu điểm học phần</h4>
                      </div>
                      {{ csrf_field() }}
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <label for="">Chọn file (*.xlsx) hoặc Tải về
                                      <a target="_blank" href="{{asset('excel-mau/BangDiem.xlsx')}}">
                                          file mẫu
                                      </a>
                                  </label>
                                  <input accept=".xlsx" name="file-excel" type="file" class="form-control">
                                  <br>
                                  <p class="text-danger">Khi "Import điểm học phần", dữ liệu cũ sẽ được xóa khỏi hệ thống</p>
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
{{--Kết thúc--}}
            <!-- /.content -->


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
    var POST_DIEM_HOC_VIEN = "{{ action('App\Http\Controllers\GiaoDienGiangVienController@updateDiemHocVien') }}";
    $(document).ready(function () {
        $(document).on('click', '.btnThem', function () {
        var data = JSON.parse($(this).attr('data'));
        $('.diem_10').val(data.diem_10);
        $('.diem_40').val(data.diem_40);
        $('.diem_50').val(data.diem_50);
        $('#modal-default .modal-title').text('Nhập điểm sinh viên');
        $('.btnLuu').attr('data', data.id_hoc_vien).attr('type', 'update');
        $('#modal-default').modal('show');
    });
    $('.btnImport').click(function (){
                $('#importGiangVien').modal('show');
            })
        $('.btnLuu').click(function () {
            switch ($(this).attr('type')) {
                case 'update':
                    var id_hoc_vien = $(this).attr('data');
                    $.ajax({
                        url: POST_DIEM_HOC_VIEN,
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id_hoc_vien': id_hoc_vien,
                            'id_lop_hoc_phan': {{$id_lop_hoc_phan}},
                            'diem_10': $('.diem_10').val(),
                            'diem_40': $('.diem_40').val(),
                            'diem_50': $('.diem_50').val(),
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
            }
        });
    });
</script>

@endsection

