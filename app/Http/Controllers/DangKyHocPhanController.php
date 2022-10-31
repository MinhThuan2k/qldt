<?php

namespace App\Http\Controllers;

use App\Models\DangKyHocPhanModel;
use App\Models\DonViModel;
use App\Models\DotDangKyModel;
use App\Models\HocKyModel;
use App\Models\HocVienModel;
use App\Models\LopHocModel;
use App\Models\NamHocModel;
use App\Models\ToolsModel;
use App\Setting\DangKyHocPhanSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DangKyHocPhanController extends Controller
{
    //Lấy một sinh viên ra
    private static function hocVien($id)
    {
        $sql = "select * from hoc_vien
where id_hoc_vien = :id_hoc_vien";
        $data = [
            'id_hoc_vien'=>$id
        ];
        return DB::selectOne($sql, $data);
    }
    public function getChonDotDangKy()
    {
        return view('auth.giao-dien-dk-hp.chon-dot-dang-ky')->with([
            'dot_dang_ky'=>DangKyHocPhanModel::getDotDangKy()
        ]);
    }

    public function getDangKyHocPhan($id_dot_dang_ky)
    {
        //Lấy thông tin học viên và tính điểm trung bình ở học kỳ chính thức gần nhất
        $idHocVien = session()->get('id');
        $hocVien = self::hocVien($idHocVien);
        $diemTb = BangDiemController::getDiemHocKi($idHocVien);
        $caiDat = new DangKyHocPhanSetting($diemTb);
        $hocky = (new HocKyModel())->dsHocKy();
        $donvi = (new DonViModel())->danhSach();
        $id_lop_chuyen_nganh = HocVienModel::getLopHocByHocVien($idHocVien);
        return view('auth.giao-dien-dk-hp.blank-dk-hp')->with([
            'hoc_vien'=>$hocVien,
            'hoc_ky'=>$hocky,
            'don_vi'=>$donvi,
            'cai_dat'=>$caiDat->setting,
            'id_dot_dang_ky'=>$id_dot_dang_ky,
            'id_lop_chuyen_nganh'=>$id_lop_chuyen_nganh
        ]);
    }
    public function getDangKyHocPhanDatatable(Request $r)
    {
        return json_encode(DangKyHocPhanModel::getDanhSachLopHocPhanTheoDotDangKy($r->id_dot_dang_ky, $r->id_lop_chuyen_nganh,$r->id_hoc_vien));
    }
    public function getDangKyHocPhanGoiYDatatable(Request $r,$id_dot_dang_ky,$id_hoc_vien)
    {   
        $tkb=new DangKyHocPhanModel();
        $tkb->id_hoc_vien =$id_hoc_vien;
        $tkb->id_dot_dang_ky =$id_dot_dang_ky;
        return json_encode(DangKyHocPhanModel::getDanhSachLopHocPhanTheoDotDangKyTheoCTDD(
                        $id_dot_dang_ky,$id_hoc_vien));
    }
    public function KiemTraTrungGioHoc($id_hoc_vien, $id_dot_dang_ky, $id_lop_hoc_phan)
    {
        $hocPhanDaDKy = DangKyHocPhanModel::getHocPhanDaDangKy($id_hoc_vien, $id_dot_dang_ky);
        foreach($hocPhanDaDKy as $item)
        {
            //Thời gian của học phần đã đăng ký
            $ngayGioHoc = Carbon::parse($item->ngay_hoc)->dayOfWeek;
            $batDau = Carbon::parse($item->gio_bat_dau);
            $ketThuc =  Carbon::parse($item->gio_ket_thuc);
            //Thời gian của học phần sẽ đăng ký
            $hocPhanDangDangKy = DangKyHocPhanModel::getNgayGioHoc($id_lop_hoc_phan);
            $hp_ngayGioHoc = Carbon::parse($hocPhanDangDangKy->ngay_hoc)->dayOfWeek;
            $hp_batDau = Carbon::parse($hocPhanDangDangKy->gio_bat_dau);
            $hp_ketThuc = Carbon::parse($hocPhanDangDangKy->gio_ket_thuc);
            if($ngayGioHoc == $hp_ngayGioHoc)
            {
                if(($batDau <= $hp_ketThuc) && ($hp_batDau <= $ketThuc)){
                    return true;
                }
            }
        }
    }
    public function dangKyHocPhan(Request $r)
    {
        $id_hoc_vien = $r->session()->get('id');
        $caiDat = (new DangKyHocPhanSetting(BangDiemController::getDiemHocKi($id_hoc_vien)))->setting;
        $tinChiToiDa = value($caiDat['tinChiToiDa']);

        $id_lop_hoc_phan = $r->id_lop_hoc_phan;
        $id_dot_dang_ky = $r->id_dot_dang_ky;
        //Kiểm tra số tín chỉ giới hạn
        $soTinChiHocPhan = DangKyHocPhanModel::getTinChiByLopHocPhan($id_lop_hoc_phan);
        $hocPhanDaDangKy = DangKyHocPhanModel::sync_hocPhanDaDangKy($id_hoc_vien, $id_dot_dang_ky);
        $soTinChiHienTai = 0;
        foreach($hocPhanDaDangKy as $item)
        {
            $soTinChiHienTai += $item->so_tin_chi;
        }
        if($soTinChiHienTai + $soTinChiHocPhan > $tinChiToiDa)
        {
            return ToolsModel::status('Số tín chỉ tối đã đã đạt đến giới hạn!', 403);
        }
        //Kiểm tra lớp học phần có đầy chưa
        if(DangKyHocPhanModel::soLuongHocVien($id_lop_hoc_phan) >= DangKyHocPhanModel::getSoLuong($id_lop_hoc_phan))
        {
            return ToolsModel::status('Lớp học đã đầy, tải lại trang để cập nhật!', 403);
        }
        //Kiểm tra có trùng ngày giờ học hay không
        if($this->KiemTraTrungGioHoc($id_hoc_vien, $id_dot_dang_ky, $id_lop_hoc_phan))
        {
            return ToolsModel::status('Giờ học bị trùng!', 403);
        }
        //Bắt đầu đăng ký
        if(DangKyHocPhanModel::dangKyLopHocPhan($id_hoc_vien, $id_lop_hoc_phan, $id_dot_dang_ky))
        {
            return ToolsModel::status('', 200);
        }
        else
        {
            return ToolsModel::status('Lỗi', 500);
        }
    }
    public function getLopThucHanh(Request $r)
    {
        $data = DangKyHocPhanModel::getLopThucHanh($r->id_hoc_phan);
        return ToolsModel::status($data, 200);
    }
    public function dangKyHocPhanKem(Request $r)
    {
        //Thông số cơ bản
        $id_hoc_vien = $r->session()->get('id');
        $id_lop_hoc_phan_thuc_hanh = $r->id_lop_hoc_phan_thuc_hanh;
        $id_lop_hoc_phan_ly_thuyet = $r->id_lop_hoc_phan_ly_thuyet;
        $id_dot_dang_ky = $r->id_dot_dang_ky;
        //Thông số để kiểm tra số tín chỉ tối đa
        $id_hoc_vien = $r->session()->get('id');
        $caiDat = (new DangKyHocPhanSetting(BangDiemController::getDiemHocKi($id_hoc_vien)))->setting;
        $tinChiToiDa = value($caiDat['tinChiToiDa']);
        //Kiểm tra số tín chỉ giới hạn
        $soTinChiHocPhanThucHanh = DangKyHocPhanModel::getTinChiByLopHocPhan($id_lop_hoc_phan_thuc_hanh);
        $soTinChiHocPhanLyThuyet = DangKyHocPhanModel::getTinChiByLopHocPhan($id_lop_hoc_phan_ly_thuyet);
        $hocPhanDaDangKy = DangKyHocPhanModel::sync_hocPhanDaDangKy($id_hoc_vien, $id_dot_dang_ky);
        $soTinChiHienTai = 0;
        foreach($hocPhanDaDangKy as $item)
        {
            $soTinChiHienTai += $item->so_tin_chi;
        }
        if($soTinChiHienTai + ($soTinChiHocPhanThucHanh+$soTinChiHocPhanLyThuyet) > $tinChiToiDa)
        {
            return ToolsModel::status('Số tín chỉ tối đã đã đạt đến giới hạn!', 403);
        }
        //Kiểm tra số lượng học viên trong lớp
        if(DangKyHocPhanModel::soLuongHocVien($id_lop_hoc_phan_thuc_hanh) >= DangKyHocPhanModel::getSoLuong($id_lop_hoc_phan_thuc_hanh)
        && DangKyHocPhanModel::soLuongHocVien($id_lop_hoc_phan_ly_thuyet) >= DangKyHocPhanModel::getSoLuong($id_lop_hoc_phan_ly_thuyet))
        {
            return ToolsModel::status('Lớp học đã đầy, tải lại trang để cập nhật!', 403);
        }
        //Kiểm tra có trùng ngày giờ học hay không
        if($this->KiemTraTrungGioHoc($id_hoc_vien, $id_dot_dang_ky, $id_lop_hoc_phan_ly_thuyet) && $this->KiemTraTrungGioHoc($id_hoc_vien, $id_dot_dang_ky, $id_lop_hoc_phan_thuc_hanh))
        {
            return ToolsModel::status('Giờ học bị trùng!', 403);
        }
        //Bắt đầu đăng ký
        if(DangKyHocPhanModel::dangKyLopHocPhan($id_hoc_vien, $id_lop_hoc_phan_thuc_hanh, $id_dot_dang_ky)
        && DangKyHocPhanModel::dangKyLopHocPhan($id_hoc_vien, $id_lop_hoc_phan_ly_thuyet, $id_dot_dang_ky))
        {
            return ToolsModel::status('', 200);
        }
        else
        {
            return ToolsModel::status('Lỗi', 500);
        }
    }
    public function getHocPhanDaDangKy(Request $r)
    {
        return json_encode(DangKyHocPhanModel::getHocPhanDaDangKy($r->id_hoc_vien, $r->id_dot_dang_ky));
    }
    public function sync_hocPhanDaDangKy(Request $r)
    {
        return json_encode(DangKyHocPhanModel::sync_hocPhanDaDangKy($r->id_hoc_vien, $r->id_dot_dang_ky));
    }
    public function huyHocPhanDangKy(Request $r)
    {
        $id_hoc_vien = $r->session()->get('id');
        $id_lop_hoc_phan = $r->id_lop_hoc_phan;
        $id_dot_dang_ky = $r->id_dot_dang_ky;
        if(DangKyHocPhanModel::huyLopHocPhanDangKy($id_hoc_vien, $id_lop_hoc_phan, $id_dot_dang_ky))
        {
            return ToolsModel::status('', 200);
        }
        else
        {
            return ToolsModel::status('Lỗi', 500);
        }
    }

    public function getChiTietDotDangKy(Request $r)
    {
        return json_encode(DangKyHocPhanModel::getChiTietDotDangKy($r->id_dot_dang_ky));
    }
}
