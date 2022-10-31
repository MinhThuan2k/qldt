<?php

namespace App\Models;

use App\Traits\HocPhan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HocPhanModel extends Model
{
    use HocPhan;
    public function danhsach()
    {
        $sql = "select * from hoc_phan";
        return DB::select($sql);
    }
    public static function danhSachAjax($ten_hoc_phan) // Dành cho select2 ajax
    {
        return DB::table('hoc_phan')->where('ten_hoc_phan', 'like', "%$ten_hoc_phan%")->get();
    }
    public static function getHocPhanById($id_hoc_phan)
    {
        return DB::table('hoc_phan')->where('id_hoc_phan', $id_hoc_phan)->get()->first();
    }
    public function them()
    {
        $sql = "insert into hoc_phan (ma_hoc_phan, ten_hoc_phan, ten_tieng_anh, tin_chi_lt, tin_chi_th, trang_thai, ngay_tao, ngay_cap_nhat)
values (:ma_hoc_phan, :ten_hoc_phan, :ten_tieng_anh, :tin_chi_lt, :tin_chi_th, :trang_thai, CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);";
        $data = [
            'ma_hoc_phan'=>$this->ma_hoc_phan,
            'ten_hoc_phan'=>$this->ten_hoc_phan,
            'ten_tieng_anh'=>$this->ten_tieng_anh,
            'tin_chi_lt'=>$this->tin_chi_lt,
            'tin_chi_th'=>$this->tin_chi_th,
            'trang_thai'=>$this->trang_thai,
        ];
        return DB::insert($sql, $data);
    }

    public function sua()
    {
        $sql = "Update hoc_phan set ma_hoc_phan=:ma_hoc_phan, ten_hoc_phan=:ten_hoc_phan,
                    ten_tieng_anh=:ten_tieng_anh, tin_chi_lt=:tin_chi_lt, tin_chi_th=:tin_chi_th, trang_thai=:trang_thai,
                    ngay_cap_nhat = CURRENT_TIMESTAMP where id_hoc_phan = :id_hoc_phan";
        $data = [
            'id_hoc_phan'=>$this->id_hoc_phan,
            'ma_hoc_phan'=>$this->ma_hoc_phan,
            'ten_hoc_phan'=>$this->ten_hoc_phan,
            'ten_tieng_anh'=>$this->ten_tieng_anh,
            'tin_chi_lt'=>$this->tin_chi_lt,
            'tin_chi_th'=>$this->tin_chi_th,
            'trang_thai'=>$this->trang_thai,
        ];
        return DB::update($sql, $data);
    }

    public function xoa()
    {
        $sql = "delete from hoc_phan where id_hoc_phan = :id";
        $data = ['id'=>$this->id_hoc_phan];
        return DB::delete($sql, $data);
    }
    public function tonTaiMaHocPhan()
    {
        $sql = "select * from hoc_phan where ma_hoc_phan = :ma_hoc_phan";
        $data = ['ma_hoc_phan'=>$this->ma_hoc_phan];
        if(DB::select($sql, $data))
            return true;
        return false;
    }
}
