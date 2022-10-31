<?php

namespace App\Http\Controllers;

use App\Models\ChuongTrinhDaoTaoModel;
use App\Models\HocPhanModel;
use App\Models\NienKhoaModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class ChuongTrinhDaoTaoController extends Controller
{
    public function timHocPhan(Request $r)
    {
        return response()->json(HocPhanModel::danhSachAjax($r->q));
    }
    public function getChuongTrinhDaoTao($id_don_vi)
    {
        $model_ctdt = new ChuongTrinhDaoTaoModel();
        $ctdt = $model_ctdt->danhsach($id_don_vi);
        //Lấy ra tổng tín chỉ
        for($i = 0; $i < count($ctdt); $i++)
        {
            $ctdt[$i]->sum_tong_tin_chi = ChuongTrinhDaoTaoModel::tinhTongTinChi($ctdt[$i]->id_chuong_trinh);
        }
        $ten_don_vi = $model_ctdt->getTenDonVi($id_don_vi)[0]->ten_don_vi;
        return view('auth.chuong-trinh-dao-tao.chuong-trinh-dao-tao')->with([
            'data'=>$ctdt,
            'ten_don_vi'=>$ten_don_vi,
            'id_don_vi'=>$id_don_vi,
            'nien_khoa'=>(new NienKhoaModel())->dsNienKhoa(),
        ]);
    }
    public function putChuongTrinhDaoTao(Request $r)
    {
        $ctdt = new ChuongTrinhDaoTaoModel();
        $ctdt->id_don_vi = $r->id_don_vi;
        $ctdt->id_khoa_hoc = $r->id_khoa_hoc;
        $ctdt->ma_chuong_trinh = $r->ma_chuong_trinh;
        $ctdt->ten_chuong_trinh = $r->ten_chuong_trinh;
        $ctdt->ngay_ban_hanh = $r->ngay_ban_hanh;
        $ctdt->tong_tin_chi = $r->tong_tin_chi;
        $ctdt->id_nien_khoa = $r->id_nien_khoa;
        $ctdt->trang_thai = $r->trang_thai;
        if ($ctdt->tonTaiMaChuongTrinh())
            return ToolsModel::status('Mã chương trình đã tồn tại', 500);
        if($ctdt->them())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);

    }
    public function postChuongTrinhDaoTao(Request $r)
    {
        $ctdt = new ChuongTrinhDaoTaoModel();
        $ctdt->id_chuong_trinh = $r->id_chuong_trinh;
        $ctdt->id_don_vi = $r->id_don_vi;
        $ctdt->id_khoa_hoc = $r->id_khoa_hoc;
        $ctdt->ma_chuong_trinh = $r->ma_chuong_trinh;
        $ctdt->ten_chuong_trinh = $r->ten_chuong_trinh;
        $ctdt->ngay_ban_hanh = $r->ngay_ban_hanh;
        $ctdt->tong_tin_chi = $r->tong_tin_chi;
        $ctdt->trang_thai = $r->trang_thai;
        if ($ctdt->tonTaiMaChuongTrinhUpdate())
            return ToolsModel::status('Mã chương trình đã tồn tại', 500);
        if($ctdt->sua())
            return ToolsModel::status('Sửa thông tin thành công', 200);
        return ToolsModel::status('Sửa thông tin thất bại', 500);
    }
    public function deleteChuongTrinhDaoTao(Request $r)
    {
        $ctdt = new ChuongTrinhDaoTaoModel();
        $ctdt->id_chuong_trinh = $r->id_chuong_trinh;
        if($ctdt->xoa())
        {
            return ToolsModel::status('Xóa thông tin thành công', 200);
        }
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }

}
