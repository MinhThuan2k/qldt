<?php

namespace App\Http\Controllers;

use App\Models\DonViModel;
use App\Models\LopHocModel;
use App\Models\HeDaoTaoModel;
use App\Models\NganhHocModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LopHocController extends Controller
{
    public function getLopHoc($id_don_vi){
        $lophoc = new LopHocModel();
        $lophoc -> id_don_vi = $id_don_vi;

        $danhsach = $lophoc->danhSach();
        foreach ($danhsach as $item){
            $lophoc-> id_lop_hoc = $item->id_lop_hoc;
            $siso = $lophoc->getSiSo();
            $lophoc->si_so = $siso->count;
            $lophoc->setSiSo();
        }

        return view('auth.lop-hoc.lop-hoc', ['ds' => $lophoc->danhSach(),
                    'dsHeDaoTao' => (new LopHocModel())->dsHeDaoTao(),
                    'dsNganhHoc' => (new LopHocModel())->dsNganhHoc(),
                    'dsNienKhoa' => (new LopHocModel())->dsNienKhoa(),
                    'id_don_vi' => $id_don_vi,
                    'ten_don_vi' => $lophoc->getTenDonVi(),
                    'dsGiangVien' => $lophoc->dsGiangVien()]);
    }

    public function putLopHoc(Request $request, $id_don_vi){
        $lophoc = new LopHocModel();
        $lophoc->ma_lop_hoc = $request->input('ma_lop_hoc');
        $lophoc->id_giang_vien = $request->input('id_giang_vien');
        $lophoc->id_khoa_hoc = $request->input('id_khoa_hoc');
        $lophoc->id_don_vi = $id_don_vi;
        $lophoc->id_nganh = $request->input('id_nganh');
        $lophoc->id_he_dao_tao = $request->input('id_he_dao_tao');
        $lophoc->ten_lop_hoc = $request->input('ten_lop_hoc');
        $lophoc->ghi_chu = $request->input('ghi_chu');

        if($lophoc->tonTaiMaLopHoc())
            return ToolsModel::status('Mã lớp học đã tồn tại', 500);

        if($lophoc->them())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }

    public function postLopHoc(Request $request, $id_don_vi){
        $lophoc = new LopHocModel();
        $lophoc->ma_lop_hoc = $request->input('ma_lop_hoc');
        $lophoc->id_giang_vien = $request->input('id_giang_vien');
        $lophoc->id_khoa_hoc = $request->input('id_khoa_hoc');
        $lophoc->id_don_vi = $id_don_vi;
        $lophoc->id_nganh = $request->input('id_nganh');
        $lophoc->id_he_dao_tao = $request->input('id_he_dao_tao');
        $lophoc->ten_lop_hoc = $request->input('ten_lop_hoc');
        $lophoc->ghi_chu = $request->input('ghi_chu');
        $lophoc->id_lop_hoc = $request->input('id_lop_hoc');

        if($lophoc->tonTaiMaLopHoc_capNhat())
            return ToolsModel::status('Mã lớp học đã tồn tại', 500);


        if($lophoc->capNhat())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteLopHoc(Request $request){
        $lophoc = new LopHocModel();
        $lophoc->id_lop_hoc = $request->input('id_lop_hoc');
        if($lophoc->xoa())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }
}
