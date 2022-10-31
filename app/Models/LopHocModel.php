<?php

namespace App\Models;

use App\Traits\LopHoc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LopHocModel extends Model
{
    use LopHoc;

    public function danhSach(){
        $sql = "SELECT id_lop_hoc,ma_lop_hoc,ten_lop_hoc, si_so,ghi_chu,lop_hoc.ngay_cap_nhat,
                        lop_hoc.id_giang_vien,ho,ten,
                       cmnd, khoa_hoc.id_khoa_hoc,nien_khoa,lop_hoc.id_nganh,lop_hoc.id_don_vi,
                        ten_don_vi,ten_nganh,lop_hoc.id_he_dao_tao,ten_he_dao_tao
                FROM lop_hoc,giang_vien,khoa_hoc,don_vi,nganh_hoc,he_dao_tao
                WHERE lop_hoc.id_giang_vien = giang_vien.id_giang_vien
                    AND lop_hoc.id_khoa_hoc = khoa_hoc.id_khoa_hoc
                    AND lop_hoc.id_don_vi = don_vi.id_don_vi
                    AND lop_hoc.id_don_vi = :id_don_vi
                    AND lop_hoc.id_nganh = nganh_hoc.id_nganh
                    AND lop_hoc.id_he_dao_tao = he_dao_tao.id_he_dao_tao
                ORDER BY ma_lop_hoc";
        $data = [
            'id_don_vi' => trim($this->id_don_vi),
        ];
        return DB::select($sql,$data);
    }

    public function getTenDonVi(){
        $sql = "SELECT ten_don_vi FROM don_vi WHERE id_don_vi =:id_don_vi";
        $data = [
            'id_don_vi' => trim($this->id_don_vi),
        ];
        return DB::selectOne($sql,$data)->ten_don_vi;
    }
    public function getSiSo(){
        $sql = "select count(*) 'count'
                from hoc_vien where id_lop_hoc = :id_lop_hoc";
        $data = [
            'id_lop_hoc' => trim($this->id_lop_hoc),
        ];
        return DB::selectOne($sql,$data);
    }

    public function setSiSo(){
        $sql = "UPDATE lop_hoc
                SET si_so = :si_so
                WHERE id_lop_hoc=:id_lop_hoc;";
        $data = [
            'si_so' => trim($this->si_so),
            'id_lop_hoc' => trim($this->id_lop_hoc),
        ];
        return DB::update($sql, $data);
    }

    public function xoaDuLieuLopHoc(){
        $sql = "delete from hoc_vien where id_lop_hoc=:id_lop_hoc";
        return DB::delete($sql, ['id_lop_hoc' => $this->id_lop_hoc]);
    }

    public function them(){
        $sql = "INSERT INTO lop_hoc (ma_lop_hoc,id_giang_vien,id_khoa_hoc,id_don_vi,id_nganh,id_he_dao_tao,ten_lop_hoc,ghi_chu)
                VALUES (:ma_lop_hoc,
                        :id_giang_vien,
                        :id_khoa_hoc,
                        :id_don_vi,
                        :id_nganh,
                        :id_he_dao_tao,
                        :ten_lop_hoc,
                        :ghi_chu)";
        $data = [
            'ma_lop_hoc' => trim($this->ma_lop_hoc),
            'id_giang_vien' => trim($this->id_giang_vien),
            'id_khoa_hoc' => trim($this->id_khoa_hoc),
            'id_don_vi' => trim($this->id_don_vi),
            'id_nganh' => trim($this->id_nganh),
            'id_he_dao_tao' => trim($this->id_he_dao_tao),
            'ten_lop_hoc' => trim($this->ten_lop_hoc),
            'ghi_chu' => trim($this->ghi_chu),

        ];
        return DB::insert($sql, $data);
    }

    public function capNhat(){
        $sql = "UPDATE lop_hoc
                SET ma_lop_hoc=:ma_lop_hoc,
                    id_giang_vien = :id_giang_vien,
                    id_khoa_hoc = :id_khoa_hoc,
                    id_don_vi = :id_don_vi,
                    id_nganh = :id_nganh,
                    id_he_dao_tao = :id_he_dao_tao,
                    ten_lop_hoc=:ten_lop_hoc,
                    ghi_chu = :ghi_chu,
                    ngay_tao =ngay_tao,
                    ngay_cap_nhat = CURRENT_TIMESTAMP
                WHERE id_lop_hoc=:id_lop_hoc;";
        $data = [
            'ma_lop_hoc' => trim($this->ma_lop_hoc),
            'id_giang_vien' => trim($this->id_giang_vien),
            'id_khoa_hoc' => trim($this->id_khoa_hoc),
            'id_don_vi' => trim($this->id_don_vi),
            'id_nganh' => trim($this->id_nganh),
            'id_he_dao_tao' => trim($this->id_he_dao_tao),
            'ten_lop_hoc' => trim($this->ten_lop_hoc),
            'ghi_chu' => trim($this->ghi_chu),
            'id_lop_hoc' => trim($this->id_lop_hoc),
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM lop_hoc WHERE id_lop_hoc = :id_lop_hoc;";
        return DB::delete($sql, ['id_lop_hoc' => $this->id_lop_hoc]);
    }

    public function tonTaiMaLopHoc(){
        $sql = "SELECT id_lop_hoc FROM lop_hoc WHERE ma_lop_hoc=:ma_lop_hoc;";
        if(DB::select($sql, ['ma_lop_hoc' => trim($this->ma_lop_hoc)]))
            return true;
        return false;
    }

    public function tonTaiMaLopHoc_capNhat(){
        $sql = "SELECT id_lop_hoc FROM lop_hoc WHERE ma_lop_hoc=:ma_lop_hoc AND id_lop_hoc != :id_lop_hoc;";
        if (DB::select($sql, ['ma_lop_hoc'=> trim($this->ma_lop_hoc),
                              'id_lop_hoc'=> trim($this->id_lop_hoc)]))
            return true;
        return false;
    }




    //Model hỗ trợ
    public function dsHeDaoTao(){
        $sql = "SELECT ten_he_dao_tao,id_he_dao_tao FROM he_dao_tao ORDER BY ten_he_dao_tao";
        return DB::select($sql);
    }

    public function dsNganhHoc(){
        $sql = "SELECT id_nganh,ten_nganh FROM nganh_hoc ORDER BY ten_nganh";
        return DB::select($sql);
    }

    public function dsNienKhoa(){
        $sql = "SELECT id_khoa_hoc,nien_khoa FROM khoa_hoc ORDER BY nien_khoa";
        return DB::select($sql);
    }

    public function dsGiangVien(){
        $sql = "SELECT id_giang_vien,ten,ho,cmnd FROM giang_vien,don_vi
                WHERE giang_vien.id_don_vi = don_vi.id_don_vi
                    AND giang_vien.id_don_vi = :id_don_vi
                ORDER BY ten";
        $data = [
            'id_don_vi' => trim($this->id_don_vi),
        ];
        return DB::select($sql,$data);
    }
    public function dsLopHoc($id_don_vi){
        $sql = "SELECT lop_hoc.ten_lop_hoc, lop_hoc.id_lop_hoc, lop_hoc.ma_lop_hoc 
                        FROM lop_hoc,don_vi 
                        WHERE lop_hoc.id_don_vi=don_vi.id_don_vi AND don_vi.id_don_vi=:id_don_vi";
        $data = [
            'id_don_vi'=>$id_don_vi
        ];
        return DB::select($sql,$data);
    }
}
