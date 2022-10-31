<?php
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => '/hoc-ky'], function() {
    Route::get('/','App\Http\Controllers\HocKyController@getViewHocKy');
    Route::put('/', 'App\Http\Controllers\HocKyController@putThemHocKy');
    Route::delete('/', 'App\Http\Controllers\HocKyController@deleteXoaHocKy');
    Route::post('/', 'App\Http\Controllers\HocKyController@updateHocKy');
});
Route::group(['prefix' => '/giang-vien'], function() {
    Route::get('/','App\Http\Controllers\GiangVienController@getGiangVien');
    Route::put('/', 'App\Http\Controllers\GiangVienController@putGiangVien');
    Route::delete('/', 'App\Http\Controllers\GiangVienController@deleteGiangVien');
    Route::post('/', 'App\Http\Controllers\GiangVienController@updateGiangVien');
    Route::get('/{id_don_vi}', 'App\Http\Controllers\GiangVienController@getGiangVienTheoDonVi');
    Route::post('/{id_don_vi}', 'App\Http\Controllers\GiangVienController@importGiangVien');
    Route::get('/{id_don_vi}/export', 'App\Http\Controllers\GiangVienController@exportGiangVien');
});
Route::group(['prefix' => '/phong'], function() {
    Route::get('/','App\Http\Controllers\PhongController@getPhong');
    Route::get('/export','App\Http\Controllers\PhongController@exportPhong');
    Route::put('/', 'App\Http\Controllers\PhongController@putPhong');
    Route::delete('/', 'App\Http\Controllers\PhongController@deletePhong');
    Route::post('/', 'App\Http\Controllers\PhongController@updatePhong');
});
Route::group(['prefix' => '/co-van-hoc-tap'], function() {
    Route::get('/de-xuat-hoc-phan/','App\Http\Controllers\DeXuatHocPhanController@getDeXuatHocPhan');
    Route::put('/de-xuat-hoc-phan/', 'App\Http\Controllers\DeXuatHocPhanController@putDeXuatHocPhan');
    Route::delete('/de-xuat-hoc-phan/', 'App\Http\Controllers\DeXuatHocPhanController@deleteDeXuatHocPhan');
    Route::post('/de-xuat-hoc-phan/', 'App\Http\Controllers\DeXuatHocPhanController@updateDeXuatHocPhan');
});
Route::group(['prefix' => '/tkb'], function() {
    Route::get('/','App\Http\Controllers\ThoiKhoaBieuController@getTKB');
    Route::put('/', 'App\Http\Controllers\ThoiKhoaBieuController@putTKB');
    Route::delete('/', 'App\Http\Controllers\ThoiKhoaBieuController@deleteTKB');
    Route::post('/', 'App\Http\Controllers\ThoiKhoaBieuController@updateTKB');
});


Route::group(['prefix' => '/co-van-hoc-tap'], function() {
    Route::get('/{id_giang_vien}','App\Http\Controllers\GiaoDienGiangVienController@giaoDienGiangVien');
    Route::get('/{id_giang_vien}/kqht','App\Http\Controllers\GiaoDienGiangVienController@getDSLop2');
    Route::get('/cvht/{id_dot_dang_ky}/{id_giang_vien}','App\Http\Controllers\GiaoDienGiangVienController@getDSSV');
    Route::put('/cvht','App\Http\Controllers\GiaoDienGiangVienController@putDanhSachLopHocPhan');
    Route::post('/cvht','App\Http\Controllers\GiaoDienGiangVienController@updateDotDangKyChiTiet');
    Route::get('/de-xuat-hoc-phan/','App\Http\Controllers\DeXuatHocPhanController@getDeXuatHocPhan');
    Route::put('/de-xuat-hoc-phan/', 'App\Http\Controllers\DeXuatHocPhanController@putDeXuatHocPhan');
    Route::delete('/de-xuat-hoc-phan/', 'App\Http\Controllers\DeXuatHocPhanController@deleteDeXuatHocPhan');
    Route::post('/de-xuat-hoc-phan/', 'App\Http\Controllers\DeXuatHocPhanController@updateDeXuatHocPhan');
});
Route::group(['prefix' => '/lop-chuyen-nganh'], function() {
    Route::get('/{id_giang_vien}','App\Http\Controllers\GiaoDienGiangVienController@getDSLop');
});
Route::group(['prefix' => '/danh-sach-sv'], function() {
    Route::get('/{id_lop_hoc}','App\Http\Controllers\GiaoDienGiangVienController@getSV');
    Route::post('/','App\Http\Controllers\GiaoDienGiangVienController@updateMoTa');
});
Route::group(['prefix' => '/bang-diem-sv'], function() {
    Route::get('/{id_hoc_vien}','App\Http\Controllers\GiaoDienGiangVienController@getDiem');
});
Route::group(['prefix' => '/ket-qua-hoc-tap'], function() {
    Route::get('/{id_giang_vien}','App\Http\Controllers\GiaoDienGiangVienController@getDSlop2');
    Route::get('/{id_lop_hoc}/hoc-ky','App\Http\Controllers\GiaoDienGiangVienController@getLopHoc');
    Route::get('/kqht/{id_lop_hoc}/{id_hoc_ky}','App\Http\Controllers\GiaoDienGiangVienController@getKetQuaHocTap');

});
//Giao Dien Giang Vien
Route::group(['prefix' => '/giang-vien'], function() {
    Route::get('/{id_giang_vien}/nhap-diem-sv','App\Http\Controllers\GiaoDienGiangVienController@getDanhSachLop');
    Route::get('/{id_giang_vien}/lich-day','App\Http\Controllers\GiaoDienGiangVienController@lichday');
    Route::get('/{id_giang_vien}/nhap-diem-sv/{id_hoc_ky}','App\Http\Controllers\GiaoDienGiangVienController@getDanhSachLopTheoIDHocKy');
    Route::get('/{id_giang_vien}/lich-day/{id_hoc_ky}','App\Http\Controllers\GiaoDienGiangVienController@lichdayTheoHK');
});
Route::group(['prefix' => '/nhap-diem-sv'], function() {
    Route::get('/{id_lop_hoc_phan}','App\Http\Controllers\GiaoDienGiangVienController@nhapDiem');
    Route::post('/', 'App\Http\Controllers\GiaoDienGiangVienController@updateDiemHocVien');
    Route::get('/{id_lop_hoc_phan}/exportExcel', 'App\Http\Controllers\GiaoDienGiangVienController@exportBangDiem');
    Route::post('/{id_lop_hoc_phan}/importExcel', 'App\Http\Controllers\GiaoDienGiangVienController@importDiem');
});
Route::group(['prefix' => '/cvht'], function() {
    Route::get('/{id_giang_vien}','App\Http\Controllers\GiaoDienGiangVienController@giaoCoVanHocTap');
});