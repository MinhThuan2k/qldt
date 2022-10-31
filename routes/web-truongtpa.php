<?php
use Illuminate\Support\Facades\Route;
Route::group(['prefix' => '/don-vi'], function() {
    Route::get('/', 'App\Http\Controllers\DonViController@getDonVi');
    Route::get('/', 'App\Http\Controllers\DonViController@getDonVi');
    Route::put('/', 'App\Http\Controllers\DonViController@putDonVi');
    Route::post('/', 'App\Http\Controllers\DonViController@postDonVi');
    Route::delete('/', 'App\Http\Controllers\DonViController@deleteDonVi');

    // Chi tiết của dơn vị
    Route::get('/{id_don_vi}', 'App\Http\Controllers\DonViController@getDonViCT');
    Route::group(['prefix' => '/{id_don_vi}'], function() {
        Route::get('/tin-chi', 'App\Http\Controllers\TinChiController@getTinChi');
         Route::put('/', 'App\Http\Controllers\TinChiController@putVanBang');
         Route::post('/', 'App\Http\Controllers\TinChiController@postVanBang');
         Route::delete('/', 'App\Http\Controllers\TinChiController@deleteVanBang');
        Route::get('/tin-chi/{id_lop_hoc}', 'App\Http\Controllers\TinChiController@getTinChiTheoLop');
        
    });
 
    
});
Route::get('/xet-tot-nghiep/{id_hoc_vien}', 'App\Http\Controllers\XetTotNghiepController@getTotNghiep');
Route::get('/xet-tot-nghiep/{id_hoc_vien}/exportfile', 'App\Http\Controllers\XetTotNghiepController@exportfile');
Route::get('/xet-tot-nghiep/{id_hoc_vien}/exportdiemtotnghiep', 'App\Http\Controllers\XetTotNghiepController@exportdiemtotnghiep');