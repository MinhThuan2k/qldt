<?php

namespace App\Models;

use App\Traits\DonVi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DonViModel extends Model
{
    use DonVi;

    public function danhSach(){
        $sql = "SELECT * FROM don_vi ORDER BY khoa_chuyen_mon DESC, ten_don_vi ASC, ngay_tao;";
        return DB::select($sql);
    }

    public function them(){
        $sql = "INSERT INTO don_vi (ma_don_vi, ten_don_vi, vi_tri, khoa_chuyen_mon) VALUES (:ma_don_vi, :ten_don_vi, :vi_tri, :khoa_chuyen_mon)";
        $data = [
            'ma_don_vi' => trim($this->ma_don_vi),
            'ten_don_vi' => trim($this->ten_don_vi),
            'vi_tri' => trim($this->vi_tri),
            'khoa_chuyen_mon' => $this->khoa_chuyen_mon
        ];
        return DB::insert($sql, $data);
    }

    public function capNhat(){
        $sql = "UPDATE don_vi SET ma_don_vi=:ma_don_vi,ten_don_vi=:ten_don_vi,vi_tri=:vi_tri,khoa_chuyen_mon=:khoa_chuyen_mon, ngay_cap_nhat=current_timestamp WHERE id_don_vi=:id_don_vi;";
        $data = [
            'id_don_vi' => $this->id_don_vi,
            'ma_don_vi' => trim($this->ma_don_vi),
            'ten_don_vi' => trim($this->ten_don_vi),
            'vi_tri' => trim($this->vi_tri),
            'khoa_chuyen_mon' => $this->khoa_chuyen_mon
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM don_vi WHERE id_don_vi=:id_don_vi;";
        return DB::delete($sql, ['id_don_vi' => $this->id_don_vi]);
    }

    public function tonTaiMaDonVi(){
        $sql = "SELECT * FROM don_vi WHERE ma_don_vi=:ma_don_vi;";
        if(DB::select($sql, ['ma_don_vi' => $this->ma_don_vi]))
            return true;
        return false;
    }

    public function chiTiet(){
        $sql = "SELECT * FROM don_vi WHERE id_don_vi=:id_don_vi;";
        $data = DB::selectOne($sql, ['id_don_vi' => $this->id_don_vi]);
        if($data)
            return $data;
        return false;
    }

    public static function getTenDonVi($id_don_vi)
    {
        $sql = "select ten_don_vi from don_vi where id_don_vi = :id_don_vi";
        $data = [
            'id_don_vi'=>$id_don_vi,
        ];
        return DB::select($sql, $data);
    }
}
