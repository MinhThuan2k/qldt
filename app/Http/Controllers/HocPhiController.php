<?php

namespace App\Http\Controllers;

use App\Models\HocKyModel;
use App\Models\HocPhiModel;
use App\Models\ToolsModel;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Http\Request;

class HocPhiController extends Controller
{
    public  function getViewHocPhi(){
        $hp = new HocPhiModel();
        return view('auth.hoc-phi.hoc-phi',[
            'data' => $hp->dsHocPhi(),
            'data1' => $hp->dsHeDaoTao(),
            'data2' => $hp->dsHocKy(),
            'data3' => $hp->dsChuyenNganh()
            ]
        );
    }
    public function putThemHocPhi(Request $request){
        $hp = new HocPhiModel();
        $hp->id_he_dao_tao = $request->input('id_he_dao_tao');
        $hp->id_hoc_ky = $request->input('id_hoc_ky');
        $hp->id_chuyen_nganh = $request->input('id_chuyen_nganh');
        $hp->ly_thuyet = $request->input('ly_thuyet');
        $hp->thuc_hanh = $request->input('thuc_hanh');
        $hp->trang_thai = $request->input('trang_thai');
        if($hp->themHP())
            return ToolsModel::status('Thêm thành công', 200);
        return ToolsModel::status('Thêm thất bại', 500);
    }
    public function xoaHocPhi(Request $request)
    {
        $hp = new HocPhiModel();
        $hp->id_hoc_phi = $request->input('id_hoc_phi');
        if ($hp->xoa())
            return ToolsModel::status('Xóa thành công', 200);
        return ToolsModel::status('Xóa thất bại', 500);
    }
    public function updateHocKy(Request $request){
        $hp = new HocPhiModel();
        $hp->id_he_dao_tao = $request->input('id_he_dao_tao');
        $hp->id_hoc_ky = $request->input('id_hoc_ky');
        $hp->id_chuyen_nganh = $request->input('id_chuyen_nganh');
        $hp->ly_thuyet = $request->input('ly_thuyet');
        $hp->thuc_hanh = $request->input('thuc_hanh');
        $hp->trang_thai = $request->input('trang_thai');
        $hp->id_hoc_phi = $request->input('id_hoc_phi');
        if ($hp->capNhat())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }

}
