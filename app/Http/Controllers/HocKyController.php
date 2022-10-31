<?php

namespace App\Http\Controllers;

use App\Models\HocKyModel;
use App\Models\ToolsModel;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Http\Request;

class HocKyController extends Controller
{
    public  function getViewHocKy(){
        $hk = new HocKyModel();
        return view('auth.hoc-ky.hoc-ky',['data' => $hk->dsHocKy(),'data2'=>$hk->dsNamHoc()]);
    }
    public function putThemHocKy(Request $request){
        $hk = new HocKyModel();
        $hk->id_nam_hoc = $request->input('id_nam_hoc');
        $hk->ma_hoc_ky = $request->input('ma_hoc_ky');
        $hk->ten_hoc_ky = $request->input('ten_hoc_ky');
        $hk->ngay_bat_dau = $request->input('ngay_bat_dau');
        $hk->tuan_bat_dau = $request->input('tuan_bat_dau');
        $hk->ngay_ket_thuc = $request->input('ngay_ket_thuc');
        $hk->tuan_ket_thuc = $request->input('tuan_ket_thuc');
        $hk->trang_thai = $request->input('trang_thai');
        if($hk->tonTaiMaHocKy())
            return ToolsModel::status('Mã học kỳ đã tồn tại', 500);
        if($hk->themHK())
            return ToolsModel::status('Thêm thành công', 200);
        return ToolsModel::status('Thêm thất bại', 500);
    }
    public function deleteXoaHocKy(Request $request)
    {
        $hk = new HocKyModel();
        $hk->id_hoc_ky = $request->input('id_hoc_ky');
        if ($hk->xoa())
            return ToolsModel::status('Xóa thành công', 200);
        return ToolsModel::status('Xóa thất bại', 500);
    }
    public function updateHocKy(Request $request){
        $hk = new HocKyModel();
        $hk->id_nam_hoc = $request->input('id_nam_hoc');
        $hk->ma_hoc_ky = $request->input('ma_hoc_ky');
        $hk->ten_hoc_ky = $request->input('ten_hoc_ky');
        $hk->ngay_bat_dau = $request->input('ngay_bat_dau');
        $hk->tuan_bat_dau = $request->input('tuan_bat_dau');
        $hk->ngay_ket_thuc = $request->input('ngay_ket_thuc');
        $hk->tuan_ket_thuc = $request->input('tuan_ket_thuc');
        $hk->trang_thai = $request->input('trang_thai');
        $hk->id_hoc_ky = $request->input('id_hoc_ky');
        if ($hk->tonTaiMaHocKyUpdate())
            return ToolsModel::status('Mã học kỳ đã tồn tại', 500);
        if ($hk->capNhat())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }

}
