<?php

namespace App\Http\Controllers;

use App\Models\ThoiGianModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThoiGianController extends Controller
{
    public function getThoiGian()
    {
        return view('auth.hoc-phan-hoc.hoc-phan-hoc',['data'=>(new ThoiGianModel())->danhsach()]);
    }
    public function putThoiGian(Request $r)
    {
        $tg = new ThoiGianModel();
        $tg->tiet_ca = $r->tiet_ca;
        $tg->trang_thai = $r->trang_thai;
        $tg->gio_bat_dau = $r->gio_bat_dau;
        $tg->gio_ket_thuc = $r->gio_ket_thuc;
        if($tg->them())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }
    public function postThoiGian(Request $r)
    {
        $tg = new ThoiGianModel();
        $tg->id_thoi_gian_hoc = $r->id_thoi_gian_hoc;
        $tg->tiet_ca = $r->tiet_ca;
        $tg->trang_thai = $r->trang_thai;
        $tg->gio_bat_dau = $r->gio_bat_dau;
        $tg->gio_ket_thuc = $r->gio_ket_thuc;
        if($tg->sua())
            return ToolsModel::status('Sửa thông tin thành công', 200);
        return ToolsModel::status('Sửa thông tin thất bại', 500);
    }
    public function deleteThoiGian(Request $r)
    {
        $tg = new ThoiGianModel();
        $tg->id_thoi_gian_hoc = $r->id_thoi_gian_hoc;
        if($tg->xoa())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }
}
