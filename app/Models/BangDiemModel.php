<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class BangDiemModel extends Model
{
    public static function get_bang_diem($id_hoc_vien, $id_hoc_ky)
    {
        $sql = "select ho, ten, email, ten_hoc_ky, ten_lop_hoc, ma_hoc_phan, ma_lop_hoc_phan, ten_nam_hoc, ten_hoc_phan, tin_chi_th, tin_chi_lt, diem_10, diem_40, diem_50
from hoc_vien, danh_sach_lop_hoc_phan, lop_hoc_phan, hoc_ky, hoc_phan, nam_hoc, lop_hoc
where hoc_vien.id_hoc_vien = danh_sach_lop_hoc_phan.id_hoc_vien and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and hoc_ky.id_hoc_ky = lop_hoc_phan.id_hoc_ky and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan and hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc
  and lop_hoc.id_lop_hoc = hoc_vien.id_lop_hoc
and hoc_ky.id_hoc_ky = :id_hoc_ky and hoc_vien.id_hoc_vien = :id_hoc_vien";
        $data = [
            'id_hoc_ky'=>$id_hoc_ky,
            'id_hoc_vien'=>$id_hoc_vien,
        ];
        return DB::select($sql, $data);
    }


    public function get_diem_hoc_ky()
    {
        $sql = "select tin_chi_th, tin_chi_lt, diem_10, diem_40, diem_50
from hoc_vien, danh_sach_lop_hoc_phan, lop_hoc_phan, hoc_ky, hoc_phan, nam_hoc, lop_hoc
where hoc_vien.id_hoc_vien = danh_sach_lop_hoc_phan.id_hoc_vien and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and hoc_ky.id_hoc_ky = lop_hoc_phan.id_hoc_ky and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan and hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc
  and lop_hoc.id_lop_hoc = hoc_vien.id_lop_hoc
and hoc_ky.id_hoc_ky <(select max(hoc_ky.id_hoc_ky) from hoc_ky) and hoc_vien.id_hoc_vien = :id_hoc_vien;";
        $data = [
            'id_hoc_vien'=>trim($this->id_hoc_vien),
        ];
        return DB::select($sql, $data);
    }
}
