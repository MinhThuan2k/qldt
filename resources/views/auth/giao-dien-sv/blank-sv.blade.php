@extends('auth.giao-dien-sv.main')
@section('title') Sinh Viên VLUTE @endsection
@section('content')

    <div class="content-wrapper" style="min-height: 251px;">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Sinh Viên
                    <small>CNTT</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="http://vlute.edu.vn/vi/"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                    <li><a href="#">Sinh Viên</a></li>
                    <li class="active">CNTT</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

{{-- Thông báo cho sinh viên  --}}
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><a href="#"> ĐĂNG KÝ HỌC PHẦN </a></h3>
                                </div>
                                <div class="box-body">
                                    <ul class="products-list product-list-in-box">
                                        <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/icondangky.png')}}" alt="Dang Ky">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ action('App\Http\Controllers\DangKyHocPhanController@getChonDotDangKy') }}" class="product-title">1. Đăng ký theo đợt </a>
                                                <span class="product-description">Sinh viên có thể thực hiện đăng ký học phần theo đợt </span>
                                            </div>
                                        </li>
                                        {{-- <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/icondangky.png')}}" alt="Dang Ky">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ action('App\Http\Controllers\KhaoSatDangKyHocPhanController@sinhVien') }}" class="product-title">2. Khảo sát đăng ký môn </a>
                                                <span class="product-description">Sinh viên chọn môn muốn đăng ký để mở lớp</span>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/icondangky.png')}}" alt="kiem tra">
                                            </div>
                                            <div class="product-info">
                                                <a href="#" class="product-title">3. Kiểm tra môn đăng ký </a>
                                                <span class="product-description">Sinh viên thực hiện kiểm tra học phần đã đăng ký</span>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- ./row-->
                </div>
{{-- Kết thúc thông tin sinh viên       --}}

{{-- Sinh Viên tra cứu--}}
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
                                                <a href="{{action('App\Http\Controllers\BangDiemSinhVienController@getAllbangDiem',session()->get('id'))}}" class="product-title">1. Tra cứu điểm cá nhân </a>
                                                <span class="product-description">Thực hiện tra cứu điểm cá nhân tại đây </span>
                                            </div>
                                        </li>

                                        {{-- <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/tracuu.png')}}" alt="">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{action('App\Http\Controllers\TraCuuHocPhiController@getHocPhi') }}" class="product-title">2. Tra cứu học phí </a>
                                                <span class="product-description">Thực hiện tra cứu học phí tại đây </span>
                                            </div>
                                        </li> --}}


                                        <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/tracuu.png')}}" alt="">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{action('App\Http\Controllers\TraCuuThoiKhoaBieuController@getThoiKhoaBieu') }}" class="product-title">2. Tra cứu thời khóa biểu </a>
                                                <span class="product-description">Sinh viên thực hiện tra cứu thời khóa biểu tại đây </span>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/tracuu.png')}}" alt="">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{action('App\Http\Controllers\GiaoDienGiangVienController@SVTraCuulichday',"1") }}" class="product-title">3. Tra cứu lịch dạy giảng viên </a>
                                                <span class="product-description">Tra cứu lịch dạy giảng viên tại đây </span>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="product-img">
                                                <img class="picture" src="{{asset('images/tracuu.png')}}" alt="">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{action('App\Http\Controllers\XetTotNghiepController@getTotNghiep',session()->get('id'))}}" class="product-title">4. Tra cứu đủ điều kiện tốt nghiệp </a>
                                                <span class="product-description">Sinh viên thực hiện tra cứu đủ điều kiện tốt nghiệp </span>
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
