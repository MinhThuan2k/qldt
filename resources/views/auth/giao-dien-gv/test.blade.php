
@extends('auth.giao-dien-gv.main')
@section('title') GIẢNG VIÊN VLUTE @endsection
@section('content')

    <div class="content-wrapper" style="min-height: 251px;">
        <div class="container">
            <!-- Content Header (Page header) -->
                        
                        <section class="content-header">
                            <h1>
                                Danh sách sinh viên/Học phần:
                            </h1>
                            <ol class="breadcrumb">
                                <span aria-hidden="true">{{$id}}</span>
                        <span aria-hidden="true">{{$id_lop}}</span>
                        <span aria-hidden="true">{{$diem10}}</span>
                        <span aria-hidden="true">{{$diem40}}</span>
                        <span aria-hidden="true">{{$diem50}}</span>
                            </ol>
            
                        </section>
{{--Kết thúc--}}
            <!-- /.content -->
        </div>
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


@endsection

