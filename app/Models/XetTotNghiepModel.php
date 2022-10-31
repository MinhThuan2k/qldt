<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\HocVien;

class XetTotNghiepModel extends Model
{
    use HocVien;
    public function dsdiem($id_hoc_vien){
        $sql="SELECT (hoc_phan.tin_chi_lt) as tinchiLT,(hoc_phan.tin_chi_th) as tinchiTH,
                    ROUND(
                    (danh_sach_lop_hoc_phan.diem_10+
                    (danh_sach_lop_hoc_phan.diem_40*4)+
                    (danh_sach_lop_hoc_phan.diem_50*5)
                    )/10,1) as diemhocphan
            FROM danh_sach_lop_hoc_phan,hoc_vien,hoc_phan,lop_hoc_phan
            WHERE hoc_vien.id_hoc_vien = danh_sach_lop_hoc_phan.id_hoc_vien
            AND hoc_phan.id_hoc_phan=lop_hoc_phan.id_hoc_phan
            and danh_sach_lop_hoc_phan.id_lop_hoc_phan= lop_hoc_phan.id_lop_hoc_phan
            and hoc_vien.id_hoc_vien=:id_hoc_vien";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::select($sql,$data);
    }
    public function dsHocPhanTheoCTDT($id_hoc_vien){
        $sql="SELECT
                            hoc_phan.id_hoc_phan,
                            hoc_phan.ma_hoc_phan,
                            hoc_phan.ten_hoc_phan,
                            hoc_phan.tin_chi_lt,
                            hoc_phan.tin_chi_th,
                            hoc_phan_theo_ctdt.hoc_ky,
                            (hoc_phan.tin_chi_lt+hoc_phan.tin_chi_th) AS `tongTinChi`
            FROM `chuyen_nganh`, `hoc_vien`, `hoc_phan`, `hoc_phan_theo_ctdt`, `chuong_trinh_dao_tao`
            WHERE hoc_vien.id_chuyen_nganh=chuyen_nganh.id_chuyen_nganh
                    AND chuong_trinh_dao_tao.id_chuong_trinh=hoc_phan_theo_ctdt.id_chuong_trinh
                    AND chuyen_nganh.id_chuong_trinh=hoc_phan_theo_ctdt.id_chuong_trinh
                    AND hoc_phan_theo_ctdt.id_hoc_phan=hoc_phan.id_hoc_phan
                    AND hoc_vien.id_hoc_vien=:id_hoc_vien
            ORDER BY `hoc_phan_theo_ctdt`.`hoc_ky` ASC";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::select($sql,$data);
    }
    public function TongTinChiTheoCTDT($id_hoc_vien){
        $sql="SELECT DISTINCT   SUM(hoc_phan.tin_chi_lt+hoc_phan.tin_chi_th) as `TongTinChi`
                    FROM `chuyen_nganh`, `hoc_vien`, `hoc_phan`, `hoc_phan_theo_ctdt`, `chuong_trinh_dao_tao`
                    WHERE hoc_vien.id_chuyen_nganh=chuyen_nganh.id_chuyen_nganh
                            AND chuong_trinh_dao_tao.id_chuong_trinh=hoc_phan_theo_ctdt.id_chuong_trinh
                            AND chuyen_nganh.id_chuong_trinh=hoc_phan_theo_ctdt.id_chuong_trinh
                            AND hoc_phan_theo_ctdt.id_hoc_phan=hoc_phan.id_hoc_phan
                            AND hoc_vien.id_hoc_vien=:id_hoc_vien";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::select($sql,$data);
    }

    public function getDiemHPTheoHocVien($id_hoc_vien){
        $sql="SELECT DISTINCT hoc_phan.id_hoc_phan, hoc_phan.ma_hoc_phan, hoc_phan.ten_hoc_phan, danh_sach_lop_hoc_phan.id_hoc_vien, danh_sach_lop_hoc_phan.diem_10, danh_sach_lop_hoc_phan.diem_40, danh_sach_lop_hoc_phan.diem_50,
        (danh_sach_lop_hoc_phan.diem_10+(danh_sach_lop_hoc_phan.diem_40*4)+(danh_sach_lop_hoc_phan.diem_50*5))/10 as diem10
                FROM `danh_sach_lop_hoc_phan`, `hoc_phan`, `hoc_vien`, `lop_hoc_phan`
                WHERE danh_sach_lop_hoc_phan.id_hoc_vien=hoc_vien.id_hoc_vien AND danh_sach_lop_hoc_phan.id_lop_hoc_phan=lop_hoc_phan.id_lop_hoc_phan
                        AND lop_hoc_phan.id_hoc_phan=hoc_phan.id_hoc_phan AND hoc_vien.id_hoc_vien=:id_hoc_vien";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::select($sql,$data);
    }
    public function getHocVienFile($id_hoc_vien){
        $sql="SELECT hoc_vien.id_hoc_vien,
                    hoc_vien.ho,
                    hoc_vien.ten,
                    hoc_vien.sdt,
                    lop_hoc.ten_lop_hoc,
                    chuyen_nganh.ten_chuyen_nganh,
                    hoc_vien.ngay_tao
                FROM hoc_vien,lop_hoc,chuyen_nganh
                WHERE hoc_vien.id_hoc_vien=:id_hoc_vien
                AND hoc_vien.id_lop_hoc=lop_hoc.id_lop_hoc
                AND hoc_vien.id_chuyen_nganh=chuyen_nganh.id_chuyen_nganh;
        ";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::select($sql,$data);
    }
    public function exportDiemXetTotNghiep($id_hoc_vien)
    {
        $sql="SELECT DISTINCT
                    hoc_phan.id_hoc_phan,
                    hoc_phan.ma_hoc_phan,
                    hoc_phan.ten_hoc_phan,
                    hoc_phan.tin_chi_lt,
                    hoc_phan.tin_chi_th,
                    hoc_phan_theo_ctdt.hoc_ky,
                    danh_sach_lop_hoc_phan.diem_10,
                    danh_sach_lop_hoc_phan.diem_40,
                    danh_sach_lop_hoc_phan.diem_50,
                    hoc_vien.id_hoc_vien,
                    hoc_vien.ten,
                    hoc_vien.ho,
                    chuyen_nganh.ten_chuyen_nganh,
                    (hoc_phan.tin_chi_lt+hoc_phan.tin_chi_th) AS `tongTinChi`,
                    (danh_sach_lop_hoc_phan.diem_10+(danh_sach_lop_hoc_phan.diem_40*4)+(danh_sach_lop_hoc_phan.diem_50*5))/10 as diem10
            FROM `chuyen_nganh`, `hoc_vien`, `hoc_phan`, `hoc_phan_theo_ctdt`, `chuong_trinh_dao_tao`,`danh_sach_lop_hoc_phan`,lop_hoc_phan
            WHERE hoc_vien.id_chuyen_nganh=chuyen_nganh.id_chuyen_nganh
            AND chuong_trinh_dao_tao.id_chuong_trinh=hoc_phan_theo_ctdt.id_chuong_trinh
            AND chuyen_nganh.id_chuong_trinh=hoc_phan_theo_ctdt.id_chuong_trinh
            AND hoc_phan_theo_ctdt.id_hoc_phan=hoc_phan.id_hoc_phan
            AND hoc_vien.id_hoc_vien=:id_hoc_vien
            AND danh_sach_lop_hoc_phan.id_hoc_vien=hoc_vien.id_hoc_vien
            AND danh_sach_lop_hoc_phan.id_lop_hoc_phan=lop_hoc_phan.id_lop_hoc_phan
            AND lop_hoc_phan.id_hoc_phan= hoc_phan.id_hoc_phan
            ORDER BY `hoc_phan_theo_ctdt`.`hoc_ky` ASC

        ";
         $data = [
            'id_hoc_vien'=>$id_hoc_vien
        ];
        return DB::select($sql,$data);
    }
}
