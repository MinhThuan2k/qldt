<?php
use Illuminate\Support\Facades\Route;
// Năm học
Route::group(['prefix' => '/nam-hoc'], function() {
    Route::get('/', 'App\Http\Controllers\NamHocController@getNamHoc');
    Route::put('/', 'App\Http\Controllers\NamHocController@putNamHoc');
    Route::delete('/', 'App\Http\Controllers\NamHocController@deleteNamHoc');
    Route::post('/', 'App\Http\Controllers\NamHocController@postNamHoc');
});
// Niên Khóa
Route::group(['prefix' => '/nien-khoa'], function() {
    Route::get('/','App\Http\Controllers\NienKhoaController@getNienKhoa');
    Route::put('/','App\Http\Controllers\NienKhoaController@putNienKhoa');
    Route::delete('/','App\Http\Controllers\NienKhoaController@deleteNienKhoa');
    Route::post('/','App\Http\Controllers\NienKhoaController@postNienKhoa');
});
// Cài Đặt đăng ký môn
Route::group(['prefix' => '/dangky-mon'], function() {
    Route::get('/','App\Http\Controllers\CaiDatDangKyMonController@HienThi');
    Route::post('/', 'App\Http\Controllers\CaiDatDangKyMonController@postCaiDat');
});
// Hiển thị bảng điểm
Route::group(['prefix' => '/sv'], function() {
    // Lọc bảng điểm của sinh viên theo học kỳ /9/6
    Route::get('/{id_hoc_vien}/{id_hoc_ky}','App\Http\Controllers\BangDiemSinhVienController@bangDiemTheoHk');
    Route::get('/{id_hoc_vien}/','App\Http\Controllers\BangDiemSinhVienController@getAllbangDiem');

// Giao diện chính của sinh viên
    // bị lỗi url file blank-sv tại dòng 76
    // không thể trỏ tới bảng điểm từ giao diện sinh viên
    Route::get('/','App\Http\Controllers\BangDiemSinhVienController@getSinhVien');

    Route::group(['prefix' => '/bangdiem'], function() {
        Route::get('/','App\Http\Controllers\BangDiemSinhVienController@gdBangDiem');
// Lấy tất cả bảng điểm của sinh viên /9  (danh_sach_lop_hoc_phan.id_hoc_vien)
        Route::get('/{id_hoc_vien}','App\Http\Controllers\BangDiemSinhVienController@bangDiem');
    });

// Học Phí

});
Route::group(['prefix' => '/hoc-phi'], function() {
    Route::get('/','App\Http\Controllers\HocPhiController@getViewHocPhi');
    Route::put('/','App\Http\Controllers\HocPhiController@putThemHocPhi');
    Route::delete('/','App\Http\Controllers\HocPhiController@xoaHocPhi');
    Route::post('/','App\Http\Controllers\HocPhiController@updateHocKy');
});

// Hiển thị bảng điểm
Route::group(['prefix' => '/sv-hocphi'], function() {
    // Lọc bảng điểm của sinh viên theo học kỳ /9/6
    Route::get('/{id_hoc_ky}','App\Http\Controllers\TraCuuHocPhiController@hocPhi');
    Route::get('/','App\Http\Controllers\TraCuuHocPhiController@getHocPhi');
});

// Hiển thị thời khóa biểu
Route::group(['prefix' => '/sv-tkb'], function() {
    Route::get('/','App\Http\Controllers\TraCuuThoiKhoaBieuController@getThoiKhoaBieu');
    
});
Route::get('/tim-giang-vien', 'App\Http\Controllers\GiangVienController@timGiangVien');
Route::get('/tkb1/{id_hoc_vien}','App\Http\Controllers\TraCuuThoiKhoaBieuController@getThoiKhoaBieu1');
Route::get('/tkb1/{id_hoc_vien}/{id_hoc_ky}','App\Http\Controllers\TraCuuThoiKhoaBieuController@getThoiKhoaBieuTheoHK');
//Route::get('lich-day-gv/{id_giang_vien}','App\Http\Controllers\GiaoDienGiangVienController@lichday');

Route::group(['prefix' => '/lich-day-gv'], function() {
    Route::get('/{id_giang_vien}','App\Http\Controllers\GiaoDienGiangVienController@SVTraCuulichday');
    Route::get('/{id_giang_vien}/{id_hoc_ky}','App\Http\Controllers\GiaoDienGiangVienController@SVTraCuulichdayTheoHK');
});


