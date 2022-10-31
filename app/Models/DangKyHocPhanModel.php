<?php

namespace App\Models;
use App\Traits\HocPhan;
use App\Traits\LopHocPhan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DangKyHocPhanModel extends Model
{
    public static function soLuongHocVien($id_lop_hoc_phan)
    {
        $sql = "select count(id_hoc_vien) as count
from dot_dang_ky_chi_tiet
where id_lop_hoc_phan = :id_lop_hoc_phan";
        $data=[
          'id_lop_hoc_phan'=>$id_lop_hoc_phan,
        ];
        return DB::selectOne($sql, $data)->count;
    }

    public static function dangKyLopHocPhan($id_hoc_vien, $id_lop_hoc_phan, $id_dot_dang_ky)
    {
        $sql = "insert into dot_dang_ky_chi_tiet (id_dot_dang_ky, id_hoc_vien, id_lop_hoc_phan, ngay_tao)
values (:id_dot_dang_ky, :id_hoc_vien, :id_lop_hoc_phan, CURRENT_TIMESTAMP);";
        $data = [
            'id_dot_dang_ky'=>$id_dot_dang_ky,
            'id_hoc_vien'=>$id_hoc_vien,
            'id_lop_hoc_phan'=>$id_lop_hoc_phan,
        ];
        return DB::insert($sql, $data);
    }
    public static function huyLopHocPhanDangKy($id_hoc_vien, $id_lop_hoc_phan, $id_dot_dang_ky)
    {
        $sql = "delete from dot_dang_ky_chi_tiet where id_dot_dang_ky=:id_dot_dang_ky and id_hoc_vien=:id_hoc_vien and id_lop_hoc_phan=:id_lop_hoc_phan";
        $data = [
            'id_dot_dang_ky'=>$id_dot_dang_ky,
            'id_hoc_vien'=>$id_hoc_vien,
            'id_lop_hoc_phan'=>$id_lop_hoc_phan,
        ];
        return DB::delete($sql, $data);
    }

    public static function getSoLuong($id_lop_hoc_phan)
    {
        $sql = "select so_luong from lop_hoc_phan where id_lop_hoc_phan = :id_lop_hoc_phan";
        $data = [
            'id_lop_hoc_phan'=>$id_lop_hoc_phan
        ];
        return DB::selectOne($sql, $data)->so_luong;
    }

    public static function kiemTraDangKy($id_hoc_vien, $id_lop_hoc_phan)
    {
        $sql = "select count(*) as count
from dot_dang_ky_chi_tiet
where id_hoc_vien = :id_hoc_vien and id_lop_hoc_phan = :id_lop_hoc_phan";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
            'id_lop_hoc_phan'=>$id_lop_hoc_phan
        ];
        return DB::selectOne($sql, $data)->count;
    }

    public static function getLopThucHanh($id_hoc_phan)
    {
        $sql = "select lop_hoc_phan.id_lop_hoc_phan, ma_lop_hoc_phan, ten_hoc_phan, so_luong, concat(ho, ' ', ten) as ho_ten,
       (select count(id_hoc_vien) as count
from dot_dang_ky_chi_tiet
where id_lop_hoc_phan=lop_hoc_phan.id_lop_hoc_phan) as so_luong_da_dang_ky,
       ngay_hoc, tiet_ca, phong.ten_phong
from lop_hoc_phan, hoc_phan, thoi_khoa_bieu, giang_vien, thoi_gian, phong
where lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
  and phong.id_phong = thoi_khoa_bieu.id_phong
and nhap_diem = 0
and loai_lop_hoc_phan = 1
and thoi_khoa_bieu.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
  and thoi_khoa_bieu.id_giang_vien = giang_vien.id_giang_vien
  and thoi_khoa_bieu.id_thoi_gian_hoc = thoi_gian.id_thoi_gian_hoc
and lop_hoc_phan.id_hoc_phan = :id_hoc_phan
group by lop_hoc_phan.id_lop_hoc_phan";
        $data = [
            'id_hoc_phan'=>$id_hoc_phan
        ];
        $data = DB::select($sql, $data);
        //Chuyển ngày học thành thứ trong tuần
        foreach($data as $key=>$item)
        {
            $ngayHoc = Carbon::parse($item->ngay_hoc)->dayOfWeek;
            $weekMap = [
                0 => 'Chủ nhật',
                1 => 'Thứ hai',
                2 => 'Thứ ba',
                3 => 'Thứ tư',
                4 => 'Thứ năm',
                5 => 'Thứ sáu',
                6 => 'Thứ bảy',
            ];
            $data[$key]->ngay_hoc_chu = $weekMap[$ngayHoc];
        }
        return $data;
    }
    public static function getDotDangKy()
    {
        $sql = "select * from dot_dang_ky, hoc_ky, nam_hoc where dot_dang_ky.id_hoc_ky = hoc_ky.id_hoc_ky and hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc";
        return DB::select($sql);
    }
    public static function getDanhSachLopHocPhanTheoDotDangKy($id_dot_dang_ky, $id_lop_chuyen_nganh) //Lấy danh sách lớp học phần theo đợt đăng ký
    {
        if($id_lop_chuyen_nganh == 0) //Này là lấy tất cả học phần dự kiến sẽ mở
        {
            $sql = "select ma_lop_hoc_phan, tin_chi_th, hoc_phan.id_hoc_phan, ten_hoc_phan, concat(tin_chi_lt, '/', tin_chi_th) as tin_chi, (select count(id_hoc_vien) as count from dot_dang_ky_chi_tiet
where id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan) as so_luong_dang_ky, so_luong, concat(ho, ' ', ten) as ho_ten, lop_hoc_phan.id_lop_hoc_phan, hoc_ky.id_hoc_ky, tiet_ca, ngay_hoc
from lop_hoc_phan, hoc_phan, thoi_khoa_bieu, giang_vien, hoc_ky, dot_dang_ky, thoi_gian
where lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan and nhap_diem = 0 and loai_lop_hoc_phan = 0
and thoi_khoa_bieu.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and thoi_khoa_bieu.id_thoi_gian_hoc = thoi_gian.id_thoi_gian_hoc
and hoc_ky.id_hoc_ky = lop_hoc_phan.id_hoc_ky and dot_dang_ky.id_hoc_ky = hoc_ky.id_hoc_ky and id_dot_dang_ky = :id_dot_dang_ky
group by ma_lop_hoc_phan";
            $data = [
                'id_dot_dang_ky'=>$id_dot_dang_ky,
            ];
        }
        else
        {
            $sql = "select distinct ma_lop_hoc_phan, tin_chi_th, hoc_phan.id_hoc_phan, ten_hoc_phan, concat(tin_chi_lt, '/', tin_chi_th) as tin_chi, (select count(id_hoc_vien) as count from dot_dang_ky_chi_tiet
where id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan) as so_luong_dang_ky, so_luong, concat(ho, ' ', ten) as ho_ten, lop_hoc_phan.id_lop_hoc_phan, hoc_ky.id_hoc_ky, tiet_ca, ngay_hoc
from lop_hoc_phan, hoc_phan, thoi_khoa_bieu, giang_vien, hoc_ky, dot_dang_ky, thoi_gian, chi_tiet_dang_ky_khao_sat, dang_ky_khao_sat
where lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan and nhap_diem = 0 and loai_lop_hoc_phan = 0
  and chi_tiet_dang_ky_khao_sat.id_dang_ky_khao_sat = dang_ky_khao_sat.id_dang_ky_khao_sat
  and chi_tiet_dang_ky_khao_sat.id_hoc_phan = hoc_phan.id_hoc_phan and dang_ky_khao_sat.id_hoc_ky = thoi_khoa_bieu.id_hoc_ky
    and dot_dang_ky.id_dot_dang_ky
    and thoi_khoa_bieu.id_thoi_gian_hoc = thoi_gian.id_thoi_gian_hoc
and thoi_khoa_bieu.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
and hoc_ky.id_hoc_ky = lop_hoc_phan.id_hoc_ky and dot_dang_ky.id_hoc_ky = hoc_ky.id_hoc_ky and dot_dang_ky.id_dot_dang_ky = :id_dot_dang_ky
and chi_tiet_dang_ky_khao_sat.id_hoc_vien = :id_hoc_vien
group by ma_lop_hoc_phan";
            $data = [
                'id_dot_dang_ky'=>$id_dot_dang_ky,
                'id_hoc_vien'=>session()->get('id')
            ];
        }
        $data = DB::select($sql, $data);
        //Chuyển ngày học thành thứ trong tuần
        foreach($data as $key=>$item)
        {
            $ngayHoc = Carbon::parse($item->ngay_hoc)->dayOfWeek;
            $weekMap = [
                0 => 'Chủ nhật',
                1 => 'Thứ hai',
                2 => 'Thứ ba',
                3 => 'Thứ tư',
                4 => 'Thứ năm',
                5 => 'Thứ sáu',
                6 => 'Thứ bảy',
            ];
            $data[$key]->ngay_hoc_chu = $weekMap[$ngayHoc];
        }
        return $data;
    }public static function getDanhSachLopHocPhanTheoDotDangKyTheoCTDD($id_dot_dang_ky, $id_hoc_vien) //Lấy danh sách lớp học phần theo đợt đăng ký
    {
            $sql = "select ma_lop_hoc_phan, tin_chi_th, hoc_phan.id_hoc_phan, ten_hoc_phan, concat(tin_chi_lt, '/', tin_chi_th) as tin_chi, (select count(id_hoc_vien) as count from dot_dang_ky_chi_tiet where id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan) as so_luong_dang_ky, so_luong, concat(giang_vien.ho, ' ', giang_vien.ten) as ho_ten, lop_hoc_phan.id_lop_hoc_phan, hoc_ky.id_hoc_ky, tiet_ca, ngay_hoc 
            from lop_hoc_phan, hoc_phan, thoi_khoa_bieu, giang_vien, hoc_ky, dot_dang_ky, thoi_gian,`chuyen_nganh`, `hoc_vien`, `hoc_phan_theo_ctdt`, `chuong_trinh_dao_tao`
            where lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
            and nhap_diem = 0 and loai_lop_hoc_phan = 0 
                    and thoi_khoa_bieu.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan 
                    and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien 
                    and thoi_khoa_bieu.id_thoi_gian_hoc = thoi_gian.id_thoi_gian_hoc 
                    and hoc_ky.id_hoc_ky = lop_hoc_phan.id_hoc_ky
                    and dot_dang_ky.id_hoc_ky = hoc_ky.id_hoc_ky
                    and dot_dang_ky.id_dot_dang_ky = 10
                    AND Hoc_vien.id_chuyen_nganh=chuyen_nganh.id_chuyen_nganh
                                AND chuong_trinh_dao_tao.id_chuong_trinh=hoc_phan_theo_ctdt.id_chuong_trinh
                                AND chuyen_nganh.id_chuong_trinh=hoc_phan_theo_ctdt.id_chuong_trinh
                                AND hoc_phan_theo_ctdt.id_hoc_phan=hoc_phan.id_hoc_phan
                                AND hoc_vien.id_hoc_vien=15
                    group by ma_lop_hoc_phan";
            $data = [
                'id_dot_dang_ky'=>$id_dot_dang_ky,
                'id_hoc_vien'=>$id_hoc_vien,
            ];
        
        $data = DB::select($sql, $data);
        //Chuyển ngày học thành thứ trong tuần
        foreach($data as $key=>$item)
        {
            $ngayHoc = Carbon::parse($item->ngay_hoc)->dayOfWeek;
            $weekMap = [
                0 => 'Chủ nhật',
                1 => 'Thứ hai',
                2 => 'Thứ ba',
                3 => 'Thứ tư',
                4 => 'Thứ năm',
                5 => 'Thứ sáu',
                6 => 'Thứ bảy',
            ];
            $data[$key]->ngay_hoc_chu = $weekMap[$ngayHoc];
        }
        return $data;
    }
    public static function getHocPhanDaDangKy($id_hoc_vien, $id_dot_dang_ky)
    {
        $sql = "select ten_hoc_phan, ma_lop_hoc_phan, concat(giang_vien.ho, ' ', giang_vien.ten) as ho_ten, ngay_hoc,
       ten_phong, lop_hoc_phan.id_lop_hoc_phan, dot_dang_ky_chi_tiet.id_dot_dang_ky, hoc_phan.id_hoc_phan, concat(tin_chi_lt, '/', tin_chi_th) as tin_chi, tiet_ca, gio_bat_dau, gio_ket_thuc
from dot_dang_ky, dot_dang_ky_chi_tiet, hoc_vien, lop_hoc_phan, hoc_phan, giang_vien, thoi_khoa_bieu, phong, thoi_gian
where dot_dang_ky_chi_tiet.id_hoc_vien = hoc_vien.id_hoc_vien
and dot_dang_ky.id_dot_dang_ky = dot_dang_ky_chi_tiet.id_dot_dang_ky and dot_dang_ky_chi_tiet.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan
and lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan and giang_vien.id_giang_vien = thoi_khoa_bieu.id_giang_vien
  and thoi_khoa_bieu.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan and phong.id_phong = thoi_khoa_bieu.id_phong
  and thoi_gian.id_thoi_gian_hoc = thoi_khoa_bieu.id_thoi_gian_hoc
and hoc_vien.id_hoc_vien = :id_hoc_vien and dot_dang_ky_chi_tiet.id_dot_dang_ky = :id_dot_dang_ky
group by ma_lop_hoc_phan";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
            'id_dot_dang_ky'=>$id_dot_dang_ky
        ];
        $data = DB::select($sql, $data);
        //Chuyển ngày học thành thứ trong tuần
        foreach($data as $key=>$item)
        {
            $ngayHoc = Carbon::parse($item->ngay_hoc)->dayOfWeek;
            $weekMap = [
                0 => 'Chủ nhật',
                1 => 'Thứ hai',
                2 => 'Thứ ba',
                3 => 'Thứ tư',
                4 => 'Thứ năm',
                5 => 'Thứ sáu',
                6 => 'Thứ bảy',
            ];
            $data[$key]->ngay_hoc_chu = $weekMap[$ngayHoc];
        }
        return $data;
    }
    public static function sync_hocPhanDaDangKy($id_hoc_vien, $id_dot_dang_ky)
    {
        $sql = "select distinct hoc_phan.id_hoc_phan, (hoc_phan.tin_chi_th + hoc_phan.tin_chi_lt) as so_tin_chi
from dot_dang_ky_chi_tiet, hoc_phan, lop_hoc_phan, hoc_ky
where dot_dang_ky_chi_tiet.id_lop_hoc_phan = lop_hoc_phan.id_lop_hoc_phan and lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
and dot_dang_ky_chi_tiet.id_hoc_vien = :id_hoc_vien and dot_dang_ky_chi_tiet.id_dot_dang_ky = :id_dot_dang_ky and lop_hoc_phan.id_hoc_ky = hoc_ky.id_hoc_ky";
        $data = [
            'id_hoc_vien'=>$id_hoc_vien,
            'id_dot_dang_ky'=>$id_dot_dang_ky,
        ];
        return DB::select($sql, $data);
    }
    public function danhSach()
    {
        $sql = "Select DISTINCT hoc_phan_theo_ctdt.id_hoc_phan,
        hoc_phan.ma_hoc_phan,
        hoc_phan.ten_hoc_phan,
        chuong_trinh_dao_tao.ten_chuong_trinh,
        chuong_trinh_dao_tao.id_chuong_trinh,
        hoc_phan.tin_chi_th,
        hoc_phan.tin_chi_lt,
        chuong_trinh_dao_tao.ten_chuong_trinh
    from lop_hoc_phan,hoc_phan,danh_sach_lop_hoc_phan,hoc_phan_theo_ctdt,chuong_trinh_dao_tao
    where chuong_trinh_dao_tao.id_chuong_trinh='6'
    and hoc_phan_theo_ctdt.id_chuong_trinh = chuong_trinh_dao_tao.id_chuong_trinh
    and hoc_phan.id_hoc_phan = hoc_phan_theo_ctdt.id_hoc_phan
    ;";
        return DB::select($sql);
    }
    public static function getTinChiByLopHocPhan($id_lop_hoc_phan)
    {
        $sql = "select (tin_chi_th+hoc_phan.tin_chi_lt) as so_tin_chi
from lop_hoc_phan, hoc_phan
where lop_hoc_phan.id_hoc_phan = hoc_phan.id_hoc_phan
and id_lop_hoc_phan = :id_lop_hoc_phan";
        $data = [
            "id_lop_hoc_phan"=>$id_lop_hoc_phan,
        ];
        return DB::selectOne($sql, $data)->so_tin_chi;
    }
    public static function getChiTietDotDangKy($id_dot_dang_ky)
    {
        $sql = "select *
from dot_dang_ky, hoc_ky, nam_hoc
where dot_dang_ky.id_hoc_ky = hoc_ky.id_hoc_ky and hoc_ky.id_nam_hoc = nam_hoc.id_nam_hoc
and dot_dang_ky.id_dot_dang_ky = :id_dot_dang_ky";
        $data = [
            'id_dot_dang_ky'=>$id_dot_dang_ky
        ];
        return DB::selectOne($sql, $data);
    }
    public static function getThoiHanDangKy($id_dot_dang_ky)
    {
        $sql = "select thoi_gian_dong, thoi_gian_mo
from dot_dang_ky
where dot_dang_ky.id_dot_dang_ky = :id_dot_dang_ky";
        $data =[
            'id_dot_dang_ky'=>$id_dot_dang_ky
        ];
        return DB::selectOne($sql, $data);
    }
    public static function getNgayGioHoc($id_lop_hoc_phan)
    {
        $sql = "select ngay_hoc, gio_bat_dau, gio_ket_thuc
from thoi_khoa_bieu, thoi_gian
where thoi_khoa_bieu.id_thoi_gian_hoc = thoi_gian.id_thoi_gian_hoc
and thoi_khoa_bieu.id_lop_hoc_phan = :id_lop_hoc_phan
group by id_lop_hoc_phan";
        $data = [
            'id_lop_hoc_phan'=>$id_lop_hoc_phan
        ];
        return DB::selectOne($sql, $data);
    }
}
