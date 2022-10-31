<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Traits\NganhHoc;

class NganhHocModel extends Model
{
    use NganhHoc;
    public function danhsach()
    {
        $sql = "select * from nganh_hoc";
        return DB::select($sql);
    }
    public function them()
    {
        $sql = "insert into nganh_hoc (ma_nganh, ten_nganh)
values (:ma_nganh, :ten_nganh);";
        $data = ['ma_nganh'=>$this->ma_nganh,
            'ten_nganh'=>$this->ten_nganh];
        return DB::insert($sql, $data);
    }
    public function sua()
    {
        $sql = "update nganh_hoc set ma_nganh = :ma_nganh, ten_nganh = :ten_nganh, ngay_cap_nhat = CURRENT_TIMESTAMP where id_nganh = :id_nganh";
        $data = [
            'ma_nganh'=>$this->ma_nganh,
            'ten_nganh'=>$this->ten_nganh,
            'id_nganh'=>$this->id_nganh
        ];
        return DB::update($sql, $data);
    }
    public function xoa()
    {
        $sql = "delete from nganh_hoc where id_nganh = :id_nganh";
        $data = ['id_nganh'=>$this->id_nganh];
        return DB::delete($sql, $data);
    }

    public function tonTaiMaNganh()
    {
        $sql = "select * from nganh_hoc where ma_nganh = :ma_nganh";
        $data = ['ma_nganh'=>$this->ma_nganh];
        if(DB::select($sql, $data))
            return true;
        return false;
    }
}
