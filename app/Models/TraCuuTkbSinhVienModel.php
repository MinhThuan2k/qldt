<?php

namespace App\Models;


use App\Traits\DanhSachLopHocPhan;
use App\Traits\GiangVien;
use App\Traits\HocKy;
use App\Traits\HocPhan;
use App\Traits\HocPhi;
use App\Traits\LopHocPhan;
use App\Traits\Phong;
use App\Traits\ThoiGian;
use App\Traits\ThoiKhoaBieu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TraCuuTkbSinhVienModel extends Model
{
    use LopHocPhan, HocPhan, GiangVien, Phong, ThoiGian, ThoiKhoaBieu, HocKy, HocPhan;
    public function dsTKBSv(){
        $sql = "SELECT DISTINCT
                thoi_khoa_bieu.id_lop_hoc_phan,
                phong.ten_phong,
                thoi_gian.tiet_ca,
                thoi_gian.gio_bat_dau,
                thoi_gian.gio_ket_thuc,
                giang_vien.ho,
                giang_vien.ten,
                hoc_ky.tuan_bat_dau,
                hoc_ky.tuan_ket_thuc,
                hoc_phan.ma_hoc_phan,
                thoi_khoa_bieu.id_phong,
                danh_sach_lop_hoc_phan.id_lop_hoc_phan,
                hoc_phan.ten_hoc_phan,
                lop_hoc_phan.ma_lop_hoc_phan
            FROM danh_sach_lop_hoc_phan,thoi_khoa_bieu, phong, thoi_gian, giang_vien, hoc_ky, hoc_phan, lop_hoc_phan
WHERE danh_sach_lop_hoc_phan.id_hoc_vien =:id_hoc_vien
and thoi_khoa_bieu.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and phong.id_phong = thoi_khoa_bieu.id_phong
and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and lop_hoc_phan.id_lop_hoc_phan = thoi_khoa_bieu.id_lop_hoc_phan
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan";
        $data = [
            'id_hoc_vien' => trim($this->id_hoc_vien),
        ];
        return DB::select($sql,$data);
    }

    public function dsngayhoc(){
        $sql = "SELECT
                thoi_khoa_bieu.id_phong,
                thoi_khoa_bieu.ngay_hoc
            FROM danh_sach_lop_hoc_phan,thoi_khoa_bieu, phong, thoi_gian, giang_vien, hoc_ky, hoc_phan, lop_hoc_phan
WHERE danh_sach_lop_hoc_phan.id_hoc_vien =:id_hoc_vien
and thoi_khoa_bieu.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and phong.id_phong = thoi_khoa_bieu.id_phong
and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and lop_hoc_phan.id_lop_hoc_phan = thoi_khoa_bieu.id_lop_hoc_phan
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan";
        $data = [
            'id_hoc_vien' => trim($this->id_hoc_vien),
        ];
        return DB::select($sql,$data);
    }

    public function dsTKBSv1($id_hoc_vien){
        $sql = "SELECT DISTINCT
                thoi_khoa_bieu.id_lop_hoc_phan,
                phong.ten_phong,
                thoi_gian.tiet_ca,
                DATE_FORMAT(thoi_gian.gio_bat_dau,'%hg%i') as gio_bat_dau,
                DATE_FORMAT(thoi_gian.gio_ket_thuc,'%hg%i') as gio_ket_thuc,
                giang_vien.ho,
                giang_vien.ten,
                hoc_ky.tuan_bat_dau,
                hoc_ky.tuan_ket_thuc,
                hoc_phan.ma_hoc_phan,
                thoi_khoa_bieu.id_phong,
                danh_sach_lop_hoc_phan.id_lop_hoc_phan,
                hoc_phan.ten_hoc_phan,
                lop_hoc_phan.ma_lop_hoc_phan
            FROM danh_sach_lop_hoc_phan,thoi_khoa_bieu, phong, thoi_gian, giang_vien, hoc_ky, hoc_phan, lop_hoc_phan
WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
and thoi_khoa_bieu.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and phong.id_phong = thoi_khoa_bieu.id_phong
and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and lop_hoc_phan.id_lop_hoc_phan = thoi_khoa_bieu.id_lop_hoc_phan
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan";
        $data = [
            'id_hoc_vien' => $id_hoc_vien,
        ];
        return DB::select($sql, $data);
    }

    public function dsngayhoc1($id_hoc_vien){
        $sql = "SELECT
                thoi_khoa_bieu.id_phong,
                DATE_FORMAT(thoi_khoa_bieu.ngay_hoc,'%d-%m') as ngay_hoc
            FROM danh_sach_lop_hoc_phan,thoi_khoa_bieu, phong, thoi_gian, giang_vien, hoc_ky, hoc_phan, lop_hoc_phan
WHERE danh_sach_lop_hoc_phan.id_hoc_vien = :id_hoc_vien
and thoi_khoa_bieu.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and phong.id_phong = thoi_khoa_bieu.id_phong
and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and lop_hoc_phan.id_lop_hoc_phan = thoi_khoa_bieu.id_lop_hoc_phan
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan";
        $data = [
            'id_hoc_vien' => $id_hoc_vien,
        ];
        return DB::select($sql, $data);
    }
    public function dsTKBSvTheoHK(){
        $sql = "SELECT DISTINCT
        thoi_khoa_bieu.id_lop_hoc_phan,
        phong.ten_phong,
        thoi_gian.tiet_ca,
        thoi_gian.gio_bat_dau,
        thoi_gian.gio_ket_thuc,
        giang_vien.ho,
        giang_vien.ten,
        hoc_ky.tuan_bat_dau,
        hoc_ky.tuan_ket_thuc,
        hoc_phan.ma_hoc_phan,
        thoi_khoa_bieu.id_phong,
        danh_sach_lop_hoc_phan.id_lop_hoc_phan,
        hoc_phan.ten_hoc_phan,
        lop_hoc_phan.ma_lop_hoc_phan
    FROM danh_sach_lop_hoc_phan,thoi_khoa_bieu, phong, thoi_gian, giang_vien, hoc_ky, hoc_phan, lop_hoc_phan
WHERE danh_sach_lop_hoc_phan.id_hoc_vien =:id_hoc_vien
and thoi_khoa_bieu.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and phong.id_phong = thoi_khoa_bieu.id_phong
and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and lop_hoc_phan.id_lop_hoc_phan = thoi_khoa_bieu.id_lop_hoc_phan
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan AND hoc_ky.id_hoc_ky=:id_hoc_ky";
        $data = [
            'id_hoc_vien' => trim($this->id_hoc_vien),
            'id_hoc_ky' => trim($this->id_hoc_ky),
        ];
        return DB::select($sql,$data);
    }
    public function dsngayhocTheoHK(){
        $sql = "SELECT
        thoi_khoa_bieu.id_phong,
        thoi_khoa_bieu.ngay_hoc
    FROM danh_sach_lop_hoc_phan,thoi_khoa_bieu, phong, thoi_gian, giang_vien, hoc_ky, hoc_phan, lop_hoc_phan
WHERE danh_sach_lop_hoc_phan.id_hoc_vien =:id_hoc_vien
and thoi_khoa_bieu.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and phong.id_phong = thoi_khoa_bieu.id_phong
and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and lop_hoc_phan.id_lop_hoc_phan = thoi_khoa_bieu.id_lop_hoc_phan
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan AND hoc_ky.id_hoc_ky=:id_hoc_ky";
        $data = [
            'id_hoc_vien' => trim($this->id_hoc_vien),
            'id_hoc_ky' => trim($this->id_hoc_ky),
        ];
        return DB::select($sql, $data);
    }
    public function ngayHocTheoBang($id_hoc_vien){
        $sql = "SELECT DISTINCT
        thoi_khoa_bieu.id_lop_hoc_phan,
        phong.ten_phong,
        thoi_gian.tiet_ca,
        thoi_gian.gio_bat_dau,
        thoi_gian.gio_ket_thuc,
        giang_vien.ho,
        giang_vien.ten,
        hoc_ky.tuan_bat_dau,
        hoc_ky.tuan_ket_thuc,
        hoc_phan.ma_hoc_phan,
        thoi_khoa_bieu.id_phong,
        danh_sach_lop_hoc_phan.id_lop_hoc_phan,
        hoc_phan.ten_hoc_phan,
        lop_hoc_phan.ma_lop_hoc_phan,
        thoi_khoa_bieu.ngay_hoc
    FROM danh_sach_lop_hoc_phan,thoi_khoa_bieu, phong, thoi_gian, giang_vien, hoc_ky, hoc_phan, lop_hoc_phan
WHERE danh_sach_lop_hoc_phan.id_hoc_vien =:id_hoc_vien
and thoi_khoa_bieu.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and phong.id_phong = thoi_khoa_bieu.id_phong
and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and lop_hoc_phan.id_lop_hoc_phan = thoi_khoa_bieu.id_lop_hoc_phan
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan and thoi_khoa_bieu.ngay_hoc=(SELECT DATE(NOW()))";
        $data = [
            'id_hoc_vien' =>$id_hoc_vien,
        ];
        return DB::select($sql, $data);
    }
    public function ngayHocTheoBang1($id_hoc_vien,$id_hoc_ky){
        $sql = "SELECT DISTINCT
        thoi_khoa_bieu.id_lop_hoc_phan,
        phong.ten_phong,
        thoi_gian.tiet_ca,
        thoi_gian.gio_bat_dau,
        thoi_gian.gio_ket_thuc,
        giang_vien.ho,
        giang_vien.ten,
        hoc_ky.tuan_bat_dau,
        hoc_ky.tuan_ket_thuc,
        hoc_phan.ma_hoc_phan,
        thoi_khoa_bieu.id_phong,
        danh_sach_lop_hoc_phan.id_lop_hoc_phan,
        hoc_phan.ten_hoc_phan,
        lop_hoc_phan.ma_lop_hoc_phan,
        thoi_khoa_bieu.ngay_hoc
    FROM danh_sach_lop_hoc_phan,thoi_khoa_bieu, phong, thoi_gian, giang_vien, hoc_ky, hoc_phan, lop_hoc_phan
WHERE danh_sach_lop_hoc_phan.id_hoc_vien =15
and thoi_khoa_bieu.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
and phong.id_phong = thoi_khoa_bieu.id_phong
and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and lop_hoc_phan.id_lop_hoc_phan = thoi_khoa_bieu.id_lop_hoc_phan
and thoi_khoa_bieu.id_hoc_ky=:id_hoc_ky
and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan and thoi_khoa_bieu.ngay_hoc=(SELECT DATE(NOW()))";
        $data = [
            'id_hoc_vien' => $id_hoc_vien,
            'id_hoc_ky' =>$id_hoc_ky,
        ];
        return DB::select($sql, $data);
    }
}
