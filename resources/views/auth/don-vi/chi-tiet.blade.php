@extends('auth.master')
@section('title') Quản lý thông tin {{ $ct->ten_don_vi }} @endsection
@section('content')
    <div class="container-fluid no-padding">

        <section class="content-header">
            <h1 class="text-bold">
                {{ $ct->ten_don_vi }}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ action('App\Http\Controllers\DonViController@getDonVi') }}"><i
                            class="fa fa-dashboard"></i>Đơn vị</a></li>
                <li class="active">{{ $ct->ten_don_vi  }}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-header">Quản lý Thông tin</h2>
                </div>
            </div>
            <div class="row">

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{action('App\Http\Controllers\GiangVienController@getGiangVienTheoDonVi',$ct->id_don_vi)}}">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-user-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Quản lý</span>
                                <span class="info-box-number text-uppercase">Giảng viên</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{action('App\Http\Controllers\ChuongTrinhDaoTaoController@getChuongTrinhDaoTao',$ct->id_don_vi)}}">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-star-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Quản lý</span>
                                <span class="info-box-number text-uppercase">Chương trình Đào tạo</span>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ action('App\Http\Controllers\LopHocController@getLopHoc', $ct->id_don_vi) }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Quản lý</span>
                                <span class="info-box-number text-uppercase">Lớp chuyên ngành</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ action('App\Http\Controllers\LopHocPhanController@getLopHocPhan',$ct->id_don_vi) }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Quản lý</span>
                                <span class="info-box-number text-uppercase">Lớp học phần</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ action('App\Http\Controllers\TinChiController@getTinChi',$ct->id_don_vi) }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-calendar-plus-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Quản lý</span>
                                <span class="info-box-number text-uppercase">Lớp ngắn hạn/Chứng chỉ</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-header">Thống kê & Báo cáo</h2>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-bar-chart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Thống kê & Báo cáo</span>
                                <span class="info-box-number text-uppercase">Kết quả học tập</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-hourglass-start"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Thống kê & Báo cáo</span>
                                <span class="info-box-number text-uppercase">Tình hình dự lớp</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
