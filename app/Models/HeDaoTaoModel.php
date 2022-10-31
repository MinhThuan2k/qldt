<?php

namespace App\Models;

use App\Traits\HeDaoTao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HeDaoTaoModel extends Model
{
    use HeDaoTao;

    public function dsHeDaoTao()
    {
        $sql = "SELECT * FROM he_dao_tao ORDER BY ngay_tao";
        return DB::select($sql);
    }

    public function them(){
        $sql = "INSERT INTO he_dao_tao (ma_he_dao_tao, ten_he_dao_tao) VALUES (:ma_he_dao_tao,:ten_he_dao_tao)";
        $data = [
            'ma_he_dao_tao'=> trim($this ->ma_he_dao_tao),
            'ten_he_dao_tao'=> trim($this ->ten_he_dao_tao),
        ];
        return DB::insert($sql, $data);
    }

    public function xoa(){
        $sql = "DELETE FROM he_dao_tao WHERE id_he_dao_tao=:id_he_dao_tao";
        return DB::delete($sql, ['id_he_dao_tao'=>$this->id_he_dao_tao]);
    }

    public function capNhat(){
        $sql = "UPDATE he_dao_tao SET
                      ma_he_dao_tao=:ma_he_dao_tao,
                      ten_he_dao_tao=:ten_he_dao_tao,
                      ngay_cap_nhat=CURRENT_TIMESTAMP
                      WHERE id_he_dao_tao=:id_he_dao_tao;";
        $data = [
            'ma_he_dao_tao' => trim($this->ma_he_dao_tao),
            'ten_he_dao_tao' => trim($this->ten_he_dao_tao),
            'id_he_dao_tao' => trim($this->id_he_dao_tao),
        ];
        return DB::update($sql, $data);
    }

    public function tonTaiMaHeDaoTao(){
        $sql = "SELECT id_he_dao_tao FROM he_dao_tao WHERE ma_he_dao_tao=:ma_he_dao_tao;";
        if (DB::select($sql, ['ma_he_dao_tao'=> trim($this->ma_he_dao_tao)]))
            return true;
        return false;
    }

    public function tonTaiMaHeDaoTao_capNhat(){
        $sql = "SELECT id_he_dao_tao FROM he_dao_tao WHERE ma_he_dao_tao=:ma_he_dao_tao AND id_he_dao_tao != :id_he_dao_tao;";
        if (DB::select($sql, ['ma_he_dao_tao'=> trim($this->ma_he_dao_tao),
            'id_he_dao_tao'=> trim($this->id_he_dao_tao)]))
            return true;
        return false;
    }
}
