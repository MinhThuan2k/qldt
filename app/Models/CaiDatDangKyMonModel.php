<?php

namespace App\Models;


use App\Traits\CaiDatDangKyMon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CaiDatDangKyMonModel extends Model
{
    use CaiDatDangKyMon;
    public function danhSach()
    {
        $sql = "SELECT * FROM cai_dat_dang_ky_mon";
        return DB::select($sql);
    }

    public function capNhat(){
        $sql = "UPDATE cai_dat_dang_ky_mon SET tin_chi_toi_da_yeu=:tin_chi_toi_da_yeu,
                               tin_chi_toi_thieu_yeu=:tin_chi_toi_thieu_yeu,
                               tin_chi_toi_da_binh_thuong=:tin_chi_toi_da_binh_thuong,
                               tin_chi_toi_thieu_binh_thuong=:tin_chi_toi_thieu_binh_thuong,
                               dieu_kien=:dieu_kien
                               WHERE id_cai_dat_dang_ky_mon=:id_cai_dat_dang_ky_mon;";
        $data = [
            'id_cai_dat_dang_ky_mon'=>$this->id_cai_dat_dang_ky_mon,
            'tin_chi_toi_da_yeu'=>$this->tin_chi_toi_da_yeu,
            'tin_chi_toi_thieu_yeu'=>$this->tin_chi_toi_thieu_yeu,
            'tin_chi_toi_da_binh_thuong'=>$this->tin_chi_toi_da_binh_thuong,
            'tin_chi_toi_thieu_binh_thuong'=>$this->tin_chi_toi_thieu_binh_thuong,
            'dieu_kien'=>$this->dieu_kien,
        ];
        return DB::update($sql, $data);
    }


}

