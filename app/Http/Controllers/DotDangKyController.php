<?php

namespace App\Http\Controllers;

use App\Models\DotDangKyModel;
use App\Models\HocKyModel;
use App\Models\ToolsModel;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Http\Request;

class DotDangKyController extends Controller
{
    public  function getViewDotDangKy(){
        $dotdangky = new DotDangKyModel();
//        dd($dotdangky->dsDotDangKy());
        return view('auth.dot-dang-ky.dot-dang-ky',['data' => $dotdangky->dsDotDangKy(),'dsHocKy'=>$dotdangky->dsHocKy()]);
//        return view('auth.dot-dang-ky.dot-dang-ky',['data' => $dotdangky->dsDotDangKy()]);
    }


    public function putDotDangKy(Request $request){
        $dotdangky = new DotDangKyModel();
        $dotdangky->ten_dot_dang_ky = $request->input('ten_dot_dang_ky');
        $dotdangky->id_hoc_ky = $request->input('id_hoc_ky');
        $dotdangky->thoi_gian_mo = $request->input('thoi_gian_mo');
        $dotdangky->thoi_gian_dong = $request->input('thoi_gian_dong');

        if($dotdangky->them())
            return ToolsModel::status('Thêm thành công', 200);
        return ToolsModel::status('Thêm thất bại', 500);
    }


    public function deleteDotDangKy(Request $request)
    {
        $dotdangky = new DotDangKyModel();
        $dotdangky->id_dot_dang_ky = $request->input('id_dot_dang_ky');
        if ($dotdangky->xoa())
            return ToolsModel::status('Xóa thành công', 200);
        return ToolsModel::status('Xóa thất bại', 500);
    }


    public function updateDotDangKy(Request $request){
        $dotdangky = new DotDangKyModel();
        $dotdangky->ten_dot_dang_ky = $request->input('ten_dot_dang_ky');
        $dotdangky->id_hoc_ky = $request->input('id_hoc_ky');
        $dotdangky->thoi_gian_mo = $request->input('thoi_gian_mo');
        $dotdangky->thoi_gian_dong = $request->input('thoi_gian_dong');
        $dotdangky->id_dot_dang_ky = $request->input('id_dot_dang_ky');

        if ($dotdangky->capNhat())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }


}
