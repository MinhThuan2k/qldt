<?php

namespace App\Models;

use App\Traits\NamHoc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NamHocModel extends Model
{
    use NamHoc;

    public function danhSach()
    {
        $sql = "SELECT * FROM nam_hoc;";
        return DB::select($sql);
    }

    public function them()
    {
        $sql = "INSERT INTO nam_hoc (ma_nam_hoc, ten_nam_hoc) VALUES (:ma_nam_hoc, :ten_nam_hoc)";
        $data =[
            'ma_nam_hoc' => $this->ma_nam_hoc,
            'ten_nam_hoc' => $this->ten_nam_hoc,
        ];
        return DB::insert($sql, $data);
    }

    public function capNhat(){
        $sql = "UPDATE nam_hoc SET ma_nam_hoc=:ma_nam_hoc,ten_nam_hoc=:ten_nam_hoc, ngay_cap_nhat=current_timestamp WHERE id_nam_hoc=:id_nam_hoc;";
        $data = [
            'id_nam_hoc' => $this->id_nam_hoc,
            'ma_nam_hoc' => trim($this->ma_nam_hoc),
            'ten_nam_hoc' => trim($this->ten_nam_hoc),
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM nam_hoc WHERE id_nam_hoc=:id_nam_hoc;";
        return DB::delete($sql, ['id_nam_hoc' => $this->id_nam_hoc]);
    }



    public function tonTaiMaNamHoc(){
        $sql = "SELECT * FROM nam_hoc WHERE ma_nam_hoc=:ma_nam_hoc;";
        if(DB::select($sql, ['ma_nam_hoc' => $this->ma_nam_hoc]))
            return true;
        return false;
    }
}
