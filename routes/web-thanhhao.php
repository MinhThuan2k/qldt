<?php
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => '/he-dao-tao'], function() {
    Route::get('/','App\Http\Controllers\HeDaoTaoController@getViewHeDaoTao');
    Route::put('/','App\Http\Controllers\HeDaoTaoController@putHeDaoTao');
    Route::delete('/','App\Http\Controllers\HeDaoTaoController@deleteHeDaoTao');
    Route::post('/','App\Http\Controllers\HeDaoTaoController@postHeDaoTao');
});

Route::group(['prefix' => '/'], function() {
    Route::get('/don-vi/{id_don_vi}/lop-chuyen-nganh','App\Http\Controllers\LopHocController@getLopHoc');
    Route::put('/don-vi/{id_don_vi}/lop-chuyen-nganh','App\Http\Controllers\LopHocController@putLopHoc');
    Route::delete('/','App\Http\Controllers\LopHocController@deleteLopHoc');
    Route::post('/don-vi/{id_don_vi}/lop-chuyen-nganh','App\Http\Controllers\LopHocController@postLopHoc');
});


Route::group(['prefix' => '/don-vi/{id_don_vi}/lop-chuyen-nganh'], function() {
    //Học viên
    Route::get('/{id_lop_hoc}', 'App\Http\Controllers\HocVienController@getHocVienTheoLop');
    Route::put('/{id_lop_hoc}', 'App\Http\Controllers\HocVienController@putHocVien');
    Route::post('/{id_lop_hoc}', 'App\Http\Controllers\HocVienController@postHocVien');
    Route::delete('/{id_lop_hoc}', 'App\Http\Controllers\HocVienController@deleteHocVien');
    Route::post('/{id_lop_hoc}/importExcel', 'App\Http\Controllers\HocVienController@importDanhSachv2');
});


Route::group(['prefix' => '/dot-dang-ky'], function() {
    //Học viên
    Route::get('/', 'App\Http\Controllers\DotDangKyController@getViewDotDangKy');
    Route::put('/', 'App\Http\Controllers\DotDangKyController@putDotDangKy');
    Route::post('/', 'App\Http\Controllers\DotDangKyController@updateDotDangKy');
    Route::delete('/', 'App\Http\Controllers\DotDangKyController@deleteDotDangKy');
});


Route::group(['prefix' => '/don-vi/{id_don_vi}/lop-hoc-phan'], function() {
    Route::get('/','App\Http\Controllers\LopHocPhanController@getLopHocPhan');

    Route::get('/{id_lop_hoc_phan}','App\Http\Controllers\LopHocPhanController@getLopHocPhanChiTiet');

//    Thời khóa biểu
    Route::get('/{id_lop_hoc_phan}/thoi-khoa-bieu','App\Http\Controllers\ThoiKhoaBieuController@getViewTKB');
});
Route::get('/getDataTable/{id_lop_hoc_phan}','App\Http\Controllers\LopHocPhanController@getDataTable');
// Export csv lớp học phần
Route::get('/export-lop-hoc-phan-csv/{id_hoc_ky}','App\Http\Controllers\LopHocPhanController@exportCSV');


//Thời khóa biểu
Route::put('/thoi-khoa-bieu','App\Http\Controllers\ThoiKhoaBieuController@putTKB');
Route::delete('/thoi-khoa-bieu','App\Http\Controllers\ThoiKhoaBieuController@deleteTKB');
Route::post('/thoi-khoa-bieu','App\Http\Controllers\ThoiKhoaBieuController@postTKB');

Route::group(['prefix' => '/lop-hoc-phan/chi-tiet/edit'], function() {
    Route::put('/{id_lop_hoc_phan}','App\Http\Controllers\LopHocPhanController@putLopHocPhanChiTiet');
    Route::delete('/{id_lop_hoc_phan}','App\Http\Controllers\LopHocPhanController@deleteLopHocPhanChiTiet');
    Route::post('/{id_lop_hoc_phan}','App\Http\Controllers\LopHocPhanController@postLopHocPhanChiTiet');
    Route::get('/{id_lop_hoc_phan}/exportExcel','App\Http\Controllers\LopHocPhanController@exportExcel');
});


Route::group(['prefix' => '/lop-hoc-phan/edit'], function() {
    Route::put('/','App\Http\Controllers\LopHocPhanController@putLopHocPhan');
    Route::delete('/','App\Http\Controllers\LopHocPhanController@deleteLopHocPhan');
    Route::post('/','App\Http\Controllers\LopHocPhanController@postLopHocPhan');
});



//Route::get('/lop-hoc-phan/{id_lop_hoc_phan}', 'App\Http\Controllers\LopHocPhanController@getLopHocPhanChiTiet');
//Route::group(['prefix' => '/lop-hoc-phan'], function() {
//    Route::put('/', 'App\Http\Controllers\LopHocPhanController@putLopHocPhanChiTiet');
//    Route::post('/', 'App\Http\Controllers\LopHocPhanController@deleteLopHocPhanChiTiet');
//    Route::delete('/', 'App\Http\Controllers\LopHocPhanController@postLopHocPhanChiTiet');
//});

