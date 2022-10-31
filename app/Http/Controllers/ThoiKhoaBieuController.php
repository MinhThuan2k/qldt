<?php

namespace App\Http\Controllers;

use App\Models\HocKyModel;
use App\Models\LopHocModel;
use App\Models\LopHocPhanModel;
use App\Models\ThoiKhoaBieuModel;
use App\Models\ToolsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
class ThoiKhoaBieuController extends Controller
{
    //Thời khóa biểu của đơn vị theo lớp học phần
    public function getViewTKB($id_don_vi, $id_lop_hoc_phan){
        $thoikhoabieu = new ThoiKhoaBieuModel();
        $thoikhoabieu->id_lop_hoc_phan = $id_lop_hoc_phan;

        $lophocphan = new LopHocPhanModel();
        $lophocphan->id_lop_hoc_phan = $id_lop_hoc_phan;

        $lophoc = new LopHocModel();
        $lophoc->id_don_vi = $id_don_vi;


        return view('auth.thoi-khoa-bieu.thoi-khoa-bieu', ['ds' => $thoikhoabieu->dsTKB(),
            'chiTiet' => $lophocphan->chiTiet(),
            'id_don_vi' => $id_don_vi,
            'ten_don_vi' => $lophoc->getTenDonVi(),
            'dsPhongHoc' => (new ThoiKhoaBieuModel())->getPhongHoc(),
            'dsThoiGian' => (new ThoiKhoaBieuModel())->getThoiGian(),
            'dsGiangVien' => (new ThoiKhoaBieuModel())->getGiangVien(),
            'dsHocKy' => (new ThoiKhoaBieuModel())->dsHocKy(),
        ]);
    }

    //Thời khóa biểu chung
    public function getTKB(){
        $thoikhoabieu = new ThoiKhoaBieuModel();
        return view('auth.thoi-khoa-bieu.thoi-khoa-bieu-chung', ['ds' => $thoikhoabieu->danhSach(),
            'dsPhongHoc' => (new ThoiKhoaBieuModel())->getPhongHoc(),
            'dsThoiGian' => (new ThoiKhoaBieuModel())->getThoiGian(),
            'dsGiangVien' => (new ThoiKhoaBieuModel())->getGiangVien(),
            'dsHocKy' => (new ThoiKhoaBieuModel())->dsHocKy(),
        ]);
    }

    public function putTKB(Request $request){
        $thoikhoabieu = new ThoiKhoaBieuModel();
        $thoikhoabieu->id_phong = $request->input('id_phong');
        $thoikhoabieu->id_thoi_gian_hoc = $request->input('id_thoi_gian_hoc');
        $thoikhoabieu->id_giang_vien = $request->input('id_giang_vien');
        $thoikhoabieu->id_hoc_ky = $request->input('id_hoc_ky');
        $thoikhoabieu->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        $thoikhoabieu->ngay_hoc = $request->input('ngay_hoc');
        $thoikhoabieu->phan_cong_day = $request->input('phan_cong_day');

        if ($thoikhoabieu->themTKB())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }

    public function postTKB(Request $request){
        $thoikhoabieu = new ThoiKhoaBieuModel();
        $thoikhoabieu->id_thoi_khoa_bieu = $request->input('id_thoi_khoa_bieu');
        $thoikhoabieu->id_phong = $request->input('id_phong');
        $thoikhoabieu->id_thoi_gian_hoc = $request->input('id_thoi_gian_hoc');
        $thoikhoabieu->id_giang_vien = $request->input('id_giang_vien');
        $thoikhoabieu->id_hoc_ky = $request->input('id_hoc_ky');
        $thoikhoabieu->ngay_hoc = $request->input('ngay_hoc');
        $thoikhoabieu->phan_cong_day = $request->input('phan_cong_day');

        if ($thoikhoabieu->capNhatTKB())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteTKB(Request $request){
        $thoikhoabieu = new ThoiKhoaBieuModel();
        $thoikhoabieu->id_thoi_khoa_bieu = $request->input('id_thoi_khoa_bieu');
        if($thoikhoabieu->xoaTKB())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }

    public function importDanhba(Request $r)
    {
        $loi = 0;
        $thanh_cong = 0;
        $dataExcel = ToolsModel::readExcel($r->file('file-excel'), 'A2');
        $tkb = new ThoiKhoaBieuModel();
        //Lấy học kỳ để chuẩn bị cho vòng lặp thêm thời khóa biểu theo từng tuần
        $hocKy = HocKyModel::getHocKy($r->id_hoc_ky);
        $tkb->id_hoc_ky = $r->id_hoc_ky;
        foreach ($dataExcel['data'] as $item) {
            $tkb->id_phong = trim($item[ToolsModel::chartNumber('H')]);
            $tkb->id_lop_hoc_phan = LopHocPhanModel::timLopByMaLop(trim($item[ToolsModel::chartNumber('E')]));
            $tkb->id_thoi_gian_hoc = trim($item[ToolsModel::chartNumber('C')]);
            $tkb->id_giang_vien = trim($item[ToolsModel::chartNumber('F')]);
            for($i = $hocKy->tuan_bat_dau; $i <= $hocKy->tuan_ket_thuc; $i++)
            {
                $date = Carbon::now();
                $namHoc = Carbon::parse($hocKy->ngay_bat_dau)->year;
                $ngayHoc = trim($item[ToolsModel::chartNumber('B')]); //Ngày trong tuần (1,2,3,4,5,6,7)
                $tkb->ngay_hoc = $date->setISODate($namHoc, $i, $ngayHoc);
                if($tkb->themTKB())
                {
                    $thanh_cong++;
                }
                else
                {
                    $loi++;
                }
            }
        }
        return redirect()->back()->with(['msg'=>"Đã thêm xong.\nThành công: $thanh_cong.\nLỗi: $loi"]);
    }
}
