<?php

namespace App\Http\Controllers;

use App\Models\DonViModel;
use App\Models\NganhHocModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class NganhHocController extends Controller
{
    public function getNganhHoc()
    {
        $data = new NganhHocModel();
        return view('auth.nganh-hoc.nganh-hoc', ['data'=>$data->danhsach()]);
    }

    public function putNganhHoc(Request $r)
    {
        $nganhhoc = new NganhHocModel();
        $nganhhoc->ma_nganh = $r->ma_nganh_hoc;
        $nganhhoc->ten_nganh = $r->ten_nganh_hoc;
        if($nganhhoc->tonTaiMaNganh())
            return ToolsModel::status('Mã ngành đã tồn tại', 500);
        if($nganhhoc->them())
        {
            return ToolsModel::status('Thêm thông tin thành công', 200);
        }
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }
    public function postNganhHoc(Request $r)
    {
        $nganhhoc = new NganhHocModel();
        $nganhhoc->id_nganh = $r->id;
        $nganhhoc->ma_nganh = $r->ma_nganh;
        $nganhhoc->ten_nganh = $r->ten_nganh;

        if($nganhhoc->sua())
        {
            return ToolsModel::status('Sửa thông tin thành công', 200);
        }
        return ToolsModel::status('Sửa thông tin thất bại', 500);
    }

    public function deleteNganhHoc(Request $r)
    {
        $nganhhoc = new NganhHocModel();
        $nganhhoc->id_nganh = $r->id_nganh;
        if($nganhhoc->xoa())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }
}
