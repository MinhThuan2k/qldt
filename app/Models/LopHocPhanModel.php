<?php

namespace App\Models;

use App\Traits\LopHocPhan;
use App\Traits\DanhSachLopHocPhan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LopHocPhanModel extends Model
{
    use LopHocPhan;

    public function danhSach(){
        $sql = "SELECT id_lop_hoc_phan,
                       lop_hoc_phan.id_hoc_phan,
                        lop_hoc_phan.id_hoc_ky,
                       ten_hoc_ky,
                       ten_nam_hoc,
                       ten_hoc_phan,
                        so_luong,
                       ma_lop_hoc_phan,
                       loai_lop_hoc_phan,
                       nhap_diem,
                       lop_hoc_phan.ngay_tao,
                       lop_hoc_phan.ngay_cap_nhat
                FROM lop_hoc_phan, hoc_phan, hoc_ky, nam_hoc
                WHERE lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
                AND lop_hoc_phan.id_hoc_ky = hoc_ky.id_hoc_ky
                AND hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc
                ORDER BY ma_lop_hoc_phan;";
        return DB::select($sql);
    }

    public function them(){
        $sql = "INSERT INTO lop_hoc_phan (id_hoc_phan, ma_lop_hoc_phan, loai_lop_hoc_phan, nhap_diem, id_hoc_ky, so_luong)
                VALUES (:id_hoc_phan,:ma_lop_hoc_phan,:loai_lop_hoc_phan,:nhap_diem,:id_hoc_ky, :so_luong);";
        $data = [
            'id_hoc_phan' => trim($this->id_hoc_phan),
            'ma_lop_hoc_phan' => trim($this->ma_lop_hoc_phan),
            'loai_lop_hoc_phan' => trim($this->loai_lop_hoc_phan),
            'nhap_diem' => trim($this->nhap_diem),
            'id_hoc_ky' => trim($this->id_hoc_ky),
            'so_luong' => trim($this->so_luong),
        ];
        return DB::insert($sql, $data);
    }


    public function capNhat(){
        $sql = "UPDATE lop_hoc_phan
                SET id_hoc_phan=:id_hoc_phan,
                    ma_lop_hoc_phan=:ma_lop_hoc_phan,
                    loai_lop_hoc_phan=:loai_lop_hoc_phan,
                    ngay_tao=ngay_tao,
                    ngay_cap_nhat=CURRENT_TIMESTAMP,
                    nhap_diem=:nhap_diem,
                    so_luong=:so_luong
                WHERE id_lop_hoc_phan=:id_lop_hoc_phan;";
        $data = [
            'id_hoc_phan' => trim($this->id_hoc_phan),
            'ma_lop_hoc_phan' => trim($this->ma_lop_hoc_phan),
            'loai_lop_hoc_phan' => trim($this->loai_lop_hoc_phan),
            'nhap_diem' => trim($this->nhap_diem),
            'id_lop_hoc_phan' => trim($this->id_lop_hoc_phan),
            'so_luong' => trim($this->so_luong)
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM lop_hoc_phan WHERE id_lop_hoc_phan=:id_lop_hoc_phan;";
        return DB::delete($sql, ['id_lop_hoc_phan' => $this->id_lop_hoc_phan]);
    }

    public function tonTaiMaLopHocPhan(){
        $sql = "SELECT id_lop_hoc_phan FROM lop_hoc_phan WHERE ma_lop_hoc_phan =:ma_lop_hoc_phan;";
        if(DB::select($sql, ['ma_lop_hoc_phan' => trim($this->ma_lop_hoc_phan)]))
            return true;
        return false;
    }

    public function tonTaiMaLopHocPhan_capNhat(){
        $sql = "SELECT id_lop_hoc_phan FROM lop_hoc_phan WHERE ma_lop_hoc_phan =:ma_lop_hoc_phan AND id_lop_hoc_phan !=:id_lop_hoc_phan;";
        if (DB::select($sql, ['ma_lop_hoc_phan'=> trim($this->ma_lop_hoc_phan),
                              'id_lop_hoc_phan'=> trim($this->id_lop_hoc_phan)]))
            return true;
        return false;
    }

    public function dsExportCSV($id_hoc_ky){
        $sql = "SELECT ten_hoc_phan, ma_lop_hoc_phan
                FROM hoc_phan, lop_hoc_phan
                WHERE hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan
                AND lop_hoc_phan.id_hoc_ky = :id_hoc_ky;";
        $data = [
            'id_hoc_ky'=>$id_hoc_ky,
        ];
        return DB::select($sql, $data);
    }



    // Model danh sách lớp học phần
    public function danhSachChiTiet(){
        $sql = "SELECT danh_sach_lop_hoc_phan.id_hoc_vien,
                       ho,ten,
                       danh_sach_lop_hoc_phan.id_lop_hoc_phan,
                       ma_lop_hoc_phan,
                       ten_hoc_phan,
                       danh_sach_lop_hoc_phan.ngay_tao,
                       danh_sach_lop_hoc_phan.ngay_cap_nhat,
                       diem_10, diem_40, diem_50,
                       lop_hoc.ten_lop_hoc,
                        lop_hoc.ma_lop_hoc
                FROM danh_sach_lop_hoc_phan, hoc_vien, lop_hoc_phan, hoc_phan, lop_hoc
                WHERE danh_sach_lop_hoc_phan.id_lop_hoc_phan = :id_lop_hoc_phan
                AND hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc
                AND hoc_vien.id_hoc_vien = danh_sach_lop_hoc_phan.id_hoc_vien
                AND danh_sach_lop_hoc_phan.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
                AND lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
                ORDER BY ten;";
        $data = [
            'id_lop_hoc_phan' => trim($this->id_lop_hoc_phan),
        ];
        return DB::select($sql, $data);
    }


    public function chiTiet(){
        $sql = "SELECT id_lop_hoc_phan, ma_lop_hoc_phan, ten_hoc_phan
                FROM lop_hoc_phan, hoc_phan
                WHERE id_lop_hoc_phan= :id_lop_hoc_phan
                AND lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan;";
        $data = [
            'id_lop_hoc_phan' => trim($this->id_lop_hoc_phan),
        ];
        return DB::selectOne($sql, $data);
    }

    public function themChiTiet(){
        $sql = "INSERT INTO danh_sach_lop_hoc_phan (id_hoc_vien, id_lop_hoc_phan, diem_10, diem_40, diem_50)
                VALUES (:id_hoc_vien,:id_lop_hoc_phan,:diem_10,:diem_40,:diem_50);";
        $data = [
            'id_hoc_vien' => trim($this->id_hoc_vien),
            'id_lop_hoc_phan' => trim($this->id_lop_hoc_phan),
            'diem_10' => trim($this->diem_10),
            'diem_40' => trim($this->diem_40),
            'diem_50' => trim($this->diem_50),
        ];
        return DB::insert($sql, $data);
    }

    public function capNhatChiTiet(){
        $sql = "UPDATE danh_sach_lop_hoc_phan
                SET diem_10=:diem_10,
                    diem_40=:diem_40,
                    diem_50=:diem_50,
                    ngay_cap_nhat=CURRENT_TIMESTAMP,
                    ngay_tao=ngay_tao
                WHERE id_hoc_vien= :id_hoc_vien
                AND id_lop_hoc_phan= :id_lop_hoc_phan;";
        $data = [
            'diem_10' => trim($this->diem_10),
            'diem_40' => trim($this->diem_40),
            'diem_50' => trim($this->diem_50),
            'id_hoc_vien' => trim($this->id_hoc_vien),
            'id_lop_hoc_phan' => trim($this->id_lop_hoc_phan),
        ];
        return DB::update($sql, $data);
    }

    public function xoaChiTiet(){
        $sql = "DELETE FROM danh_sach_lop_hoc_phan
                WHERE id_lop_hoc_phan=:id_lop_hoc_phan
                AND id_hoc_vien=:id_hoc_vien;";
        return DB::delete($sql,
            [
                'id_lop_hoc_phan' => $this->id_lop_hoc_phan,
                'id_hoc_vien' => $this->id_hoc_vien,
            ]);
    }

    public function tonTaiHocVien(){
        $sql = "SELECT id_hoc_vien FROM danh_sach_lop_hoc_phan
                WHERE id_hoc_vien=:id_hoc_vien
                AND id_lop_hoc_phan=:id_lop_hoc_phan;";
        if(DB::select($sql,
            [
                'id_hoc_vien' => trim($this->id_hoc_vien),
                'id_lop_hoc_phan' => trim($this->id_lop_hoc_phan),
            ]))
            return true;
        return false;
    }
    public static function timLopByMaLop($id)
    {
        $sql = "select id_lop_hoc_phan from lop_hoc_phan where ma_lop_hoc_phan = :ma_lop_hoc_phan";
        $data = [
            'ma_lop_hoc_phan'=>$id,
        ];
        return DB::selectOne($sql, $data)->id_lop_hoc_phan;
    }











    //Model hỗ trợ


    public function dsHocPhan(){
        $sql = "SELECT ten_hoc_phan,id_hoc_phan,ma_hoc_phan FROM hoc_phan ORDER BY ten_hoc_phan;";
        return DB::select($sql);
    }

    public function dsHocKy(){
        $sql = "SELECT id_hoc_ky, ma_hoc_ky, ten_hoc_ky, ten_nam_hoc FROM hoc_ky, nam_hoc
                WHERE hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc;";
        return DB::select($sql);
    }

    public function dsHocVien(){
        $sql = "SELECT id_hoc_vien,
                       ten_lop_hoc,
                       ten_chuyen_nganh,
                       ho,
                       ten,
                       email,
                       sdt,
                       dia_chi,
                       cmnd,
                       sdt_gd,
                       trang_thai
                FROM hoc_vien,chuyen_nganh,lop_hoc
                WHERE hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc
                AND hoc_vien.id_chuyen_nganh = chuyen_nganh.id_chuyen_nganh
                ORDER BY ten;";
        return DB::select($sql);
    }

    public function getMaHocKy($id_hoc_ky){
        $sql = "SELECT ma_hoc_ky FROM hoc_ky WHERE id_hoc_ky = :id_hoc_ky;";
        $data = [
            'id_hoc_ky'=>$id_hoc_ky,
        ];
        return DB::selectOne($sql, $data)->ma_hoc_ky;
    }


}
