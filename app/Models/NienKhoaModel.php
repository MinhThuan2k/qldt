<?php

namespace App\Models;

use App\Traits\NienKhoa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NienKhoaModel extends Model
{
    use NienKhoa;

    public function dsNienKhoa(){
        $sql = "SELECT * FROM khoa_hoc";
        return DB::select($sql);
    }

    public  function them(){
        $sql = "INSERT INTO khoa_hoc(ma_khoa_hoc, nam_nhap_hoc, nien_khoa, nam_het_han)
                VALUES (:ma_khoa_hoc, :nam_nhap_hoc, :nien_khoa, :nam_het_han)";
        $data = [
            'ma_khoa_hoc' => $this->ma_khoa_hoc,
            'nam_nhap_hoc' => $this->nam_nhap_hoc,
            'nien_khoa' => $this->nien_khoa,
            'nam_het_han' => $this->nam_het_han
        ];
        return DB::insert($sql, $data);
    }

    public function capNhat(){
        $sql = "UPDATE khoa_hoc SET ma_khoa_hoc=:ma_khoa_hoc,
                    nam_nhap_hoc=:nam_nhap_hoc,
                    nien_khoa=:nien_khoa,
                    nam_het_han=:nam_het_han,
                    ngay_cap_nhat=CURRENT_TIMESTAMP
                    WHERE id_khoa_hoc=:id_khoa_hoc;";
        $data = [
            'id_khoa_hoc' => $this->id_khoa_hoc,
            'ma_khoa_hoc' => trim($this->ma_khoa_hoc),
            'nam_nhap_hoc' => trim($this->nam_nhap_hoc),
            'nien_khoa' => trim($this->nien_khoa),
            'nam_het_han' => trim($this->nam_het_han),
        ];
        return DB::update($sql, $data);
    }
    public function xoa(){
        $sql =  "DELETE FROM khoa_hoc where id_khoa_hoc=:id_khoa_hoc;";
        return DB::delete($sql,['id_khoa_hoc'=>$this->id_khoa_hoc]);
    }
}
