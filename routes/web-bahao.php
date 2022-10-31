<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/nganh-hoc'], function() {
    //Ngành học
    Route::get('/', 'App\Http\Controllers\NganhHocController@getNganhHoc');
    Route::put('/', 'App\Http\Controllers\NganhHocController@putNganhHoc');
    Route::post('/', 'App\Http\Controllers\NganhHocController@postNganhHoc');
    Route::delete('/', 'App\Http\Controllers\NganhHocController@deleteNganhHoc');
});

Route::group(['prefix' => '/hoc-vien'], function() {
    Route::get('/', 'App\Http\Controllers\HocVienController@getHocVien');
    Route::put('/', 'App\Http\Controllers\HocVienController@putHocVien');
    Route::post('/', 'App\Http\Controllers\HocVienController@postHocVien');
    Route::delete('/', 'App\Http\Controllers\HocVienController@deleteHocVien');
    
});
Route::get('/tim-hoc-vien', 'App\Http\Controllers\HocVienController@timHocVien');

Route::group(['prefix' => '/hoc-phan'], function() {
    Route::get('/', 'App\Http\Controllers\ThoiGianController@getThoiGian');
    Route::put('/', 'App\Http\Controllers\ThoiGianController@putThoiGian');
    Route::post('/', 'App\Http\Controllers\ThoiGianController@postThoiGian');
    Route::delete('/', 'App\Http\Controllers\ThoiGianController@deleteThoiGian');
});
//Học phần
Route::group(['prefix' => '/hoc-phan'], function() {
    Route::get('/', 'App\Http\Controllers\HocPhanController@getHocPhan');
    Route::put('/', 'App\Http\Controllers\HocPhanController@putHocPhan');
    Route::post('/', 'App\Http\Controllers\HocPhanController@postHocPhan');
    Route::delete('/', 'App\Http\Controllers\HocPhanController@deleteHocPhan');
});
//Cây tiến trình
Route::get('/don-vi/{id_don_vi}/ctdt/{id_chuong_trinh}', 'App\Http\Controllers\CayTienTrinhController@getCayTienTrinh');
Route::get('/don-vi/{id_don_vi}/ctdt', 'App\Http\Controllers\ChuongTrinhDaoTaoController@getChuongTrinhDaoTao');
Route::post('/get-cay-tien-trinh', 'App\Http\Controllers\CayTienTrinhController@getCayTienTrinhDatatable');
Route::post('/get-hoc-phan-by-id', 'App\Http\Controllers\CayTienTrinhController@getHocPhanById');
Route::group(['prefix' => '/cay-tien-trinh'], function() {
    Route::put('/', 'App\Http\Controllers\CayTienTrinhController@putCayTienTrinh');
    Route::post('/', 'App\Http\Controllers\CayTienTrinhController@postCayTienTrinh');
    Route::delete('/', 'App\Http\Controllers\CayTienTrinhController@deleteCayTienTrinh');
});
//Chương trình đào tạo
//Ajax select2 lấy thông tin
Route::get('/tim-hoc-phan', 'App\Http\Controllers\ChuongTrinhDaoTaoController@timHocPhan');
Route::group(['prefix' => '/ctdt'], function() {
    Route::put('/', 'App\Http\Controllers\ChuongTrinhDaoTaoController@putChuongTrinhDaoTao');
    Route::post('/', 'App\Http\Controllers\ChuongTrinhDaoTaoController@postChuongTrinhDaoTao');
    Route::delete('/', 'App\Http\Controllers\ChuongTrinhDaoTaoController@deleteChuongTrinhDaoTao');
});

//Xuất bảng điểm cho sinh viên
Route::get('/phieu-diem-sv/{id_hoc_vien}/{id_hoc_ky}', 'App\Http\Controllers\BangDiemController@hoc_vien');

//Tính điểm học kì cuối cùng của học viên (không phụ thuộc học kì phụ)
Route::get('/diem-hoc-ky/{id_hoc_vien}', 'App\Http\Controllers\BangDiemController@getDiemHocKi');

//Cài đặt đăng ký khảo sát
Route::group(['prefix' => '/dang-ky-khao-sat'], function() {
    Route::get('/', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@get');
    Route::put('/', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@them');
    Route::post('/', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@sua');
    Route::delete('/', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@xoa');
    Route::get('/chitiet/{id_dang_ky_khao_sat}', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@chiTiet');
    Route::get('/sv', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@sinhVien');
    Route::get('/getKhaoSat', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@getKhaoSat');
    Route::post('/getDotKhaoSat', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@get_DotKhaoSat');
    Route::put('/dangKyDotKhaoSat', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@dangKyMonHoc');


    //Tách lớp học phần
    Route::get('/getCaiDatLopHocPhan', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@getCaiDatLopHocPhan');


    // ID học kỳ lấy từ session chưa làm
    Route::post('/getDeXuatLopHocPhan/{id_dang_ky_khao_sat}', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@taoLopDeXuat');
    Route::get('/getDataTableLopHocPhan/{id_dang_ky_khao_sat}', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@getDataTable');

    Route::put('/them-lop-de-xuat/{id_dang_ky_khao_sat}', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@themLopDeXuat');
    Route::post('/sua-lop-de-xuat', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@suaLopDeXuat');
    Route::delete('/xoa-lop-de-xuat', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@xoaLopDeXuat');
    Route::put('/duyet-lop-de-xuat/{id_dang_ky_khao_sat}', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@duyetLopDeXuat');
    Route::delete('/duyet-lop-de-xuat/{id_dang_ky_khao_sat}', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@xoaDuyetLopDeXuat');



//    Cài đặt tự đề xuất lớp học phần
    Route::post('/caiDatLopHocPhan', 'App\Http\Controllers\KhaoSatDangKyHocPhanController@updateCaiDatLopHocPhan');
// Import thời khóa biểu
    Route::post('/importTKB', ['App\Http\Controllers\ThoiKhoaBieuController', 'importDanhba']);
});



