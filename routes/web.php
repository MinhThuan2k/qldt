<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware grou    p. Now create something great!
|
*/


//Đăng nhập đăng xuất
Route::get('/login',['App\Http\Controllers\CaNhanController', 'dangNhap'])->name('login');
Route::get('/logout',['App\Http\Controllers\CaNhanController', 'dangXuat'])->name('logout');
Route::get('/login/callback',['App\Http\Controllers\CaNhanController', 'callback']);

##Check quyền giảng viên
Route::middleware('kiemTraDangNhapGiangVien')->group(function(){
    Route::get('/',function (){
        return view('auth.blank');
    });

});
require 'web-bahao.php';
require 'web-duytan.php';
require 'web-hoangdinh.php';
require 'web-thanhhao.php';
require 'web-truongtpa.php';

Route::middleware('kiemTraDangNhapSinhVien')->group(function(){
    ##Check quyền sinh viên
    //Đăng kí học phần
    Route::group(['prefix' => '/giao-dien-dk-hp'], function() {
        Route::get('/chonDotDangKy','App\Http\Controllers\DangKyHocPhanController@getChonDotDangKy');
        Route::get('/dangKy/{id_dot_dang_ky}','App\Http\Controllers\DangKyHocPhanController@getDangKyHocPhan')->name('dangKyHocPhan');

        Route::middleware('KiemTraThoiHanDangKy')->group(function(){
            Route::put('/','App\Http\Controllers\DangKyHocPhanController@dangKyHocPhan');
            Route::put('/dangKyLopHocKem','App\Http\Controllers\DangKyHocPhanController@dangKyHocPhanKem');
            Route::delete('/huyHocPhanDangKy','App\Http\Controllers\DangKyHocPhanController@huyHocPhanDangKy');
        });
        Route::post('/getLopThucHanh','App\Http\Controllers\DangKyHocPhanController@getLopThucHanh');
        Route::post('/getDangKyHocPhanDatatable','App\Http\Controllers\DangKyHocPhanController@getDangKyHocPhanDatatable');
        Route::post('/getHocPhanDaDangKy','App\Http\Controllers\DangKyHocPhanController@getHocPhanDaDangKy');
        Route::post('/sync_hocPhanDaDangKy','App\Http\Controllers\DangKyHocPhanController@sync_hocPhanDaDangKy');
        Route::post('/getChiTietDotDangKy','App\Http\Controllers\DangKyHocPhanController@getChiTietDotDangKy');
        Route::post('/goi-y-ctdd/{id_dot_dang_ky}/{id_hoc_vien}', 'App\Http\Controllers\DangKyHocPhanController@getDangKyHocPhanGoiYDatatable');

    });
    //Giao diện sv
    Route::group(['prefix' => '/giao-dien-sv'], function() {
        Route::get('/','App\Http\Controllers\GiaoDienSinhVienController@giaoDien');
    });

//    Route::group(['prefix' => '/giao-dien-dk-hp'], function() {
//        Route::get('/','App\Http\Controllers\DangKyHocPhanController@getDangKyHocPhan');
//    });
});
