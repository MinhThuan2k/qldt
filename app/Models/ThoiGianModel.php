<?php

namespace App\Models;

use App\Traits\ThoiGian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ThoiGianModel extends Model
{
    use ThoiGian;
    public function danhsach()
    {
        $sql = "Select * from thoi_gian";
        return DB::select($sql);
    }
    public function them()
    {
        $sql = "insert into thoi_gian (tiet_ca, gio_bat_dau, gio_ket_thuc, trang_thai)
values (:tiet_ca, :gio_bat_dau, :gio_ket_thuc, :trang_thai)";
        $data = [
            'tiet_ca' => $this->tiet_ca,
            'gio_bat_dau' => $this->gio_bat_dau,
            'gio_ket_thuc' => $this->gio_ket_thuc,
            'trang_thai' => $this->trang_thai,
        ];
        return DB::insert($sql, $data);
    }
    public function sua()
    {
        $sql = "update thoi_gian
set tiet_ca = :tiet_ca, gio_bat_dau = :gio_bat_dau, gio_ket_thuc = :gio_ket_thuc, trang_thai = :trang_thai, ngay_cap_nhat = CURRENT_TIMESTAMP
where id_thoi_gian_hoc = :id_thoi_gian_hoc";
        $data = [
            'tiet_ca'=>$this->tiet_ca,
            'gio_bat_dau'=>$this->gio_bat_dau,
            'gio_ket_thuc'=>$this->gio_ket_thuc,
            'trang_thai'=>$this->trang_thai,
            'id_thoi_gian_hoc'=>$this->id_thoi_gian_hoc,
        ];
        return DB::update($sql, $data);
    }
    public function xoa()
    {
        $sql = "delete from thoi_gian where id_thoi_gian_hoc = :id";
        $data = [
          'id'=>$this->id_thoi_gian_hoc
        ];
        return DB::delete($sql, $data);
    }
}
