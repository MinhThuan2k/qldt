<?php

namespace App\Http\Controllers;

use App\Models\DonViModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class DonViController extends Controller
{
    public function getDonVi(){
        return view('auth.don-vi.don-vi', ['ds' => (new DonViModel())->danhSach()]);
    }

    public function getDonViCT($id_don_vi){
        $dv = new DonViModel();
        $dv->id_don_vi = $id_don_vi;
        return view('auth.don-vi.chi-tiet', [
            'ct' => $dv->chiTiet()
        ]);
    }

    public function putDonVi(Request $request){
        $donvi = new DonViModel();
        $donvi->ma_don_vi = $request->input('ma_don_vi');
        $donvi->ten_don_vi = $request->input('ten_don_vi');
        $donvi->vi_tri = $request->input('vi_tri');
        $donvi->khoa_chuyen_mon = $request->input('khoa_chuyen_mon');

        if($donvi->tonTaiMaDonVi())
            return ToolsModel::status('Mã đơn vị đã tồn tại', 500);

        if($donvi->them())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }

    public function postDonVi(Request $request){
        $donvi = new DonViModel();
        $donvi->id_don_vi = $request->input('id_don_vi');
        $donvi->ma_don_vi = $request->input('ma_don_vi');
        $donvi->ten_don_vi = $request->input('ten_don_vi');
        $donvi->vi_tri = $request->input('vi_tri');
        $donvi->khoa_chuyen_mon = $request->input('khoa_chuyen_mon');
        if($donvi->capNhat())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteDonVi(Request $request){
        $donvi = new DonViModel();
        $donvi->id_don_vi = $request->input('id_don_vi');
        if($donvi->xoa())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }
}
