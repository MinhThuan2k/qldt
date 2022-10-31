<?php

namespace App\Http\Controllers;

use App\Models\NamHocModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class NamHocController extends Controller
{
    public function getNamHoc(){
        return view('auth.nam-hoc.nam-hoc',['data'=>(new NamHocModel()) ->danhSach()]);
    }

    public function putNamHoc(Request $request){
        $nh = new NamHocModel();
        $nh->ma_nam_hoc = $request->input('ma_nam_hoc');
        $nh->ten_nam_hoc = $request->input('ten_nam_hoc');

        if($nh->tonTaiMaNamHoc())
            return ToolsModel::status('Mã đơn vị đã tồn tại', 500);

        if($nh->them())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }

    public function postNamHoc(Request $request){
        $nh = new NamHocModel();
        $nh->id_nam_hoc = $request->input('id_nam_hoc');
        $nh->ma_nam_hoc = $request->input('ma_nam_hoc');
        $nh->ten_nam_hoc = $request->input('ten_nam_hoc');
        if($nh->capNhat())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteNamHoc(Request $request){
        $nh = new NamHocModel();
        $nh->id_nam_hoc = $request->input('id_nam_hoc');
        if($nh->xoa())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }
}

