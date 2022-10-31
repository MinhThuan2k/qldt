<?php

namespace App\Models;


use App\Traits\DotDangKy;
use App\Traits\HocKy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DotDangKyModel extends Model
{
    use DotDangKy, HocKy;


    public function dsDotDangKy(){
        $sql = "select id_dot_dang_ky, ten_dot_dang_ky, dot_dang_ky.id_hoc_ky, thoi_gian_mo, thoi_gian_dong, thoi_gian_tao, nam_hoc.ten_nam_hoc, hoc_ky.ten_hoc_ky
                from dot_dang_ky, nam_hoc, hoc_ky
                where dot_dang_ky.id_hoc_ky = hoc_ky.id_hoc_ky
                and hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc
                order by ten_nam_hoc;";
        return DB::select($sql);
    }

    public function dsHocKy(){
        $sql = "select hoc_ky.id_hoc_ky, ten_hoc_ky, ten_nam_hoc
                from hoc_ky, nam_hoc
                where hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc;";
        return DB::select($sql);
    }


    public  function them(){
        $sql = "insert into dot_dang_ky( ten_dot_dang_ky, id_hoc_ky, thoi_gian_mo, thoi_gian_dong, thoi_gian_tao)
                values (:ten_dot_dang_ky, :id_hoc_ky, :thoi_gian_mo, :thoi_gian_dong, CURRENT_TIMESTAMP)";
        $data = [
            'ten_dot_dang_ky'=>$this->ten_dot_dang_ky,
            'id_hoc_ky'=>$this->id_hoc_ky,
            'thoi_gian_mo'=>$this->thoi_gian_mo,
            'thoi_gian_dong'=>$this->thoi_gian_dong,
        ];
        return DB::insert($sql, $data);
    }

    public function capNhat(){
        $sql = "update dot_dang_ky
                set ten_dot_dang_ky = :ten_dot_dang_ky,
                    id_hoc_ky = :id_hoc_ky,
                    thoi_gian_mo = :thoi_gian_mo,
                    thoi_gian_dong = :thoi_gian_dong
                where id_dot_dang_ky = :id_dot_dang_ky;";
        $data = [

            'ten_dot_dang_ky' => $this->ten_dot_dang_ky,
            'id_hoc_ky' => $this->id_hoc_ky,
            'thoi_gian_mo' => $this->thoi_gian_mo,
            'thoi_gian_dong' => $this->thoi_gian_dong,
            'id_dot_dang_ky' => $this->id_dot_dang_ky,
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql =  "delete from dot_dang_ky where id_dot_dang_ky = :id_dot_dang_ky;";
        return DB::delete($sql,['id_dot_dang_ky'=>$this->id_dot_dang_ky]);
    }

}
