<?php

namespace App\Models;

use App\Traits\VanBang;
use App\Traits\LopHoc;
use App\Traits\HocVien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VanBangModel extends Model
{
    use VanBang, LopHoc, HocVien;
    public function dsVanBang($id_don_vi){
        $sql="SELECT DISTINCT
        van_bang.id_van_bang,
        van_bang.ngoai_ngu,
        van_bang.quoc_phong,
        van_bang.tin_hoc,
        van_bang.ky_nang_nghe,
        van_bang.ngay_cap,
        hoc_vien.trang_thai,
        hoc_vien.ho,
        hoc_vien.ten,
        hoc_vien.id_hoc_vien
        FROM van_bang, hoc_vien,don_vi,lop_hoc
        where van_bang.id_hoc_vien=hoc_vien.id_hoc_vien 
        and hoc_vien.id_lop_hoc=lop_hoc.id_lop_hoc 
        and lop_hoc.id_don_vi=don_vi.id_don_vi 
        AND  don_vi.id_don_vi=:id_don_vi ";
        $data = [
            'id_don_vi'=>$id_don_vi
        ];
        return DB::select($sql,$data);
    }
    public function dsVanBangTheoLop($id_lop_hoc){
                $sql="SELECT DISTINCT
                van_bang.id_van_bang,
                van_bang.ngoai_ngu,
                van_bang.quoc_phong,
                van_bang.tin_hoc,
                van_bang.ky_nang_nghe,
                van_bang.ngay_cap,
                hoc_vien.trang_thai,
                hoc_vien.ho,
                hoc_vien.ten,
                hoc_vien.id_hoc_vien,
                lop_hoc.ma_lop_hoc,
                lop_hoc.ten_lop_hoc
        FROM van_bang, hoc_vien,lop_hoc
        where van_bang.id_hoc_vien=hoc_vien.id_hoc_vien 
        AND hoc_vien.id_lop_hoc=lop_hoc.id_lop_hoc 
        AND lop_hoc.id_lop_hoc= :id_lop_hoc";
         $data = [
            'id_lop_hoc'=>$id_lop_hoc
        ];
        return DB::select($sql, $data);
    }
    public function them(){
        //  if($this->id_van_bang != ""){
            $sql = "INSERT INTO `van_bang`(`id_van_bang`, `ngoai_ngu`, `quoc_phong`, `tin_hoc`, `ky_nang_nghe`, `ngay_cap`, `trang_thai`, `id_hoc_vien`, `ghi_chu`)
                                    VALUES (:id_van_bang, :ngoai_ngu, :quoc_phong, :tin_hoc, :ky_nang_nghe :ngay_cap, :trang_thai, :id_hoc_vien, :ghi_chu)";
        // }else
        //     $sql =  $sql = "INSERT INTO `van_bang`( `ngoai_ngu`, `quoc_phong`, `tin_hoc`, `ngay_cap`, `trang_thai`, `id_hoc_vien`, `ghi_chu`)
        //                              VALUES (:ngoai_ngu, :quoc_phong, :tin_hoc, :ngay_cap, :trang_thai, :id_hoc_vien, :ghi_chu)";
      $data = [
            'id_van_bang' => trim($this->id_van_bang),
            'ngoai_ngu' => trim($this->ngoai_ngu),
            'quoc_phong' => trim($this->quoc_phong),
            'tin_hoc' => trim($this->tin_hoc),
            'ky_nang_nghe' => trim($this->ky_nang_nghe),
            'ngay_cap' => trim($this->ngay_cap),
            'trang_thai' => trim($this->trang_thai),
            'id_hoc_vien' => trim($this->id_hoc_vien),
            'ghi_chu' => trim($this->ghi_chu)
        ];
        return DB::insert($sql, $data);
    }
    public function sua(){
       
            $sql = "UPDATE `van_bang` 
                    SET `ngoai_ngu`=:ngoai_ngu,
                        `quoc_phong`=:quoc_phong,
                        `tin_hoc`=:tin_hoc,
                        `ky_nang_nghe`=:ky_nang_nghe,
                        `ngay_cap`=:ngay_cap,
                        `trang_thai`=:trang_thai,
                        `id_hoc_vien`=:id_hoc_vien,
                        `ghi_chu`=:ghi_chu 
                    WHERE id_van_bang=:id_van_bang";
      $data = [
            'id_van_bang' => trim($this->id_van_bang),
            'ngoai_ngu' => trim($this->ngoai_ngu),
            'quoc_phong' => trim($this->quoc_phong),
            'tin_hoc' => trim($this->tin_hoc),
            'ky_nang_nghe' => trim($this->ky_nang_nghe),
            'ngay_cap' => trim($this->ngay_cap),
            'trang_thai' => trim($this->trang_thai),
            'id_hoc_vien' => trim($this->id_hoc_vien),
            'ghi_chu' => trim($this->ghi_chu)
        ];
        return DB::insert($sql, $data);
    }
    public function xoa(){
       
        $sql = "DELETE FROM `van_bang` WHERE id_van_bang=:id_van_bang";
        $data = [
                'id_van_bang' => trim($this->id_van_bang),
            ];
            return DB::insert($sql, $data);
    }

    public function timkiemvanbang($id_hoc_vien){
        $sql = "SELECT * FROM `van_bang` WHERE van_bang.id_hoc_vien=:id_hoc_vien ";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
            return DB::select($sql,$data);
    }

}
