<?php

namespace App\Models;

use App\Traits\ChuyenNganh;
use App\Traits\HeDaoTao;
use App\Traits\HocKy;
use App\Traits\HocPhi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HocPhiModel extends Model
{
    use HocPhi, ChuyenNganh, HocKy, HeDaoTao;


    public function dsHocPhi(){
        $sql = "SELECT DISTINCT
                                he_dao_tao.ten_he_dao_tao,
                                hoc_ky.ten_hoc_ky,
                                chuyen_nganh.ten_chuyen_nganh,
                                hoc_phi.ly_thuyet,
                                hoc_phi.thuc_hanh,
                                hoc_phi.trang_thai,
                                hoc_phi.ngay_cap_nhat,
                                hoc_phi.id_hoc_phi,
                                hoc_phi.id_he_dao_tao,
                                hoc_phi.id_chuyen_nganh,
                                hoc_phi.id_hoc_ky,
                                hoc_phi.ngay_tao,
                                hoc_phi.id_chuyen_nganh
        FROM hoc_phi, he_dao_tao, hoc_ky, chuyen_nganh
        where hoc_phi.id_hoc_phi=hoc_phi.id_hoc_phi
        and chuyen_nganh.id_chuyen_nganh = hoc_phi.id_chuyen_nganh
        and hoc_ky.id_hoc_ky = hoc_phi.id_hoc_ky
        and he_dao_tao.id_he_dao_tao = hoc_phi.id_he_dao_tao";
        return DB::select($sql);
    }
    public function dsHeDaoTao(){
        $sql = "SELECT * FROM he_dao_tao";
        return DB::select($sql);
    }
    public function dsHocKy(){
        $sql = "SELECT * FROM hoc_ky";
        return DB::select($sql);
    }
    public function dsChuyenNganh(){
        $sql = "SELECT * FROM chuyen_nganh";
        return DB::select($sql);
    }


    public  function themHP(){
        $sql = "insert into hoc_phi (id_he_dao_tao, id_hoc_ky, id_chuyen_nganh, ly_thuyet, thuc_hanh, trang_thai)
                values (:id_he_dao_tao,:id_hoc_ky,:id_chuyen_nganh,:ly_thuyet,:thuc_hanh,:trang_thai)";
        $data = [
            'id_he_dao_tao'=>$this->id_he_dao_tao,
            'id_hoc_ky'=>$this->id_hoc_ky,
            'id_chuyen_nganh'=>$this->id_chuyen_nganh,
            'ly_thuyet'=>$this->ly_thuyet,
            'thuc_hanh'=>$this->thuc_hanh,
            'trang_thai'=>$this->trang_thai
        ];
        return DB::insert($sql, $data);
    }

    public function capNhat(){
        $sql = "UPDATE hoc_phi SET id_he_dao_tao=:id_he_dao_tao,
                       id_hoc_ky=:id_hoc_ky,
                       id_chuyen_nganh=:id_chuyen_nganh,
                       ly_thuyet=:ly_thuyet,
                       thuc_hanh=:thuc_hanh,
                       ngay_cap_nhat=CURRENT_TIMESTAMP,
                       trang_thai=:trang_thai
                WHERE id_hoc_phi=:id_hoc_phi;";
        $data = [
            'id_he_dao_tao' => $this->id_he_dao_tao,
            'id_hoc_ky' => $this->id_hoc_ky,
            'id_chuyen_nganh' => $this->id_chuyen_nganh,
            'ly_thuyet' => $this->ly_thuyet,
            'thuc_hanh' => $this->thuc_hanh,
            'trang_thai' => $this->trang_thai,
            'id_hoc_phi' => $this->id_hoc_phi
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql =  "Delete from hoc_phi where id_hoc_phi=:id_hoc_phi;";
        return DB::delete($sql,['id_hoc_phi'=>$this->id_hoc_phi]);
    }

}
