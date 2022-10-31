<?php

namespace App\Models;


use App\Traits\DanhSachLopHocPhan;
use App\Traits\HocKy;
use App\Traits\HocPhan;
use App\Traits\HocPhi;
use App\Traits\LopHocPhan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TraCuuHocPhiModel extends Model
{
    use HocKy, DanhSachLopHocPhan, LopHocPhan, HocPhi, HocPhan;
    public function hocPhiSV($id_hoc_vien, $id_hoc_ky)
    {
        $sql = "SELECT DISTINCT
        hoc_ky.id_hoc_ky,
        danh_sach_lop_hoc_phan.id_hoc_vien,
        hoc_phi.id_hoc_phi,
        danh_sach_lop_hoc_phan.id_lop_hoc_phan,
        lop_hoc_phan.id_hoc_phan,
        hoc_phan.ma_hoc_phan,
        hoc_phan.ten_hoc_phan,
        lop_hoc_phan.ma_lop_hoc_phan,
        hoc_phan.tin_chi_lt,
        hoc_phan.tin_chi_th,
        hoc_phi.ly_thuyet,
        hoc_phi.thuc_hanh

FROM danh_sach_lop_hoc_phan, lop_hoc_phan, hoc_phan, hoc_ky, hoc_phi
WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan
and hoc_ky.id_hoc_ky = :id_hoc_ky
and hoc_phi.id_hoc_ky = hoc_ky.id_hoc_ky
";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
            'id_hoc_ky'=>$id_hoc_ky
        ];
        return DB::select($sql, $data);
    }
    public function chitietSV($id_hoc_vien, $id_hoc_ky)
    {
        $sql = "SELECT DISTINCT
                hoc_vien.id_hoc_vien,
                hoc_vien.ho,
                hoc_vien.ten,
                lop_hoc.ma_lop_hoc,
                hoc_ky.ten_hoc_ky,
                nam_hoc.ma_nam_hoc
                FROM danh_sach_lop_hoc_phan, hoc_vien, lop_hoc, hoc_ky, nam_hoc, lop_hoc_phan
                WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
                and hoc_vien.id_hoc_vien = danh_sach_lop_hoc_phan.id_hoc_vien
                and lop_hoc.id_lop_hoc = hoc_vien.id_lop_hoc
                and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
                and hoc_ky.id_hoc_ky = :id_hoc_ky
                and nam_hoc.id_nam_hoc = hoc_ky.id_hoc_ky
";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
            'id_hoc_ky'=>$id_hoc_ky
        ];
        return DB::select($sql, $data);
    }
    public function tongtcSV($id_hoc_vien, $id_hoc_ky)
    {
        $sql = "SELECT DISTINCT
        SUM(hoc_phan.tin_chi_lt) + SUM(hoc_phan.tin_chi_th) as 'tong',
        SUM((hoc_phan.tin_chi_lt * hoc_phi.ly_thuyet) + (hoc_phan.tin_chi_th * hoc_phi.thuc_hanh)) as 'tongtien'
            FROM danh_sach_lop_hoc_phan, lop_hoc_phan, hoc_phan, hoc_ky, hoc_phi
            WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
            and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
            and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan
            and hoc_ky.id_hoc_ky = :id_hoc_ky
            and hoc_phi.id_hoc_ky = hoc_ky.id_hoc_ky
";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
            'id_hoc_ky'=>$id_hoc_ky
        ];
        return DB::select($sql, $data);
    }

}
