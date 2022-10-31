<?php

namespace App\Http\Controllers;

use App\Models\DeXuatHocPhanModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class DeXuatHocPhanController extends Controller
{
    public  function getDeXuatHocPhan(){
        $p = new DeXuatHocPhanModel();
        return view('auth.de-xuat-hoc-phan.de-xuat-hoc-phan',['data' => $p->dsDeXuatHocPhan(),'hoc_phan'=>$p->dsHocPhan()
        ,'lop_hoc'=>$p->dsLopHoc(),'dot_dang_ky'=>$p->dsDotDangKy()]);

    }
    public function putDeXuatHocPhan(Request $request){
        $p = new DeXuatHocPhanModel();
        $p->id_dot_dang_ky = $request->input('id_dot_dang_ky');
        $p->id_lop_chuyen_nganh = $request->input('id_lop_chuyen_nganh');
        $p->id_hoc_phan = $request->input('id_hoc_phan');

        $p->ghichu = $request->input('ghichu');
        if($p->them())
            return ToolsModel::status('Thêm thành công', 200);
        return ToolsModel::status('Thêm thất bại', 500);
    }
    public function deleteDeXuatHocPhan(Request $request)
    {
        $p = new DeXuatHocPhanModel();
        $p->id_de_xuat_hoc_phan = $request->input('id_de_xuat_hoc_phan');
        if ($p->xoa())
            return ToolsModel::status('Xóa thành công', 200);
        return ToolsModel::status('Xóa thất bại', 500);
    }
    public function updateDeXuatHocPhan(Request $request){
        $p = new DeXuatHocPhanModel();
        $p->id_lop_chuyen_nganh = $request->input('id_lop_chuyen_nganh');
        $p->id_hoc_phan = $request->input('id_hoc_phan');
        $p->id_dot_dang_ky = $request->input('id_dot_dang_ky');
        $p->ghichu = $request->input('ghichu');
        $p->id_de_xuat_hoc_phan = $request->input('id_de_xuat_hoc_phan');
        if ($p->capNhat())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }
}
