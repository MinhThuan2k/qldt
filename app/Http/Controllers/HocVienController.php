<?php

namespace App\Http\Controllers;

use App\Models\HocVienModel;
use App\Models\LopHocModel;
use App\Models\NganhHocModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HocVienController extends Controller
{
    public function getHocVien()
    {
        $hv = new HocVienModel();
        return view('auth.hoc-vien.hoc-vien',[
            'data'=>$hv->danhsach(),
            'lop_hoc'=>$hv->getLopHoc(),
            'chuyen_nganh'=>$hv->getChuyenNganh()
        ]);
    }

    public function getHocVienTheoLop($id_don_vi,$id_lop_hoc )
    {
        $lophoc = new LopHocModel();
        $lophoc->id_don_vi = $id_don_vi;

        $hv = new HocVienModel();
        $hv->id_lop_hoc = $id_lop_hoc;
        return view('auth.hoc-vien.hoc-vien',[
            'data'=>$hv->getHocVienTheoLopHoc(),
            'nien_khoa'=>$hv->getNienKhoa(),
            'id_lop_hoc'=>$id_lop_hoc,
            'ten_lop_hoc'=>$hv->getTenLopHoc(),
            'id_don_vi'=>$id_don_vi,
            'ten_don_vi' => $lophoc->getTenDonVi(),
            'lop_hoc'=>$hv->getLopHoc(),
            'chuyen_nganh'=>$hv->getChuyenNganh()
        ]);
    }

    public function putHocVien(Request $r)
    {
        $hocvien = new HocVienModel();
        $hocvien->id_lop_hoc = $r->id_lop_hoc;
        $hocvien->id_chuyen_nganh = $r->id_chuyen_nganh;
        $hocvien->ho = $r->ho;
        $hocvien->ten = $r->ten;
        $hocvien->email = $r->email;
        $hocvien->sdt = $r->sdt;
        $hocvien->dia_chi = $r->dia_chi;
        $hocvien->cmnd = $r->cmnd;
        $hocvien->sdt_gd = $r->sdt_gd;
        $hocvien->ghi_chu = $r->ghi_chu;
        $hocvien->trang_thai = $r->trang_thai;
        if($hocvien->insert())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }
    public function deleteHocVien(Request $r)
    {
        $hocvien = new HocVienModel();
        $hocvien->id_hoc_vien = $r->id_hoc_vien;
        if($hocvien->delete())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }

    public function postHocVien(Request $r)
    {
        $hocvien = new HocVienModel();
        $hocvien->id_hoc_vien = $r->id_hoc_vien;
        $hocvien->id_lop_hoc = $r->id_lop_hoc;
        $hocvien->id_chuyen_nganh = $r->id_chuyen_nganh;
        $hocvien->ho = $r->ho;
        $hocvien->ten = $r->ten;
        $hocvien->email = $r->email;
        $hocvien->sdt = $r->sdt;
        $hocvien->dia_chi = $r->dia_chi;
        $hocvien->cmnd = $r->cmnd;
        $hocvien->sdt_gd = $r->sdt_gd;
        $hocvien->ghi_chu = $r->ghi_chu;
        $hocvien->trang_thai = $r->trang_thai;
        if($hocvien->capnhat())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }

    public function importDanhSachv2(Request $request, $id_don_vi, $id_lop_hoc)
    {
        $valid = $request->validate(['file-excel'=>'required|max:10240']);
        if (!$valid)
            return;
        $arrayLoi = [];
        $tong = 0;
        $lophoc = new LopHocModel();
        $lophoc->id_lop_hoc = $id_lop_hoc;
        $lophoc->xoaDuLieuLopHoc();

        $dataExcel = ToolsModel::readExcel($request->file('file-excel'), 'A3');

        $hocvien = new HocVienModel();
        $hocvien->id_lop_hoc = $id_lop_hoc;
        foreach ($dataExcel['data'] as $item) {
            if (trim($item[ToolsModel::chartNumber('A')])=='')
                break;
            $hocvien->id_lop_hoc = $id_lop_hoc;
            $hocvien->id_chuyen_nganh = 1;
            $hocvien->ho = trim($item[ToolsModel::chartNumber('C')]);
            $hocvien->ten = trim($item[ToolsModel::chartNumber('D')]);
            $hocvien->email = trim($item[ToolsModel::chartNumber('J')]);
            $hocvien->sdt ="";
            $hocvien->dia_chi = "";
            $hocvien->cmnd = trim($item[ToolsModel::chartNumber('H')]);
            $hocvien->sdt_gd = "";
            $hocvien->trang_thai = trim($item[ToolsModel::chartNumber('I')]) == "Thôi học" ? 0:1;
            $hocvien->ghi_chu = "";


//            if (strlen($hocvien->cmnd) != 9 && strlen($hocvien->cmnd) != 12 && strlen($hocvien->cmnd) != 0) {
//                array_push($arrayLoi, ['type' => 'cmnd', 'text' => "CMND: " . $hocvien->cmnd . " không đúng định dạng."]);
//            } else if ($hocvien->checkCMND($id_khoa_thi, $ts->cmnd)) {
//                array_push($arrayLoi, ['type' => 'cmnd', 'text' => "CMND: " . $ts->cmnd . " đã trùng lập."]);
//            } else if ($ts->mssv != "Tự do" && $ts->mssv != "CBGV" && $ts->checkMSSV($id_khoa_thi, $ts->mssv)) {
//                array_push($arrayLoi, ['type' => 'mssv', 'text' => "MSSV: " . $ts->mssv . " đã trùng lập."]);
//            } else if (!is_numeric($ts->diem_lt)) {
//                array_push($arrayLoi, ['type' => 'diem_lt', 'text' => "Điểm LT của " . $ts->so_bao_danh . " không đúng định dạng"]);
//            }
//            else if (!is_numeric($ts->diem_th)) {
//                array_push($arrayLoi, ['type' => 'diem_th', 'text' => "Điểm TH của " . $ts->so_bao_danh . " không đúng định dạng"]);
//            }
//            else {
            $hocvien->insert();
            $tong++;
//            }
        }

        if (count($arrayLoi) > 0) {
            return redirect()
                ->action('App\Http\Controllers\HocVienController@getHocVienTheoLop',
                    ['id_don_vi'=>$id_don_vi,
                    'id_lop_hoc'=>$id_lop_hoc])
                ->with('error', $arrayLoi);
        }
        return redirect()
            ->action('App\Http\Controllers\HocVienController@getHocVienTheoLop',
                ['id_don_vi'=>$id_don_vi,
                'id_lop_hoc'=>$id_lop_hoc])
            ->with('msg', 'Import dữ liệu thành công ' . $tong . ' mẫu tin');
        }

        public function timHocVien(Request $r)
        {
            return response()->json(HocVienModel::danhSachAjax($r->q));
        }
}
