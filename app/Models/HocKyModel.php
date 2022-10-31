<?php

namespace App\Models;

use App\Traits\HocKy;
use App\Traits\NamHoc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HocKyModel extends Model
{
    use HocKy, NamHoc;


    public function dsHocKy(){
        $sql = "SELECT * FROM hoc_ky, nam_hoc where hoc_ky.id_nam_hoc=nam_hoc.id_nam_hoc";
        return DB::select($sql);
    }
    public function dsNamHoc(){
        $sql = "SELECT * FROM nam_hoc";
        return DB::select($sql);
    }

    public  function themHK(){
        $sql = "insert into hoc_ky (id_nam_hoc, ma_hoc_ky, ten_hoc_ky, ngay_bat_dau, tuan_bat_dau, ngay_ket_thuc, tuan_ket_thuc,trang_thai) values (:id_nam_hoc,:ma_hoc_ky,:ten_hoc_ky,:ngay_bat_dau,:tuan_bat_dau,:ngay_ket_thuc,:tuan_ket_thuc,:trang_thai)";
        $data = [
            'id_nam_hoc'=>$this->id_nam_hoc,
            'ma_hoc_ky'=>$this->ma_hoc_ky,
            'ten_hoc_ky'=>$this->ten_hoc_ky,
            'ngay_bat_dau'=>$this->ngay_bat_dau,
            'tuan_bat_dau'=>$this->tuan_bat_dau,
            'ngay_ket_thuc'=>$this->ngay_ket_thuc,
            'tuan_ket_thuc'=>$this->tuan_ket_thuc,
            'trang_thai'=>$this->trang_thai
        ];
        return DB::insert($sql, $data);
    }

    public function capNhat(){
        $sql = "UPDATE hoc_ky SET id_nam_hoc=:id_nam_hoc,
                       ma_hoc_ky=:ma_hoc_ky,
                       ten_hoc_ky=:ten_hoc_ky,
                       ngay_bat_dau=:ngay_bat_dau,
                       tuan_bat_dau=:tuan_bat_dau,
                       ngay_ket_thuc=:ngay_ket_thuc,
                       tuan_ket_thuc=:tuan_ket_thuc,
                       ngay_cap_nhat=CURRENT_TIMESTAMP,
                       trang_thai=:trang_thai
                WHERE id_hoc_ky=:id_hoc_ky;";
        $data = [

            'id_nam_hoc' => $this->id_nam_hoc,
            'ma_hoc_ky' => $this->ma_hoc_ky,
            'ten_hoc_ky' => $this->ten_hoc_ky,
            'ngay_bat_dau' => $this->ngay_bat_dau,
            'tuan_bat_dau' => $this->tuan_bat_dau,
            'ngay_ket_thuc' => $this->ngay_ket_thuc,
            'tuan_ket_thuc' => $this->tuan_ket_thuc,
            'trang_thai' => $this->trang_thai,
            'id_hoc_ky'=>$this->id_hoc_ky
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql =  "Delete from hoc_ky where id_hoc_ky=:id_hoc_ky;";
        return DB::delete($sql,['id_hoc_ky'=>$this->id_hoc_ky]);
    }
    public function tonTaiMaHocKy()
    {
        $sql = "select * from hoc_ky where ma_hoc_ky = :ma_hoc_ky";
        $data = ['ma_hoc_ky'=>$this->ma_hoc_ky];
        if(DB::select($sql, $data))
            return true;
        return false;
    }
    public function tonTaiMaHocKyUpdate()
    {
        $sql = "SELECT * FROM hoc_ky WHERE ma_hoc_ky=:ma_hoc_ky and id_hoc_ky != :id_hoc_ky";
        if(DB::select($sql, ['ma_hoc_ky' => $this->ma_hoc_ky, 'id_hoc_ky'=>$this->id_hoc_ky]))
            return true;
        return false;
    }
    public static function getHocKy($id)
    {
        $sql = "select * from hoc_ky where id_hoc_ky = :id_hoc_ky";
        $data = [
            'id_hoc_ky'=>$id,
        ];
        return DB::selectOne($sql, $data);
    }
}
