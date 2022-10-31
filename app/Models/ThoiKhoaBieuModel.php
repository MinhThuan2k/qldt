<?php

namespace App\Models;

use App\Traits\GiangVien;
use App\Traits\HocKy;
use App\Traits\HocPhan;
use App\Traits\LopHocPhan;
use App\Traits\Phong;
use App\Traits\ThoiGian;
use App\Traits\ThoiKhoaBieu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ThoiKhoaBieuModel extends Model
{
    use ThoiKhoaBieu, Phong, GiangVien, ThoiGian, HocPhan, LopHocPhan, HocKy;

    //Lấy danh sách thời khóa biểu theo học phần
    public function dsTKB(){
        $sql = "SELECT id_thoi_khoa_bieu,
                        thoi_khoa_bieu.id_phong,
                       thoi_khoa_bieu.id_lop_hoc_phan,
                       ma_lop_hoc_phan,
                       ten_hoc_phan,
                       ten_phong,
                       thoi_khoa_bieu.id_thoi_gian_hoc,
                       tiet_ca,
                       thoi_khoa_bieu.id_giang_vien,
                       ho,
                       ten,
                       thoi_khoa_bieu.id_hoc_ky,
                       phan_cong_day,
                       ngay_hoc
                FROM thoi_khoa_bieu, lop_hoc_phan, hoc_phan, phong, thoi_gian, giang_vien
                WHERE thoi_khoa_bieu.id_lop_hoc_phan = :id_lop_hoc_phan
                AND thoi_khoa_bieu.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
                AND lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
                AND thoi_khoa_bieu.id_phong = phong.id_phong
                AND thoi_khoa_bieu.id_thoi_gian_hoc = thoi_gian.id_thoi_gian_hoc
                AND thoi_khoa_bieu.id_giang_vien = giang_vien.id_giang_vien
                ORDER BY ngay_hoc;";
        $data = [
            'id_lop_hoc_phan' => trim($this->id_lop_hoc_phan),
        ];
        return DB::select($sql, $data);
    }

    //Lấy danh sách tất cả các thời khóa biểu
    public function danhSach(){
        $sql = "SELECT id_thoi_khoa_bieu,
                        thoi_khoa_bieu.id_phong,
                       thoi_khoa_bieu.id_lop_hoc_phan,
                       ma_lop_hoc_phan,
                       ten_hoc_phan,
                       ten_phong,
                       thoi_khoa_bieu.id_thoi_gian_hoc,
                       tiet_ca,
                       thoi_khoa_bieu.id_giang_vien,
                       ho,
                       ten,
                       thoi_khoa_bieu.id_hoc_ky,
                       phan_cong_day,
                       ngay_hoc
                FROM thoi_khoa_bieu, lop_hoc_phan, hoc_phan, phong, thoi_gian, giang_vien
                WHERE thoi_khoa_bieu.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
                AND lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
                AND thoi_khoa_bieu.id_phong = phong.id_phong
                AND thoi_khoa_bieu.id_thoi_gian_hoc = thoi_gian.id_thoi_gian_hoc
                AND thoi_khoa_bieu.id_giang_vien = giang_vien.id_giang_vien
                ORDER BY ngay_hoc;";
        return DB::select($sql);
    }

    public function themTKB(){
        $sql = "INSERT INTO thoi_khoa_bieu (id_phong, id_thoi_gian_hoc, id_giang_vien, id_hoc_ky, id_lop_hoc_phan, ngay_hoc, phan_cong_day)
                VALUES (:id_phong, :id_thoi_gian_hoc, :id_giang_vien, :id_hoc_ky, :id_lop_hoc_phan, :ngay_hoc, :phan_cong_day);";
        $data = [
            'id_phong' => trim($this->id_phong),
            'id_thoi_gian_hoc' => trim($this->id_thoi_gian_hoc),
            'id_giang_vien' => trim($this->id_giang_vien),
            'id_hoc_ky' => trim($this->id_hoc_ky),
            'id_lop_hoc_phan' => trim($this->id_lop_hoc_phan),
            'ngay_hoc' => trim($this->ngay_hoc),
            'phan_cong_day' => trim($this->phan_cong_day),
        ];
        return DB::insert($sql, $data);
    }


    public function capNhatTKB(){
        $sql = "UPDATE thoi_khoa_bieu
                SET id_phong=:id_phong,
                    id_thoi_gian_hoc=:id_thoi_gian_hoc,
                    id_giang_vien=:id_giang_vien,
                    id_hoc_ky=:id_hoc_ky,
                    ngay_hoc=:ngay_hoc,
                    phan_cong_day=:phan_cong_day,
                    ngay_cap_nhat=current_timestamp,
                    ngay_tao = ngay_tao
                WHERE id_thoi_khoa_bieu=:id_thoi_khoa_bieu;";
        $data = [
            'id_phong' => trim($this->id_phong),
            'id_thoi_gian_hoc' => trim($this->id_thoi_gian_hoc),
            'id_giang_vien' => trim($this->id_giang_vien),
            'id_hoc_ky' => trim($this->id_hoc_ky),
            'ngay_hoc' => trim($this->ngay_hoc),
            'phan_cong_day' => trim($this->phan_cong_day),
            'id_thoi_khoa_bieu' => trim($this->id_thoi_khoa_bieu),
        ];
        return DB::update($sql, $data);
    }

    public function xoaTKB(){
        $sql = "DELETE FROM thoi_khoa_bieu WHERE id_thoi_khoa_bieu=:id_thoi_khoa_bieu;";
        return DB::delete($sql, ['id_thoi_khoa_bieu' => $this->id_thoi_khoa_bieu]);
    }








    public function getPhongHoc(){
        $sql = "SELECT id_phong,
                       ten_phong,
                       ma_phong
                FROM phong;";
        return DB::select($sql);
    }

    public function getThoiGian(){
        $sql = "SELECT id_thoi_gian_hoc,
                       tiet_ca,
                       gio_bat_dau,
                       gio_ket_thuc
                FROM thoi_gian;";
        return DB::select($sql);
    }

    public function getGiangVien(){
        $sql = "SELECT id_giang_vien,
                       ho,
                       ten,
                       ma_don_vi
                FROM giang_vien, don_vi
                WHERE giang_vien.id_don_vi = don_vi.id_don_vi;";
        return DB::select($sql);
    }

    public function dsHocKy(){
        $sql = "SELECT id_hoc_ky, ma_hoc_ky, ten_hoc_ky, ten_nam_hoc FROM hoc_ky, nam_hoc
                WHERE hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc;";
        return DB::select($sql);
    }

    public static function getIdHocPhanByMaHocPhan($ma_hoc_phan)
    {
        $sql = "select * from hoc_phan where ma_hoc_phan = :ma_hoc_phan";
        $data = [
            'ma_hoc_phan'=>$ma_hoc_phan
        ];
        return DB::selectOne($sql, $data)->id_hoc_phan;
    }
}
