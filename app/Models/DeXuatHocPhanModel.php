<?php

namespace App\Models;

use App\Traits\DeXuatHocPhan;
use App\Traits\DotDangKy;
use App\Traits\HocPhan;
use App\Traits\LopHoc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeXuatHocPhanModel extends Model
{
    use HocPhan, DeXuatHocPhan, LopHoc,DotDangKy;
    public function dsDeXuatHocPhan(){
        $sql = "select * from dot_dang_ky, de_xuat_hoc_phan, lop_hoc, hoc_phan
where dot_dang_ky.id_dot_dang_ky=de_xuat_hoc_phan.id_dot_dang_ky
and de_xuat_hoc_phan.id_hoc_phan=hoc_phan.id_hoc_phan
and de_xuat_hoc_phan.id_lop_chuyen_nganh=lop_hoc.id_lop_hoc order by dot_dang_ky.id_dot_dang_ky desc";
        return DB::select($sql);
    }
    public function dsDotDangKy(){
        $sql = "select * from dot_dang_ky";
        return DB::select($sql);
    }
    public function dsHocPhan(){
        $sql = "select * from hoc_phan";
        return DB::select($sql);
    }
    public function dsLopHoc(){
        $sql = "select * from lop_hoc";
        return DB::select($sql);
    }
    public  function them(){
        $sql = "insert into de_xuat_hoc_phan
    (id_dot_dang_ky, id_hoc_phan,id_lop_chuyen_nganh, ghichu)
    values (:id_dot_dang_ky, :id_hoc_phan,:id_lop_chuyen_nganh, :ghichu)";
        $data = [
            'id_dot_dang_ky'=>$this->id_dot_dang_ky,
            'id_hoc_phan'=>$this->id_hoc_phan,
            'id_lop_chuyen_nganh'=>$this->id_lop_chuyen_nganh,
            'ghichu'=>$this->ghichu
        ];
        return DB::insert($sql, $data);
    }
    public function capNhat(){
        $sql = "UPDATE de_xuat_hoc_phan SET id_dot_dang_ky=:id_dot_dang_ky,
                       id_hoc_phan=:id_hoc_phan,
                       id_lop_chuyen_nganh=:id_lop_chuyen_nganh,
                       ghichu=:ghichu
                WHERE id_de_xuat_hoc_phan=:id_de_xuat_hoc_phan;";
        $data = [
            'id_dot_dang_ky'=>$this->id_dot_dang_ky,
            'id_hoc_phan'=>$this->id_hoc_phan,
            'id_lop_chuyen_nganh'=>$this->id_lop_chuyen_nganh,
            'ghichu'=>$this->ghichu,
            'id_de_xuat_hoc_phan'=>$this->id_de_xuat_hoc_phan
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql =  "Delete from de_xuat_hoc_phan where id_de_xuat_hoc_phan=:id_de_xuat_hoc_phan";
        return DB::delete($sql,['id_de_xuat_hoc_phan'=>$this->id_de_xuat_hoc_phan]);
    }

}
