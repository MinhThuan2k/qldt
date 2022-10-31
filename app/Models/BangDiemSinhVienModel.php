<?php

namespace App\Models;

use App\Traits\DanhSachLopHocPhan;
use App\Traits\HocKy;
use App\Traits\HocPhan;
use App\Traits\LopHocPhan;
use App\Traits\NamHoc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BangDiemSinhVienModel extends Model
{
    use HocPhan, DanhSachLopHocPhan, LopHocPhan, HocKy, NamHoc;

    public function bangDiemSV($id_hoc_vien)
    {
        $sql = "SELECT  DISTINCT   danh_sach_lop_hoc_phan.id_hoc_vien,
        danh_sach_lop_hoc_phan.id_lop_hoc_phan,
        danh_sach_lop_hoc_phan.diem_10,
        danh_sach_lop_hoc_phan.diem_40,
        danh_sach_lop_hoc_phan.diem_50,
        hoc_phan.ma_hoc_phan,
        hoc_phan.ten_hoc_phan,
        hoc_phan.tin_chi_lt,
        hoc_phan.tin_chi_th,
        lop_hoc_phan.id_hoc_ky

FROM danh_sach_lop_hoc_phan, lop_hoc_phan, hoc_phan,hoc_vien
WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan AND
danh_sach_lop_hoc_phan.id_hoc_vien=hoc_vien.id_hoc_vien 
                AND lop_hoc_phan.id_hoc_phan=hoc_phan.id_hoc_phan
";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::select($sql, $data);
    }

    public function dsHocKy($id_hoc_vien)
    {
        $sql = "SELECT  DISTINCT
                 hoc_ky.id_hoc_ky,
                 hoc_ky.ten_hoc_ky,
                 nam_hoc.ma_nam_hoc
FROM danh_sach_lop_hoc_phan, lop_hoc_phan, hoc_phan, hoc_ky, nam_hoc
WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and  hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan
and  hoc_ky.id_hoc_ky = lop_hoc_phan.id_hoc_ky
and  nam_hoc.id_nam_hoc = hoc_ky.id_nam_hoc
ORDER BY hoc_ky.id_hoc_ky ASC ;
";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::select($sql, $data);
    }


    // Lọc bảng điểm theo học kỳ

    public function dsDiemHocKy($id_hoc_vien,$id_hoc_ky)
    {
        $sql = "SELECT  DISTINCT
                 hoc_ky.id_hoc_ky,
                 hoc_ky.ten_hoc_ky,
                 nam_hoc.ma_nam_hoc
                FROM danh_sach_lop_hoc_phan, lop_hoc_phan, hoc_phan, hoc_ky, nam_hoc
                WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
                and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
                and  hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan
                and  hoc_ky.id_hoc_ky = :id_hoc_ky
                and  nam_hoc.id_nam_hoc = hoc_ky.id_nam_hoc
                ORDER BY hoc_ky.id_hoc_ky ASC ;
";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
            'id_hoc_ky'=>$id_hoc_ky
        ];
        return DB::select($sql, $data);
    }
    public function dsAllDiem($id_hoc_vien)
    {
        $sql = "SELECT  DISTINCT
                 hoc_ky.id_hoc_ky,
                 hoc_ky.ten_hoc_ky,
                 nam_hoc.ma_nam_hoc
                    FROM danh_sach_lop_hoc_phan, lop_hoc_phan, hoc_phan, hoc_ky, nam_hoc
                    WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
                    and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
                    and  hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan
                    and  nam_hoc.id_nam_hoc = hoc_ky.id_nam_hoc
                    ORDER BY hoc_ky.id_hoc_ky ASC ;
";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
        ];
        return DB::select($sql, $data);
    }
}
