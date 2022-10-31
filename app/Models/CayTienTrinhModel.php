<?php

namespace App\Models;

use App\Traits\HocPhan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CayTienTrinhModel extends Model
{
    use HocPhan;
    public function danhsach()
    {
        $sql = "select hoc_phan_theo_ctdt.id_hoc_phan, hoc_phan_theo_ctdt.id_chuong_trinh ,
       ma_hoc_phan, ten_hoc_phan, ten_tieng_anh, tin_chi_lt, tin_chi_th, hoc_phan.trang_thai, hoc_ky
                from hoc_phan, hoc_phan_theo_ctdt, chuong_trinh_dao_tao
                where chuong_trinh_dao_tao.id_chuong_trinh = hoc_phan_theo_ctdt.id_chuong_trinh and hoc_phan_theo_ctdt.id_hoc_phan = hoc_phan.id_hoc_phan
                and chuong_trinh_dao_tao.id_chuong_trinh = :id_chuong_trinh";
        $data = [
            'id_chuong_trinh'=>$this->id_chuong_trinh
        ];
        return DB::select($sql, $data);
    }
    public function danhsachDatable()
    {
        $sql = "select hoc_phan_theo_ctdt.id_hoc_phan, hoc_phan_theo_ctdt.id_chuong_trinh , ma_hoc_phan,
       ten_hoc_phan, ten_tieng_anh, tin_chi_lt, tin_chi_th, hoc_phan.trang_thai,
       (concat(tin_chi_lt, ':', tin_chi_th)) as tin_chi, hoc_ky, (select group_concat(ten_hoc_phan separator'<br>') from de_cuong, hoc_phan
where de_cuong.id_hoc_phan=hoc_phan_theo_ctdt.id_hoc_phan and
      de_cuong.id_chuong_trinh = hoc_phan_theo_ctdt.id_chuong_trinh and hoc_phan.id_hoc_phan = de_cuong.mon_hoc_truoc) as mon_tien_quyet
                from hoc_phan, hoc_phan_theo_ctdt, chuong_trinh_dao_tao
                where chuong_trinh_dao_tao.id_chuong_trinh = hoc_phan_theo_ctdt.id_chuong_trinh
                  and hoc_phan_theo_ctdt.id_hoc_phan = hoc_phan.id_hoc_phan
                and chuong_trinh_dao_tao.id_chuong_trinh=:id_chuong_trinh";
        $data = [
            'id_chuong_trinh'=>$this->id_chuong_trinh
        ];
        return DB::select($sql, $data);
    }
    public function them()
    {
        $sql = "insert into hoc_phan_theo_ctdt(id_chuong_trinh, id_hoc_phan, hoc_ky, ngay_cap_nhat) value(:id_chuong_trinh, :id_hoc_phan, :hoc_ky, CURRENT_TIMESTAMP )";
        $data = [
            'id_chuong_trinh'=>$this->id_chuong_trinh,
            'id_hoc_phan'=>$this->id_hoc_phan,
            'hoc_ky'=>$this->hoc_ky,
        ];
        return DB::insert($sql, $data);
    }
    public function them_de_cuong()
    {
        $sql = "insert into de_cuong (id_chuong_trinh, id_hoc_phan, mon_hoc_truoc, ngay_tao)
values (:id_chuong_trinh, :id_hoc_phan, :mon_hoc_truoc, CURRENT_TIMESTAMP);";
        $data = [
            'id_chuong_trinh'=>$this->id_chuong_trinh,
            'id_hoc_phan'=>$this->id_hoc_phan,
            'mon_hoc_truoc'=>$this->mon_hoc_truoc,
        ];
        return DB::insert($sql, $data);
    }

    public function xoa()
    {
        $data = [
            'id_hoc_phan' => $this->id_hoc_phan,
            'id_chuong_trinh' => $this->id_chuong_trinh,
        ];
        $sql = "delete from de_cuong where id_hoc_phan = :id_hoc_phan and id_chuong_trinh = :id_chuong_trinh";
        DB::delete($sql, $data);
        $sql = "delete from hoc_phan_theo_ctdt where id_hoc_phan = :id_hoc_phan and id_chuong_trinh = :id_chuong_trinh";
        return DB::delete($sql, $data);;
    }
    public function danhSachHocPhan()
    {
        $sql = "select * from hoc_phan";
        return DB::select($sql);
    }

    public function getTenChuongTrinh($id)
    {
        $sql = "select ten_chuong_trinh from chuong_trinh_dao_tao where id_chuong_trinh = :id";
        $data = ['id'=>$id];
        return DB::select($sql, $data);
    }
}
