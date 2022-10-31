<?php

namespace App\Http\Controllers;

use App\Models\HeDaoTaoModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class HeDaoTaoController extends Controller
{
    public function getViewHeDaoTao()
    {
        $hdt = new HeDaoTaoModel();
        return view('auth.he-dao-tao.he-dao-tao', ['data'=>$hdt->dsHeDaoTao()]);
    }

    public function putHeDaoTao(Request $request)
    {
        $hdt = new HeDaoTaoModel();
        $hdt->ma_he_dao_tao = $request->input('ma_he_dao_tao');
        $hdt->ten_he_dao_tao = $request->input('ten_he_dao_tao');

        if($hdt->tonTaiMaHeDaoTao())
            return ToolsModel::status('Mã hệ đào tạo đã tồn tại', 500);

        if ($hdt->them())
            return ToolsModel::status('Thêm thành công', 200);
        return ToolsModel::status('Thêm thất bại', 500);
    }


    public function deleteHeDaoTao(Request $request)
    {
        $hdt = new HeDaoTaoModel();
        $hdt->id_he_dao_tao = $request->input('id_he_dao_tao');
        if ($hdt->xoa())
            return ToolsModel::status('Xóa thành công',200);
        return ToolsModel::status('Xóa thất bại', 500);
    }

    public function postHeDaoTao(Request $request)
    {
        $hdt = new HeDaoTaoModel();
        $hdt->id_he_dao_tao = $request->input('id_he_dao_tao');
        $hdt->ma_he_dao_tao = $request->input('ma_he_dao_tao');
        $hdt->ten_he_dao_tao = $request->input('ten_he_dao_tao');

        if($hdt->tonTaiMaHeDaoTao_capNhat())
            return ToolsModel::status('Mã hệ đào tạo đã tồn tại', 500);

        if ($hdt->capNhat())
            return ToolsModel::status('Cập nhật thành công',200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }

}
