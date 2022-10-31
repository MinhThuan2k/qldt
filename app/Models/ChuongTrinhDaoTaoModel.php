<?php

namespace App\Models;

use App\Traits\ChuongTrinhDaoTao;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChuongTrinhDaoTaoModel extends Model
{
    use ChuongTrinhDaoTao;
    public function danhsach($id_don_vi)
    {
        $sql = "select id_chuong_trinh, id_don_vi, ma_chuong_trinh, ten_chuong_trinh, nien_khoa, ngay_ban_hanh,
                                  tong_tin_chi, trang_thai, chuong_trinh_dao_tao.ngay_tao, chuong_trinh_dao_tao.ngay_cap_nhat
from chuong_trinh_dao_tao, khoa_hoc
where khoa_hoc.id_khoa_hoc = chuong_trinh_dao_tao.id_khoa_hoc and id_don_vi = :id_don_vi";
        $data = [
            'id_don_vi'=>$id_don_vi
        ];
        return DB::select($sql, $data);
    }

    static function tinhTongTinChi($id_chuong_trinh)
    {
        $sql = "select chuong_trinh_dao_tao.id_chuong_trinh, ten_chuong_trinh, (select sum(hoc_phan.tin_chi_lt + hoc_phan.tin_chi_th) from hoc_phan, hoc_phan_theo_ctdt where hoc_phan.id_hoc_phan = hoc_phan_theo_ctdt.id_hoc_phan and hoc_phan_theo_ctdt.id_chuong_trinh = chuong_trinh_dao_tao.id_chuong_trinh) as tongchi
from chuong_trinh_dao_tao
where id_chuong_trinh = :id_chuong_trinh";
        $data = [
            'id_chuong_trinh'=>$id_chuong_trinh
        ];
        return DB::select($sql, $data)[0]->tongchi;
    }
    public function getTenDonVi($id_don_vi)
    {
        $sql = "select ten_don_vi from don_vi where id_don_vi = :id_don_vi";
        $data = [
            'id_don_vi'=>$id_don_vi
        ];
        return DB::select($sql, $data);
    }
    public function them()
    {
        $sql = "insert into chuong_trinh_dao_tao (id_don_vi, id_khoa_hoc, ma_chuong_trinh, ten_chuong_trinh, ngay_ban_hanh,
                                  tong_tin_chi, trang_thai, ngay_tao)
                                  value(:id_don_vi, :id_khoa_hoc, :ma_chuong_trinh, :ten_chuong_trinh, :ngay_ban_hanh,
                                  :tong_tin_chi, :trang_thai, :ngay_tao)";
        $data = [
            'id_don_vi'=>$this->id_don_vi,
            'id_khoa_hoc'=>$this->id_khoa_hoc,
            'ma_chuong_trinh'=>$this->ma_chuong_trinh,
            'ten_chuong_trinh'=>$this->ten_chuong_trinh,
            'ngay_ban_hanh'=>$this->ngay_ban_hanh,
            'tong_tin_chi'=>$this->tong_tin_chi,
            'trang_thai'=>$this->trang_thai,
            'ngay_tao'=>Carbon::now(),
        ];
        return DB::insert($sql, $data);
    }
    public function tonTaiMaChuongTrinh()
    {
        $sql = "SELECT * FROM chuong_trinh_dao_tao WHERE ma_chuong_trinh=:ma_chuong_trinh;";
        if(DB::select($sql, ['ma_chuong_trinh' => $this->ma_chuong_trinh]))
            return true;
        return false;
    }
    public function tonTaiMaChuongTrinhUpdate()
    {
        $sql = "SELECT * FROM chuong_trinh_dao_tao WHERE ma_chuong_trinh=:ma_chuong_trinh and id_chuong_trinh != :id_chuong_trinh";
        if(DB::select($sql, ['ma_chuong_trinh' => $this->ma_chuong_trinh, 'id_chuong_trinh'=>$this->id_chuong_trinh]))
            return true;
        return false;
    }
    public function xoa()
    {
        $sql = "delete from chuong_trinh_dao_tao where id_chuong_trinh = :id_chuong_trinh";
        if(DB::delete($sql, ['id_chuong_trinh' => $this->id_chuong_trinh]))
            return true;
        return false;
    }
    public function sua()
    {
        $sql = "update chuong_trinh_dao_tao
        set ma_chuong_trinh=:ma_chuong_trinh, id_khoa_hoc = :id_khoa_hoc , ten_chuong_trinh=:ten_chuong_trinh, ngay_ban_hanh=:ngay_ban_hanh, tong_tin_chi=:tong_tin_chi, trang_thai=:trang_thai, ngay_cap_nhat=CURRENT_TIMESTAMP
        where id_chuong_trinh=:id_chuong_trinh";
        $data = [
            'id_chuong_trinh'=>$this->id_chuong_trinh,
            'id_khoa_hoc'=>$this->id_khoa_hoc,
            'ma_chuong_trinh'=>$this->ma_chuong_trinh,
            'ten_chuong_trinh'=>$this->ten_chuong_trinh,
            'ngay_ban_hanh'=>$this->ngay_ban_hanh,
            'tong_tin_chi'=>$this->tong_tin_chi,
            'trang_thai'=>$this->trang_thai,
        ];
        return DB::update($sql, $data);
    }
}
