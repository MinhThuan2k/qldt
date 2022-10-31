<?php


namespace App\Setting;


use Illuminate\Support\Facades\DB;

class DangKyHocPhanSetting
{
    public $setting;
    private $yeu = [
        'tinChiToiDa'=>14,
        'tinChiToiThieu'=>5,
    ];
    private $binhThuong = [
        'tinChiToiDa'=>20,
        'tinChiToiThieu'=>10,
    ];
    function __construct($diemTb)
    {
        $setting = DB::selectOne("select * from cai_dat_dang_ky_mon");
        $this->yeu['tinChiToiDa'] = $setting->tin_chi_toi_da_yeu;
        $this->yeu['tinChiToiThieu'] = $setting->tin_chi_toi_thieu_yeu;
        $this->binhThuong['tinChiToiDa'] = $setting->tin_chi_toi_da_binh_thuong;
        $this->binhThuong['tinChiToiThieu'] = $setting->tin_chi_toi_thieu_binh_thuong;
        if($diemTb < 2.0)
        {
            $this->setting=$this->yeu;
        }
        else{
            $this->setting=$this->binhThuong;
        }
    }
}
