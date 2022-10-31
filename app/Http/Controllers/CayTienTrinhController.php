<?php

namespace App\Http\Controllers;

use App\Models\CayTienTrinhModel;
use App\Models\DonViModel;
use App\Models\HocPhanModel;
use App\Models\ToolsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CayTienTrinhController extends Controller
{
    public function getCayTienTrinh($id_don_vi, $id_chuong_trinh)
    {
        $data = new CayTienTrinhModel();
        $data->id_chuong_trinh = $id_chuong_trinh;
        return view('auth.cay-tien-trinh.cay-tien-trinh',
            [   'data' => $data->danhsach(),
                'hocphan'=>$data->danhSachHocPhan(),
                'id_chuong_trinh'=>$id_chuong_trinh,
                'ten_chuong_trinh'=>$data->getTenChuongTrinh($id_chuong_trinh)[0]->ten_chuong_trinh,
                'ten_don_vi'=>DonViModel::getTenDonVi($id_don_vi)[0]->ten_don_vi,
                'id_don_vi'=>$id_don_vi,
                ]
        );
    }
    public function getCayTienTrinhDatatable(Request $r)
    {
        $data = new CayTienTrinhModel();
        $data->id_chuong_trinh = $r->id_chuong_trinh;
        return json_encode($data->danhsachDatable());
    }
    public function getHocPhanById(Request $r)
    {
        $id = $r->id_hoc_phan;
        return json_encode(HocPhanModel::getHocPhanById($id));
    }
    public function putCayTienTrinh(Request $r)
    {
        try{
            $noError = true;
            $cay = new CayTienTrinhModel();
            $cay->id_hoc_phan = $r->id_hoc_phan;
            $cay->id_chuong_trinh = $r->id_chuong_trinh;
            $cay->hoc_ky = $r->hocky;
            $noError &= $cay->them();
            if(isset($r->id_mon_tien_quyet))
            {
                foreach($r->id_mon_tien_quyet as $mon_tien_quyet)
                {
                    $cay->mon_hoc_truoc = $mon_tien_quyet;
                    $noError &= $cay->them_de_cuong();
                }
            }
            if($noError)
                return ToolsModel::status('Sửa thông tin thành công', 200);
            else
                return ToolsModel::status('Sửa thông tin thất bại', 500);
        }
        catch (\Exception $e)
        {
            if($e->errorInfo[1] == 1062)
                return ToolsModel::status('Học phần đã tồn tại!', 500);
            else
                return ToolsModel::status('Sửa thông tin thất bại', 500);
        }
    }
    public function deleteCayTienTrinh(Request $r)
    {
        $data = new CayTienTrinhModel();
        $data->id_chuong_trinh = $r->id_chuong_trinh;
        $data->id_hoc_phan = $r->id_hoc_phan;
        if($data->xoa())
            return ToolsModel::status('Xóa học phần thành công', 200);
        return ToolsModel::status('Xóa học phần thất bại', 500);
    }
}
