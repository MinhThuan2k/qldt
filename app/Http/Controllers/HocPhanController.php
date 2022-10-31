<?php

namespace App\Http\Controllers;

use App\Models\HocPhanModel;
use App\Models\NganhHocModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class HocPhanController extends Controller
{
    public function getHocPhan()
    {
        $data = new HocPhanModel();
        return view('auth.hoc-phan.hoc-phan', ['data'=>$data->danhsach()]);
    }

    public function putHocphan(Request $r)
    {
        $hocphan = new HocPhanModel();
        $hocphan->ma_hoc_phan = $r->ma_hoc_phan;
        $hocphan->ten_hoc_phan = $r->ten_hoc_phan;
        $hocphan->ten_tieng_anh = $r->ten_tieng_anh;
        $hocphan->tin_chi_lt = $r->tin_chi_lt;
        $hocphan->tin_chi_th = $r->tin_chi_th;
        $hocphan->trang_thai = $r->trang_thai;
        if($hocphan->tonTaiMaHocPhan())
            return ToolsModel::status('Mã ngành đã tồn tại', 500);
        if($hocphan->them())
        {
            return ToolsModel::status('Thêm thông tin thành công', 200);
        }
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }
    public function postHocPhan(Request $r)
    {
        $hocphan = new HocPhanModel();
        $hocphan->id_hoc_phan = $r->id_hoc_phan;
        $hocphan->ma_hoc_phan = $r->ma_hoc_phan;
        $hocphan->ten_hoc_phan = $r->ten_hoc_phan;
        $hocphan->ten_tieng_anh = $r->ten_tieng_anh;
        $hocphan->tin_chi_lt = $r->tin_chi_lt;
        $hocphan->tin_chi_th = $r->tin_chi_th;
        $hocphan->trang_thai = $r->trang_thai;

        if($hocphan->sua())
        {
            return ToolsModel::status('Sửa thông tin thành công', 200);
        }
        return ToolsModel::status('Sửa thông tin thất bại', 500);
    }

    public function deleteHocPhan(Request $r)
    {
        $hocphan = new HocPhanModel();
        $hocphan->id_hoc_phan = $r->id_hoc_phan;
        if($hocphan->xoa())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }
}
