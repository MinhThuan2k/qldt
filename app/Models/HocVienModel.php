<?php

namespace App\Models;

use App\Traits\HocVien;
use App\Traits\DonVi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HocVienModel extends Model
{
    use HocVien,DonVi;

    public function insert()
    {
        $sql = "insert into hoc_vien (id_lop_hoc, id_chuyen_nganh, ho, ten, email, sdt, dia_chi, cmnd, sdt_gd, ghi_chu,
                      trang_thai)
values (:id_lop_hoc, :id_chuyen_nganh, :ho, :ten, :email, :sdt, :dia_chi, :cmnd, :sdt_gd, :ghi_chu,
                      :trang_thai)";
        $data = [
            'id_lop_hoc'=>$this->id_lop_hoc,
            'id_chuyen_nganh'=>$this->id_chuyen_nganh,
            'ho'=>$this->ho,
            'ten'=>$this->ten,
            'email'=>$this->email,
            'sdt'=>$this->sdt,
            'dia_chi'=>$this->dia_chi,
            'cmnd'=>$this->cmnd,
            'sdt_gd'=>$this->sdt_gd,
            'ghi_chu'=>$this->ghi_chu,
            'trang_thai'=>$this->trang_thai
        ];
        return DB::insert($sql, $data);
    }

    public function danhsach()
    {
        $sql = "select hoc_vien.id_hoc_vien, hoc_vien.id_lop_hoc, hoc_vien.id_chuyen_nganh, ten_lop_hoc, ten_chuyen_nganh, ho, ten, email, sdt, dia_chi, cmnd, sdt_gd, hoc_vien.ghi_chu, trang_thai, hoc_vien.ngay_tao,
                          hoc_vien.ngay_cap_nhat
from hoc_vien, chuyen_nganh, lop_hoc
where hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc and chuyen_nganh.id_chuyen_nganh = hoc_vien.id_chuyen_nganh";
        return DB::select($sql);
    }

    public function getHocVienTheoLopHoc()
    {
        $sql = "select hoc_vien.id_hoc_vien, hoc_vien.id_lop_hoc, hoc_vien.id_chuyen_nganh, ten_lop_hoc, ten_chuyen_nganh, ho, ten, email, sdt, dia_chi, cmnd, sdt_gd, hoc_vien.ghi_chu, trang_thai, hoc_vien.ngay_tao,
                          hoc_vien.ngay_cap_nhat
from hoc_vien, chuyen_nganh, lop_hoc
where hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc and chuyen_nganh.id_chuyen_nganh = hoc_vien.id_chuyen_nganh
and hoc_vien.id_lop_hoc = :id_lop_hoc";
        $data = ['id_lop_hoc'=>$this->id_lop_hoc,];
        return DB::select($sql, $data);
    }

    public function getTenLopHoc()
    {
        $sql = "SELECT ten_lop_hoc FROM lop_hoc WHERE id_lop_hoc = :id_lop_hoc";
        $data = ['id_lop_hoc'=>$this->id_lop_hoc,];
        return DB::selectOne($sql, $data)->ten_lop_hoc ;
    }

    public function getNienKhoa()
    {
        $sql = "SELECT nien_khoa FROM khoa_hoc,lop_hoc
                WHERE id_lop_hoc = :id_lop_hoc
                    AND lop_hoc.id_khoa_hoc = khoa_hoc.id_khoa_hoc";
        $data = ['id_lop_hoc'=>$this->id_lop_hoc,];
        return DB::selectOne($sql, $data);
    }

    public function delete()
    {
        $sql = "delete from hoc_vien where id_hoc_vien = :id_hoc_vien";
        $data = ['id_hoc_vien'=>$this->id_hoc_vien];
        return DB::delete($sql, $data);
    }

    public function capnhat()
    {
        $sql = "Update hoc_vien set id_lop_hoc=:id_lop_hoc, id_chuyen_nganh=:id_chuyen_nganh, ho=:ho, ten=:ten, email=:email, sdt=:sdt, dia_chi=:dia_chi, cmnd=:cmnd, sdt_gd=:sdt_gd, ghi_chu=:ghi_chu,
                      trang_thai=:trang_thai, ngay_cap_nhat=CURRENT_TIMESTAMP where id_hoc_vien = :id_hoc_vien";
        $data = [
            'id_lop_hoc'=>$this->id_lop_hoc,
            'id_chuyen_nganh'=>$this->id_chuyen_nganh,
            'ho'=>$this->ho,
            'ten'=>$this->ten,
            'email'=>$this->email,
            'sdt'=>$this->sdt,
            'dia_chi'=>$this->dia_chi,
            'cmnd'=>$this->cmnd,
            'sdt_gd'=>$this->sdt_gd,
            'ghi_chu'=>$this->ghi_chu,
            'trang_thai'=>$this->trang_thai,
            'id_hoc_vien'=>$this->id_hoc_vien
        ];
        return DB::update($sql, $data);
    }
    public function getLopHoc()
    {
        return DB::select('select * from lop_hoc');
    }
    public function getChuyenNganh()
    {
        return DB::select('select * from chuyen_nganh');
    }
    public static function getLopHocByHocVien($id_hoc_vien)
    {
        $sql = "select id_lop_hoc from hoc_vien where id_hoc_vien=:id_hoc_vien";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::selectOne($sql, $data)->id_lop_hoc;
    }
    public static function getDSHocVien($id_don_vi)
    {
        $sql="select 
                    hoc_vien.id_hoc_vien, hoc_vien.ho,hoc_vien.ten 
        from hoc_vien,lop_hoc,don_vi
        where hoc_vien.id_lop_hoc = lop_hoc.id_lop_hoc 
        and lop_hoc.id_don_vi=don_vi.id_don_vi 
        and don_vi.id_don_vi= :id_don_vi";
        $data = [
            'id_don_vi'=>$id_don_vi
        ];
        return DB::select($sql,$data);
    }
    public static function danhSachAjax($ten_hoc_vien) // Dành cho select2 ajax
    {
    
        return DB::table('hoc_vien')->where('ho','like', "%$ten_hoc_vien%")->orwhere('ten','like', "%$ten_hoc_vien%")
                                ->orwhere('id_hoc_vien','like', "%$ten_hoc_vien%")->get();
    }
    public static function getALLDSHocVien()
    {
        $sql="select * from hoc_vien";
        return DB::select($sql);
    }
}
