<?php

namespace App\Models;

use App\Traits\Phong;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PhongModel extends Model
{
    use Phong;
    public function dsPhong(){
    $sql = "SELECT * FROM phong order by ma_phong asc, ten_phong asc ";
    return DB::select($sql);
}
    public  function them(){
        $sql = "insert into phong
    (ma_phong, ten_phong, vi_tri,trang_thai, suc_chua)
    values (:ma_phong,:ten_phong,:vi_tri,:trang_thai,:suc_chua)";
        $data = [
            'ma_phong'=>$this->ma_phong,
            'ten_phong'=>$this->ten_phong,
            'vi_tri'=>$this->vi_tri,
            'trang_thai'=>$this->trang_thai,
            'suc_chua'=>$this->suc_chua
        ];
        return DB::insert($sql, $data);
    }
    public function capNhat(){
        $sql = "UPDATE phong SET ma_phong=:ma_phong,
                       ten_phong=:ten_phong,
                       vi_tri=:vi_tri,
                       ngay_cap_nhat=CURRENT_TIMESTAMP,
                       trang_thai=:trang_thai,suc_chua=:suc_chua

                WHERE id_phong=:id_phong;";
        $data = [
            'ma_phong'=>$this->ma_phong,
            'ten_phong'=>$this->ten_phong,
            'vi_tri'=>$this->vi_tri,
            'trang_thai'=>$this->trang_thai,
            'id_phong'=>$this->id_phong,
            'suc_chua'=>$this->suc_chua
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql =  "Delete from phong where id_phong=:id_phong;";
        return DB::delete($sql,['id_phong'=>$this->id_phong]);
    }
    public function tonTaiMaPhong()
    {
        $sql = "select * from phong where ma_phong = :ma_phong";
        $data = ['ma_phong'=>$this->ma_phong];
        if(DB::select($sql, $data))
            return true;
        return false;
    }
}
