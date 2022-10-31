<?php

namespace App\Models;

use App\Traits\CaiDatLopHocPhan;
use App\Traits\HocKy;
use App\Traits\HocPhan;
use App\Traits\LopHocPhanDeXuat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KhaoSatDangKyHocPhanModel extends Model
{
    use LopHocPhanDeXuat, CaiDatLopHocPhan, HocKy, HocPhan;

    public function get()
    {
        $sql = "select id_dang_ky_khao_sat, ten_hoc_ky, ten_nam_hoc, ngay_mo, ngay_dong, hoc_ky.ngay_cap_nhat
from dang_ky_khao_sat, hoc_ky, nam_hoc
where dang_ky_khao_sat.id_hoc_ky = hoc_ky.id_hoc_ky and hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc";
        return DB::select($sql);
    }
    public function them($id_hoc_ky, $ngay_mo, $ngay_dong)
    {
        $sql = "insert into dang_ky_khao_sat (id_hoc_ky, ngay_mo, ngay_dong, ngay_cap_nhat, ngay_tao)
values (:id_hoc_ky, :ngay_mo, :ngay_dong, CURRENT_TIMESTAMP , CURRENT_TIMESTAMP);";
        $data = [
            'id_hoc_ky'=>$id_hoc_ky,
            'ngay_mo'=>$ngay_mo,
            'ngay_dong'=>$ngay_dong,
        ];
        return DB::insert($sql, $data);
    }
    public function xoa($id_dang_ky_khao_sat)
    {
        $sql = "delete from dang_ky_khao_sat where id_dang_ky_khao_sat=:id_dang_ky_khao_sat";
        $data =[
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat
        ];
        return DB::delete($sql, $data);
    }
    public function sua($id_dang_ky_khao_sat, $id_hoc_ky, $ngay_mo, $ngay_dong)
    {
        $sql = "update dang_ky_khao_sat
set id_hoc_ky = :id_hoc_ky, ngay_mo = :ngay_mo, ngay_dong = :ngay_dong, ngay_cap_nhat = CURRENT_TIMESTAMP
where id_dang_ky_khao_sat=:id_dang_ky_khao_sat;";
        $data = [
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat,
            'id_hoc_ky'=>$id_hoc_ky,
            'ngay_mo'=>$ngay_mo,
            'ngay_dong'=>$ngay_dong,
        ];
        return DB::update($sql, $data);
    }
    public function chiTietKhaoSatDangKyHocPhan($id_dang_ky_khao_sat)
    {
        $sql = "select ten_hoc_phan, ma_hoc_phan, chi_tiet_dang_ky_khao_sat.id_hoc_phan, tin_chi_lt, tin_chi_th, count(chi_tiet_dang_ky_khao_sat.id_hoc_phan) as so_luong
from chi_tiet_dang_ky_khao_sat, hoc_phan, hoc_vien
where id_dang_ky_khao_sat = :id_dang_ky_khao_sat
and hoc_phan.id_hoc_phan = chi_tiet_dang_ky_khao_sat.id_hoc_phan and hoc_vien.id_hoc_vien = chi_tiet_dang_ky_khao_sat.id_hoc_vien
group by chi_tiet_dang_ky_khao_sat.id_hoc_phan";
        $data = [
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat,
        ];
        return DB::select($sql, $data);
    }

    public function chiTietTachLopHocPhan($id_dang_ky_khao_sat)
    {
        $sql = "select ten_hoc_phan, ma_hoc_phan, chi_tiet_dang_ky_khao_sat.id_hoc_phan, tin_chi_lt, tin_chi_th,
                       count(chi_tiet_dang_ky_khao_sat.id_hoc_phan) as so_luong,
                       so_luong_lop_lt, so_luong_lop_th
                from chi_tiet_dang_ky_khao_sat, hoc_phan, hoc_vien,
                    (select lop_hoc_phan_de_xuat.id_hoc_phan, count(lop_hoc_phan_de_xuat.id_hoc_phan) as so_luong_lop_lt, so_luong_lop_th
                    from lop_hoc_phan_de_xuat
                    left join (select lop_hoc_phan_de_xuat.id_hoc_phan, count(lop_hoc_phan_de_xuat.id_hoc_phan) as so_luong_lop_th
                                from lop_hoc_phan_de_xuat
                                where loai_lop_hoc_phan_de_xuat =1
                                group by id_hoc_phan) as sub on lop_hoc_phan_de_xuat.id_hoc_phan = sub.id_hoc_phan
                    where loai_lop_hoc_phan_de_xuat =0
                    group by id_hoc_phan) as sub_table
                where id_dang_ky_khao_sat = :id_dang_ky_khao_sat
                and hoc_phan.id_hoc_phan = chi_tiet_dang_ky_khao_sat.id_hoc_phan
                and hoc_vien.id_hoc_vien = chi_tiet_dang_ky_khao_sat.id_hoc_vien
                and sub_table.id_hoc_phan = chi_tiet_dang_ky_khao_sat.id_hoc_phan
                group by chi_tiet_dang_ky_khao_sat.id_hoc_phan;";
        $data = [
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat,
        ];
        return DB::select($sql, $data);
    }


    public function getDotKhaoSat($id){
        $sql = "select id_dang_ky_khao_sat, ten_hoc_ky, ten_nam_hoc, ngay_mo, ngay_dong, hoc_ky.ngay_cap_nhat
from dang_ky_khao_sat, hoc_ky, nam_hoc
where dang_ky_khao_sat.id_hoc_ky = hoc_ky.id_hoc_ky and hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc and id_dang_ky_khao_sat=:id_dang_ky_khao_sat";
        $data = [
            'id_dang_ky_khao_sat'=>$id
        ];
        return DB::selectOne($sql, $data);
    }
    public function insertChiTietKhaoSat($id_dang_ky_khao_sat, $id_hoc_vien, $id_hoc_phan)
    {
        $sql = "insert into chi_tiet_dang_ky_khao_sat (id_dang_ky_khao_sat, id_hoc_vien, id_hoc_phan)
values (:id_dang_ky_khao_sat, :id_hoc_vien, :id_hoc_phan);";
        $data = [
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat,
            'id_hoc_vien'=>$id_hoc_vien,
            'id_hoc_phan'=>$id_hoc_phan,
        ];
        return DB::insert($sql, $data);
    }
    public function xoaChiTietKhaoSat($id_dang_ky_khao_sat, $id_hoc_vien)
    {
        $sql = "delete from chi_tiet_dang_ky_khao_sat where id_dang_ky_khao_sat=:id_dang_ky_khao_sat and id_hoc_vien=:id_hoc_vien";
        $data = [
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat,
            'id_hoc_vien'=>$id_hoc_vien,
        ];
        return DB::delete($sql, $data);
    }
    public function getKhaoSat($id_hoc_vien, $id_dang_ky_khao_sat)
    {
        $sql = "select distinct hoc_phan.ten_hoc_phan, chi_tiet_dang_ky_khao_sat.id_hoc_phan, chi_tiet_dang_ky_khao_sat.id_hoc_vien
from chi_tiet_dang_ky_khao_sat, hoc_vien, hoc_phan
where chi_tiet_dang_ky_khao_sat.id_hoc_vien = hoc_vien.id_hoc_vien and chi_tiet_dang_ky_khao_sat.id_hoc_phan = hoc_phan.id_hoc_phan
and chi_tiet_dang_ky_khao_sat.id_hoc_vien = :id_hoc_vien and chi_tiet_dang_ky_khao_sat.id_dang_ky_khao_sat = :id_dang_ky_khao_sat";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat
        ];
        return DB::select($sql, $data);
    }



//    Tách lớp học phần

    public function getCaiDatLopLyThuyet(){
        $sql = "select * from cai_dat_lop_hoc_phan where loai_lop_hoc_phan = 0;";
        return DB::selectOne($sql);
    }

    public function getCaiDatLopThucHanh(){
        $sql = "select * from cai_dat_lop_hoc_phan where loai_lop_hoc_phan = 1;";
        return DB::selectOne($sql);
    }

    public function capNhatCaiDatLopHocPhan(){
        $sql = "update cai_dat_lop_hoc_phan
                set so_luong_toi_thieu = :so_luong_toi_thieu,
                    so_luong_mac_dinh = :so_luong_mac_dinh,
                    so_luong_toi_da = :so_luong_toi_da,
                    so_luong_lop_toi_da = :so_luong_lop_toi_da,
                    so_luong_du_phong = :so_luong_du_phong
                where loai_lop_hoc_phan=:loai_lop_hoc_phan;";

        $data_lt = [
            'so_luong_toi_thieu'=>$this->so_luong_toi_thieu_lt,
            'so_luong_mac_dinh'=>$this->so_luong_mac_dinh_lt,
            'so_luong_toi_da'=>$this->so_luong_toi_da_lt,
            'so_luong_lop_toi_da'=>$this->so_luong_lop_toi_da_lt,
            'so_luong_du_phong'=>$this->so_luong_du_phong_lt,
            'loai_lop_hoc_phan'=>0,
        ];

        $data_th = [
            'so_luong_toi_thieu'=>$this->so_luong_toi_thieu_th,
            'so_luong_mac_dinh'=>$this->so_luong_mac_dinh_th,
            'so_luong_toi_da'=>$this->so_luong_toi_da_th,
            'so_luong_lop_toi_da'=>$this->so_luong_lop_toi_da_th,
            'so_luong_du_phong'=>$this->so_luong_du_phong_th,
            'loai_lop_hoc_phan'=>1,
        ];

        DB::update($sql, $data_lt);
        DB::update($sql, $data_th);
        return true;
    }



    public function getDanhSachLopDeXuat($id_dang_ky_khao_sat){
        $sql = "select *
                from lop_hoc_phan_de_xuat
                where id_hoc_phan = :id_hoc_phan
                and id_dang_ky_khao_sat = :id_dang_ky_khao_sat;";
        $data = [
            'id_hoc_phan'=>$this->id_hoc_phan,
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat,
        ];
        return DB::select($sql, $data);
    }


    public function getThuTuLopHocPhan($id_hoc_phan, $id_hoc_ky,$loai_lop_hoc_phan){
        $sql = "select count(id_hoc_phan) as thu_tu
                from lop_hoc_phan
                where id_hoc_phan = :id_hoc_phan
                and id_hoc_ky = :id_hoc_ky
                and loai_lop_hoc_phan = :loai_lop_hoc_phan;";
        $data = [
            'id_hoc_phan'=>$id_hoc_phan,
            'id_hoc_ky'=>$id_hoc_ky,
            'loai_lop_hoc_phan'=>$loai_lop_hoc_phan,
        ];
        return DB::selectOne($sql, $data);
    }


    public function themLopDeXuat($id_dang_ky_khao_sat){
        $sql = "insert into lop_hoc_phan_de_xuat (ma_lop_hoc_phan_de_xuat, loai_lop_hoc_phan_de_xuat, so_luong, id_hoc_ky, id_hoc_phan, id_dang_ky_khao_sat)
                values (:ma_lop_hoc_phan_de_xuat,:loai_lop_hoc_phan_de_xuat,:so_luong,:id_hoc_ky, :id_hoc_phan ,:id_dang_ky_khao_sat);";
        $data = [
            'ma_lop_hoc_phan_de_xuat'=>trim($this->ma_lop_hoc_phan_de_xuat),
            'loai_lop_hoc_phan_de_xuat'=>trim($this->loai_lop_hoc_phan_de_xuat),
            'so_luong'=>trim($this->so_luong),
            'id_hoc_ky'=>$this->id_hoc_ky,
            'id_hoc_phan'=>$this->id_hoc_phan,
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat,
        ];
        return DB::insert($sql, $data);
    }


    public function capNhatLopDeXuat(){
        $sql = "update lop_hoc_phan_de_xuat
                set ma_lop_hoc_phan_de_xuat = :ma_lop_hoc_phan_de_xuat,
                    loai_lop_hoc_phan_de_xuat = :loai_lop_hoc_phan_de_xuat,
                    so_luong = :so_luong
                where id_lop_hoc_phan_de_xuat = :id_lop_hoc_phan_de_xuat;";
        $data = [
            'ma_lop_hoc_phan_de_xuat'=>$this->ma_lop_hoc_phan_de_xuat,
            'loai_lop_hoc_phan_de_xuat'=>$this->loai_lop_hoc_phan_de_xuat,
            'so_luong'=>$this->so_luong,
            'id_lop_hoc_phan_de_xuat'=>$this->id_lop_hoc_phan_de_xuat,
        ];
        return DB::update($sql, $data);
    }

    public function xoaLopDeXuat(){
        $sql = "delete from lop_hoc_phan_de_xuat where id_lop_hoc_phan_de_xuat= :id_lop_hoc_phan_de_xuat;";
        $data = [
            'id_lop_hoc_phan_de_xuat'=>$this->id_lop_hoc_phan_de_xuat,
        ];
        return DB::delete($sql, $data);
    }


    public function xoaDuyetLopDeXuat($id_dang_ky_khao_sat){
        $sql = "delete from lop_hoc_phan_de_xuat
                where id_dang_ky_khao_sat = :id_dang_ky_khao_sat
                and id_hoc_phan = :id_hoc_phan;";
        $data = [
            'id_dang_ky_khao_sat'=>$id_dang_ky_khao_sat,
            'id_hoc_phan'=>$this->id_hoc_phan,
        ];
        return DB::delete($sql, $data);
    }


    //Model hỗ trợ

    public function getMaHocPhan($id_hoc_phan){
        $sql = "select ma_hoc_phan from hoc_phan where id_hoc_phan = :id_hoc_phan;";
        $data = [
            'id_hoc_phan'=>$id_hoc_phan,
        ];
        return DB::selectOne($sql, $data);
    }

    public function getMaHocKy($id_hoc_ky){
        $sql = "select ma_hoc_ky from hoc_ky where id_hoc_ky = :id_hoc_ky;";
        $data = [
            'id_hoc_ky'=>$id_hoc_ky,
        ];
        return DB::selectOne($sql, $data);
    }
}
