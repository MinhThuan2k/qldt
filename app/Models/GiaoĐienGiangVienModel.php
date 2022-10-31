<?php

namespace App\Models;

use App\Traits\DanhSachLopHocPhan;
use App\Traits\DotDangKy;
use App\Traits\DotDangKyChiTiet;
use App\Traits\GiangVien;
use App\Traits\HocKy;
use App\Traits\HocPhan;
use App\Traits\HocVien;
use App\Traits\LopHoc;
use App\Traits\LopHocPhan;
use App\Traits\Phong;
use App\Traits\ThoiGian;
use App\Traits\ThoiKhoaBieu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GiaoĐienGiangVienModel extends Model
{
    use ThoiKhoaBieu, GiangVien, LopHocPhan, HocPhan, HocVien, LopHoc, HocKy, DotDangKyChiTiet, HocKy;

    public function dsLopHocPhanTheoIDGiangVien()
    {
        $sql = "select *
from thoi_khoa_bieu, giang_vien, lop_hoc_phan, hoc_phan
where thoi_khoa_bieu.id_lop_hoc_phan=lop_hoc_phan.id_lop_hoc_phan
and thoi_khoa_bieu.id_giang_vien=giang_vien.id_giang_vien
and lop_hoc_phan.id_hoc_phan=hoc_phan.id_hoc_phan
and giang_vien.id_giang_vien=:id_giang_vien";
        return DB::select($sql, ['id_giang_vien' => $this->id_giang_vien]);
    }
    public function dsLopHocPhanTheoIDGiangVienTheoIDHocKy()
    {
        $sql = "select *
from thoi_khoa_bieu, giang_vien, lop_hoc_phan, hoc_phan
where thoi_khoa_bieu.id_lop_hoc_phan=lop_hoc_phan.id_lop_hoc_phan
and thoi_khoa_bieu.id_giang_vien=giang_vien.id_giang_vien
and lop_hoc_phan.id_hoc_phan=hoc_phan.id_hoc_phan
and giang_vien.id_giang_vien=:id_giang_vien AND lop_hoc_phan.id_hoc_ky=:id_hoc_ky";
        return DB::select($sql, ['id_giang_vien' => $this->id_giang_vien,'id_hoc_ky' => $this->id_hoc_ky]);
    }
    public function dsHocVienTheoLopHocPhan()
    {
        $sql = "select * from lop_hoc_phan, danh_sach_lop_hoc_phan, hoc_vien, lop_hoc, hoc_phan, hoc_ky
where lop_hoc_phan.id_lop_hoc_phan=danh_sach_lop_hoc_phan.id_lop_hoc_phan and lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
and danh_sach_lop_hoc_phan.id_hoc_vien=hoc_vien.id_hoc_vien and hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc
and danh_sach_lop_hoc_phan.id_lop_hoc_phan =:id_lop_hoc_phan and lop_hoc_phan.id_hoc_ky=hoc_ky.id_hoc_ky";
        return DB::select($sql, ['id_lop_hoc_phan' => $this->id_lop_hoc_phan]);
    }
    public function chiTiet()
    {
        $sql = "SELECT * FROM lop_hoc_phan, giang_vien, thoi_khoa_bieu, hoc_phan
WHERE lop_hoc_phan.id_lop_hoc_phan=:id_lop_hoc_phan
  and lop_hoc_phan.id_lop_hoc_phan =thoi_khoa_bieu.id_lop_hoc_phan
  and giang_vien.id_giang_vien=thoi_khoa_bieu.id_giang_vien
  and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan";
        $data = ['id_lop_hoc_phan' => $this->id_lop_hoc_phan];
        return DB::selectOne($sql, $data);
    }
    public function capNhat()
    {
        $sql = "UPDATE danh_sach_lop_hoc_phan SET diem_10=:diem_10,
                       diem_40=:diem_40,
                       diem_50=:diem_50,
                       ngay_cap_nhat=CURRENT_TIMESTAMP
                WHERE id_hoc_vien=:id_hoc_vien and id_lop_hoc_phan=:id_lop_hoc_phan";
        $data = [
            'diem_10' => $this->diem_10,
            'diem_40' => $this->diem_40,
            'diem_50' => $this->diem_50,
            'id_hoc_vien' => $this->id_hoc_vien,
            'id_lop_hoc_phan' => $this->id_lop_hoc_phan
        ];
        return DB::update($sql, $data);
    }
    public function them()
    {
        $sql = "insert into danh_sach_lop_hoc_phan (id_hoc_vien,id_lop_hoc_phan) values (:id_hoc_vien,:id_lop_hoc_phan)";
        $data = [
            'id_hoc_vien' => $this->id_hoc_vien,
            'id_lop_hoc_phan' => $this->id_lop_hoc_phan,
        ];
        return DB::insert($sql, $data);
    }
    public function dsSinhVien()
    {
        $sql = "select *, hoc_vien.ho, hoc_vien.ten, dot_dang_ky_chi_tiet.trang_thai from dot_dang_ky_chi_tiet, hoc_vien, lop_hoc, giang_vien, lop_hoc_phan, hoc_phan
                where dot_dang_ky_chi_tiet.id_hoc_vien = hoc_vien.id_hoc_vien
                and hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc
                and lop_hoc.id_giang_vien = giang_vien.id_giang_vien
                and dot_dang_ky_chi_tiet.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
                and lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
                and giang_vien.id_giang_vien =:id_giang_vien order by (hoc_vien.ten) asc ";
        return DB::select($sql, ['id_giang_vien' => $this->id_giang_vien]);
    }
    public function getDotDangKy()
    {
        $sql = "select * from dot_dang_ky, hoc_ky, nam_hoc where hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc and dot_dang_ky.id_hoc_ky = hoc_ky.id_hoc_ky";
        return DB::select($sql);
    }
    public function dsSinhVienTheoDotDangKy()
    {
        $sql = "select *, hoc_vien.ho, hoc_vien.ten, dot_dang_ky_chi_tiet.trang_thai from dot_dang_ky_chi_tiet, hoc_vien, lop_hoc, giang_vien, lop_hoc_phan, hoc_phan
                where dot_dang_ky_chi_tiet.id_hoc_vien = hoc_vien.id_hoc_vien
                and hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc
                and lop_hoc.id_giang_vien = giang_vien.id_giang_vien
                and dot_dang_ky_chi_tiet.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
                and lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
                and dot_dang_ky_chi_tiet.id_dot_dang_ky =:id_dot_dang_ky and giang_vien.id_giang_vien=:id_giang_vien
                order by (hoc_vien.ten) asc ";
        return DB::select($sql, ['id_dot_dang_ky' => $this->id_dot_dang_ky, 'id_giang_vien' => $this->id_giang_vien]);
    }

    public function dsHocPhanTheoSV()
    {
        $sql = "select * from dot_dang_ky_chi_tiet, hoc_vien, lop_hoc, giang_vien, lop_hoc_phan, hoc_phan
                where dot_dang_ky_chi_tiet.id_hoc_vien = hoc_vien.id_hoc_vien
                and hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc
                and lop_hoc.id_giang_vien = giang_vien.id_giang_vien
                and dot_dang_ky_chi_tiet.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
                and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan
                and hoc_vien.id_hoc_vien =:id_hoc_vien";
        return DB::select($sql, ['id_hoc_vien' => $this->id_hoc_vien]);
    }
    public function updateDotDangKyChiTiet()
    {
        $sql = "UPDATE dot_dang_ky_chi_tiet SET trang_thai = 1
                WHERE id_hoc_vien=:id_hoc_vien and id_lop_hoc_phan=:id_lop_hoc_phan and id_dot_dang_ky =:id_dot_dang_ky";
        $data = [
            'id_hoc_vien' => $this->id_hoc_vien,
            'id_lop_hoc_phan' => $this->id_lop_hoc_phan,
            'id_dot_dang_ky' => $this->id_dot_dang_ky
        ];
        return DB::update($sql, $data);
    }
    public function getGiangVien()
    {
        $sql = "select * from giang_vien where id_giang_vien=:id_giang_vien";
        return DB::select($sql, ['id_giang_vien' => $this->id_giang_vien]);
    }

    public function getLopChuyenNganh()
    {
        $sql = "select * from lop_hoc , giang_vien, khoa_hoc
                where lop_hoc.id_giang_vien = giang_vien.id_giang_vien and lop_hoc.id_khoa_hoc = khoa_hoc.id_khoa_hoc
                and giang_vien.id_giang_vien =:id_giang_vien";
        return DB::select($sql, ['id_giang_vien' => $this->id_giang_vien]);
    }
    public function getDSSV()
    {
        $sql = "select * from lop_hoc, hoc_vien
                where lop_hoc.id_lop_hoc = hoc_vien.id_lop_hoc
                and lop_hoc.id_lop_hoc=:id_lop_hoc";
        return DB::select($sql, ['id_lop_hoc' => $this->id_lop_hoc]);
    }
    public function capNhatMoTa()
    {
        $sql = "update hoc_vien set ghi_chu=:ghi_chu
where id_hoc_vien=:id_hoc_vien";
        $data = [
            'id_hoc_vien' => $this->id_hoc_vien,
            'ghi_chu' => $this->ghi_chu,
        ];
        return DB::update($sql, $data);
    }
    public function getDiemCaNhan()
    {
        $sql = "select *, ROUND((diem_10+diem_40*4+diem_50*5)/10,1) as dtb
                from danh_sach_lop_hoc_phan,hoc_vien, lop_hoc_phan, hoc_phan, hoc_ky, nam_hoc
                where hoc_vien.id_hoc_vien = danh_sach_lop_hoc_phan.id_hoc_vien
                and danh_sach_lop_hoc_phan.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
                and lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
                and lop_hoc_phan.id_hoc_ky = hoc_ky.id_hoc_ky
                and nam_hoc.id_nam_hoc = hoc_ky.id_nam_hoc
                and hoc_vien.id_hoc_vien=:id_hoc_vien order by hoc_ky.id_hoc_ky desc ";
        return DB::select($sql, ['id_hoc_vien' => $this->id_hoc_vien]);
    }
    public function getThongTinHocVien($id_hoc_vien)
    {
        $sql = "select * from hoc_vien where id_hoc_vien = $id_hoc_vien";
        return DB::select($sql, ['id_hoc_vien' => $this->id_hoc_vien]);
    }

    public function getHocKy()
    {
        $sql = "select * from hoc_ky, nam_hoc where hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc order by id_hoc_ky desc";
        return DB::select($sql);
    }
    public function getLopHoc($id_lop_hoc)
    {
        $sql = "select * from lop_hoc where id_lop_hoc =:id_lop_hoc";
        $data = [
            'id_lop_hoc' => $id_lop_hoc
        ];
        return DB::select($sql, $data);
    }

    public function getKqht()
    {
        $sql = "select *, ROUND((diem_10+diem_40*4+diem_50*5)/10,1) as dtb from hoc_ky, lop_hoc_phan, hoc_vien, danh_sach_lop_hoc_phan, lop_hoc, hoc_phan
where hoc_ky.id_hoc_ky = lop_hoc_phan.id_hoc_ky
and lop_hoc_phan.id_lop_hoc_phan = danh_sach_lop_hoc_phan.id_lop_hoc_phan
  and danh_sach_lop_hoc_phan.id_hoc_vien = hoc_vien.id_hoc_vien
  and hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc
  and hoc_phan.id_hoc_phan = lop_hoc_phan.id_hoc_phan
and lop_hoc.id_lop_hoc =:id_lop_hoc and hoc_ky.id_hoc_ky =:id_hoc_ky order by (hoc_phan.ten_hoc_phan) asc";
        return DB::select($sql, ['id_lop_hoc' => $this->id_lop_hoc, 'id_hoc_ky' => $this->id_hoc_ky]);
    }
    public function themImport(){
        $sql = "insert into danh_sach_lop_hoc_phan (id_hoc_vien,id_lop_hoc_phan,diem_10,diem_40,diem_50) 
                            values (:id_hoc_vien, :id_lop_hoc_phan, :diem_10, :diem_40,:diem_50)";
    $data = [
        'id_hoc_vien'=>$this->id_hoc_vien,
        'id_lop_hoc_phan'=>$this->id_lop_hoc_phan,
        'diem_10'=>$this->diem_10,
        'diem_40'=>$this->diem_40,
        'diem_50'=>$this->diem_50,
    ];
    return DB::insert($sql, $data);
    
}
    public function xoa($id_lop_hoc_phan){
        $sql = "DELETE FROM danh_sach_lop_hoc_phan WHERE `id_lop_hoc_phan`=:id_lop_hoc_phan";
        $data = [
            'id_lop_hoc_phan'=>$id_lop_hoc_phan,
        ];
        return DB::insert($sql, $data);
    }
    public function lichdayGiangVien(){
        $sql = "SELECT thoi_khoa_bieu.*,
        thoi_gian.tiet_ca,
        DATE_FORMAT(thoi_gian.gio_bat_dau, '%Hg%i') as gio_bat_dau ,
        DATE_FORMAT(thoi_gian.gio_ket_thuc, '%Hg%i') as gio_ket_thuc,
        hoc_ky.ngay_bat_dau,
        hoc_ky.ngay_ket_thuc,
        lop_hoc_phan.ma_lop_hoc_phan,
        hoc_phan.ten_hoc_phan,
        giang_vien.ho,
        giang_vien.ten,
        phong.ten_phong,
        DAYOFWEEK(thoi_khoa_bieu.ngay_hoc) as ngay_hoc_hoc,
        hoc_phan.ma_hoc_phan,
        DATE_FORMAT(thoi_khoa_bieu.ngay_hoc, '%d/%m') as ngayhoc,
        hoc_ky.tuan_bat_dau,
        hoc_ky.tuan_ket_thuc
        	
    FROM thoi_khoa_bieu,giang_vien,thoi_gian,hoc_ky,lop_hoc_phan, hoc_phan,phong
    WHERE thoi_khoa_bieu.id_giang_vien
        AND giang_vien.id_giang_vien =thoi_khoa_bieu.id_giang_vien
        and thoi_khoa_bieu.id_giang_vien=:id_giang_vien
        AND hoc_ky.id_hoc_ky=thoi_khoa_bieu.id_hoc_ky 
         AND lop_hoc_phan.id_hoc_ky=hoc_ky.id_hoc_ky
        AND thoi_khoa_bieu.id_hoc_ky=lop_hoc_phan.id_hoc_ky 
        and thoi_gian.id_thoi_gian_hoc=thoi_khoa_bieu.id_thoi_gian_hoc 
        AND thoi_khoa_bieu.id_lop_hoc_phan=lop_hoc_phan.id_lop_hoc_phan
        AND lop_hoc_phan.id_hoc_phan=hoc_phan.id_hoc_phan
        AND thoi_khoa_bieu.id_phong=phong.id_phong";
        $data = [
            'id_giang_vien' => $this->id_giang_vien,
        ];
        return DB::select($sql, $data);
    }
    public function lichdayGiangVienTheoHK(){
        $sql = "SELECT thoi_khoa_bieu.*,
        thoi_gian.tiet_ca,
        DATE_FORMAT(thoi_gian.gio_bat_dau, '%Hg%i') as gio_bat_dau ,
        DATE_FORMAT(thoi_gian.gio_ket_thuc, '%Hg%i') as gio_ket_thuc,
        hoc_ky.ngay_bat_dau,
        hoc_ky.ngay_ket_thuc,
        lop_hoc_phan.ma_lop_hoc_phan,
        hoc_phan.ten_hoc_phan,
        giang_vien.ho,
        giang_vien.ten,
        phong.ten_phong,
        DAYOFWEEK(thoi_khoa_bieu.ngay_hoc) as ngay_hoc_hoc,
        hoc_phan.ma_hoc_phan,
        DATE_FORMAT(thoi_khoa_bieu.ngay_hoc, '%d/%m') as ngayhoc,
        hoc_ky.tuan_bat_dau,
        hoc_ky.tuan_ket_thuc
        	
    FROM thoi_khoa_bieu,giang_vien,thoi_gian,hoc_ky,lop_hoc_phan, hoc_phan,phong
    WHERE thoi_khoa_bieu.id_giang_vien
        AND giang_vien.id_giang_vien =thoi_khoa_bieu.id_giang_vien
        and thoi_khoa_bieu.id_giang_vien=:id_giang_vien
        AND hoc_ky.id_hoc_ky=thoi_khoa_bieu.id_hoc_ky 
        AND thoi_khoa_bieu.id_hoc_ky=:id_hoc_ky AND lop_hoc_phan.id_hoc_ky=hoc_ky.id_hoc_ky
        AND thoi_khoa_bieu.id_hoc_ky=lop_hoc_phan.id_hoc_ky 
        and thoi_gian.id_thoi_gian_hoc=thoi_khoa_bieu.id_thoi_gian_hoc 
        AND thoi_khoa_bieu.id_lop_hoc_phan=lop_hoc_phan.id_lop_hoc_phan
        AND lop_hoc_phan.id_hoc_phan=hoc_phan.id_hoc_phan
        AND thoi_khoa_bieu.id_phong=phong.id_phong";
        $data = [
            'id_giang_vien' => $this->id_giang_vien,
            'id_hoc_ky' => $this->id_hoc_ky,
        ];
        return DB::select($sql, $data);
    }
    public function demthoikhoabieu(){
        $sql = "SELECT DISTINCT DATE_FORMAT(thoi_khoa_bieu.ngay_hoc, '%d/%m') as ngayhoc,
                thoi_khoa_bieu.ngay_hoc ,
                thoi_khoa_bieu.id_lop_hoc_phan,
                hoc_ky.tuan_bat_dau,
                hoc_ky.tuan_ket_thuc,
                WEEK(thoi_khoa_bieu.ngay_hoc) as tuaninnam 
                FROM thoi_khoa_bieu,hoc_ky 
                WHERE thoi_khoa_bieu.id_hoc_ky=hoc_ky.id_hoc_ky 
                ORDER BY ngay_hoc ASC";
        // $data = [
        //     'id_lop_hoc_phan' => $this->id_lop_hoc_phan,
        // ];
        return DB::select($sql);
    }
}