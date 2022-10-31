@extends('auth.giao-dien-gv.main')
@section('title') GIẢNG VIÊN VLUTE @endsection
@section('content')

    <div class="content-wrapper" style="min-height: 251px;">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Giảng Viên
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@giaoDienGiangVien',session()->get('id')) }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                    <li><a href="#">Giảng Viên</a></li>
                    {{-- <li class="active"></li> --}}
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

{{-- Giảng viên tra cứu--}}
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><a href="homeSSO.action">Tra Cứu</a></h3>
                                </div>
                                <div class="box-body">
                                    <ul class="products-list product-list-in-box">
                                        <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/tracuu.png')}}" alt="">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@lichday',$id_giang_vien) }}" class="product-title">1. Tra cứu lịch dạy </a>
                                                <span class="product-description">Thực hiện tra cứu lịch dạy cá nhân tại đây </span>
                                            </div>
                                        </li>

                            
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./row-->
                </div>

                {{-- Nhập điểm theo học phân --}}
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><a href="homeSSO.action">Nhập điểm</a></h3>
                                </div>
                                <div class="box-body">
                                    <ul class="products-list product-list-in-box">
                                        <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/tracuu.png')}}" alt="">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@getDanhSachLop',$id_giang_vien)}}" class="product-title">1. Nhập điểm </a>
                                                <span class="product-description">Thực hiện nhập điểm tại đây </span>
                                            </div>
                                        </li>

                            
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./row-->
                </div>
{{-- Kết thúc ứng dụng chung               --}}

{{--Thông báo Sinh Viên                --}}
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><a href="homeSSO.action">THÔNG BÁO</a></h3>
                                </div>
                                <div class="box-body">
                                    <ul class="products-list product-list-in-box">
                                        <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/thongbao.png')}}" alt="">
                                            </div>
                                            <div class="product-info">
                                                <a href="#" class="product-title">1.Theo dõi cập nhật TKB khi học online </a>
                                                <span class="product-description">Ngày đăng</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./row-->
                </div>
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
    <script>
        $(document).ready(function () {
        });
    </script>
@endsection
