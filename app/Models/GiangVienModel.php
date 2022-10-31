<?php

namespace App\Models;

use App\Traits\ChucVu;
use App\Traits\DonVi;
use App\Traits\GiangVien;
use App\Traits\HocVi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;



class GiangVienModel extends Model
{
    use GiangVien, DonVi, HocVi, ChucVu;
    public function dsGiangVien(){
        $sql = "SELECT * FROM giang_vien, chuc_vu, hoc_vi, don_vi where giang_vien.id_chuc_vu=chuc_vu.id_chuc_vu and giang_vien.id_hoc_vi=hoc_vi.id_hoc_vi and giang_vien.id_don_vi=don_vi.id_don_vi";
        return DB::select($sql);
    }
    public function dsGiangVienTheoDonVi(){
        $sql = "SELECT *, giang_vien.trang_thai FROM giang_vien, chuc_vu,don_vi, hoc_vi
    where giang_vien.id_chuc_vu=chuc_vu.id_chuc_vu
  and giang_vien.id_hoc_vi=hoc_vi.id_hoc_vi
  and giang_vien.id_don_vi=don_vi.id_don_vi and
          giang_vien.id_don_vi=:id_don_vi order by ten_chuc_vu desc, ten_hoc_vi desc";
        return DB::select($sql, ['id_don_vi' =>$this->id_don_vi]);
    }
    public function getTenDonVi($id_don_vi)
    {
        $sql = "select ten_don_vi from don_vi where id_don_vi = :id_don_vi";
        $data = [
            'id_don_vi'=>$id_don_vi
        ];
        return DB::select($sql, $data);
    }
    public function CountTS(){
        $sql = "SELECT count(ten_hoc_vi) as SL FROM giang_vien, chuc_vu,don_vi, hoc_vi
    where giang_vien.id_chuc_vu=chuc_vu.id_chuc_vu
  and giang_vien.id_hoc_vi=hoc_vi.id_hoc_vi
  and giang_vien.id_don_vi=don_vi.id_don_vi and giang_vien.id_don_vi=:id_don_vi and ten_hoc_vi = 'Tiến sĩ'";
        return DB::select($sql, ['id_don_vi' =>$this->id_don_vi]);
    }
    public function CountThS(){
        $sql = "SELECT count(ten_hoc_vi) as SL FROM giang_vien, chuc_vu,don_vi, hoc_vi
    where giang_vien.id_chuc_vu=chuc_vu.id_chuc_vu
  and giang_vien.id_hoc_vi=hoc_vi.id_hoc_vi
  and giang_vien.id_don_vi=don_vi.id_don_vi and giang_vien.id_don_vi=:id_don_vi and ten_hoc_vi = 'Thạc sĩ'";
        return DB::select($sql, ['id_don_vi' =>$this->id_don_vi]);
    }
    public function CountDh(){
        $sql = "SELECT count(ten_hoc_vi) as SL FROM giang_vien, chuc_vu,don_vi, hoc_vi
    where giang_vien.id_chuc_vu=chuc_vu.id_chuc_vu
  and giang_vien.id_hoc_vi=hoc_vi.id_hoc_vi
  and giang_vien.id_don_vi=don_vi.id_don_vi and giang_vien.id_don_vi=:id_don_vi and ten_hoc_vi = 'Cao học'";
        return DB::select($sql, ['id_don_vi' =>$this->id_don_vi]);
    }
    public function CountNCS(){
        $sql = "SELECT count(ten_hoc_vi) as SL FROM giang_vien, chuc_vu,don_vi, hoc_vi
    where giang_vien.id_chuc_vu=chuc_vu.id_chuc_vu
  and giang_vien.id_hoc_vi=hoc_vi.id_hoc_vi
  and giang_vien.id_don_vi=don_vi.id_don_vi and giang_vien.id_don_vi=:id_don_vi and ten_hoc_vi = 'Nghiên cứu sinh'";
        return DB::select($sql, ['id_don_vi' =>$this->id_don_vi]);
    }
    public function dsDonVi(){
        $sql = "Select * from don_vi";
        return DB::select($sql);
    }
    public function dsChucVu(){
        $sql = "Select * from chuc_vu";
        return DB::select($sql);
    }
    public function dsHocVi(){
        $sql = "Select * from hoc_vi";
        return DB::select($sql);
    }
    public  function them(){
        $sql = "insert into giang_vien(id_don_vi,
                       ho,
                       ten,
                       email,
                       sdt,
                       dia_chi,
                       cmnd,
                       anh,
                       trang_thai,
                       id_chuc_vu,
                       id_hoc_vi) values (:id_don_vi,:ho,:ten,:email,:sdt,:dia_chi,:cmnd,:anh,:trang_thai,:id_chuc_vu,:id_hoc_vi)";
        $data = [
            'id_don_vi'=>$this->id_don_vi,
            'ho'=>$this->ho,
            'ten'=>$this->ten,
            'email'=>$this->email,
            'sdt'=>$this->sdt,
            'dia_chi'=>$this->dia_chi,
            'cmnd'=>$this->cmnd,
            'anh'=>$this->anh,
            'trang_thai'=>$this->trang_thai,
            'id_chuc_vu'=>$this->id_chuc_vu,
            'id_hoc_vi'=>$this->id_hoc_vi,
        ];
        return DB::insert($sql, $data);
    }

    public function capNhat(){
        $sql = "UPDATE giang_vien SET id_don_vi=:id_don_vi,
                       ho=:ho,
                       ten=:ten,
                       email=:email,
                       sdt=:sdt,
                       dia_chi=:dia_chi,
                       cmnd=:cmnd,
                       ngay_cap_nhat=CURRENT_TIMESTAMP,
                       trang_thai=:trang_thai,
                      id_chuc_vu=:id_chuc_vu,
                      id_hoc_vi=:id_hoc_vi
                WHERE id_giang_vien=:id_giang_vien;";
        $data = [
            'id_don_vi'=>$this->id_don_vi,
            'ho'=>$this->ho,
            'ten'=>$this->ten,
            'email'=>$this->email,
            'sdt'=>$this->sdt,
            'dia_chi'=>$this->dia_chi,
            'cmnd'=>$this->cmnd,
            'trang_thai'=>$this->trang_thai,
            'id_chuc_vu'=>$this->id_chuc_vu,
            'id_hoc_vi'=>$this->id_hoc_vi,
            'id_giang_vien'=>$this->id_giang_vien
        ];
        return DB::update($sql, $data);
    }

    public function xoa(){
        $sql =  "Delete from giang_vien where id_giang_vien=:id_giang_vien;";
        return DB::delete($sql,['id_giang_vien'=>$this->id_giang_vien]);
    }
    public function xoaDuLieuGiangVien($id_don_vi){
        $sql =  "Delete from giang_vien where id_don_vi=:id_don_vi;";
        return DB::delete($sql,['id_don_vi'=>$id_don_vi]);
    }
    public static function danhSachAjax($ten_giang_vien) // Dành cho select2 ajax
    {
    
        return DB::table('giang_vien')->where('ho','like', "%$ten_giang_vien%")->orwhere('ten','like', "%$ten_giang_vien%")
                                ->orwhere('id_giang_vien','like', "%$ten_giang_vien%")->get();
    }
}
