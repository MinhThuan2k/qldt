<?php

namespace App\Http\Controllers;

use App\Models\CaiDatDangKyMonModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class CaiDatDangKyMonController extends Controller
{
    public function HienThi(){
        return view('auth.cai-dat-dang-ky-mon.cai-dat-dang-ky-mon',['data'=>(new CaiDatDangKyMonModel()) ->danhSach()]);
    }

    public function postCaiDat(Request $request)
    {
        $cd = new CaiDatDangKyMonModel();

        $cd->id_cai_dat_dang_ky_mon = $request->input('id_cai_dat_dang_ky_mon');
        $cd->tin_chi_toi_da_yeu = $request->input('tin_chi_toi_da_yeu');
        $cd->tin_chi_toi_thieu_yeu = $request->input('tin_chi_toi_thieu_yeu');
        $cd->tin_chi_toi_da_binh_thuong = $request->input('tin_chi_toi_da_binh_thuong');
        $cd->tin_chi_toi_thieu_binh_thuong = $request->input('tin_chi_toi_thieu_binh_thuong');
        $cd->dieu_kien = $request->input('dieu_kien');

        if ($cd->capNhat())
            return ToolsModel::status('Cập nhật thành công',200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }
}
