<?php

namespace App\Models;

use App\Traits\TaiKhoan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaiKhoanModel extends Model
{
    use TaiKhoan;

    public function dsTaiKhoan(){
        $sql = "SELECT * FROM tai_khoan;";
        return DB::select($sql);
    }

    public function them(){
        $sql = "INSERT INTO tai_khoan (ho_ten, email) VALUES (:ho_ten, :email)";
        $data = [
            'ho_ten' => $this->ho_ten,
            'email' => $this->email,
        ];
        return DB::insert($sql, $data);
    }
}
