<?php

namespace App\Http\Controllers;

use App\Models\NienKhoaModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class NienKhoaController extends Controller
{
    public  function getNienKhoa(){
        return view('auth.nien-khoa.nien-khoa',['data'=>(new NienKhoaModel()) ->dsNienKhoa()]);

    }
    public function putNienKhoa(Request $request){
        $khoahoc = new NienKhoaModel();
        $khoahoc->ma_khoa_hoc = $request->input('ma_khoa_hoc');
        $khoahoc->nam_nhap_hoc = $request->input('nam_nhap_hoc');
        $khoahoc->nien_khoa = $request->input('nien_khoa');
        $khoahoc->nam_het_han = $request->input('nam_het_han');
        if($khoahoc->them())
            return ToolsModel::status('Thêm thành công', 200);
        return ToolsModel::status('Thêm thất bại', 500);
    }
    public function deleteNienKhoa(Request $request)
    {
        $khoahoc = new NienKhoaModel();
        $khoahoc->id_khoa_hoc = $request->input('id_khoa_hoc');
        if ($khoahoc->xoa())
            return ToolsModel::status('Xóa thành công', 200);
        return ToolsModel::status('Xóa thất bại', 500);
    }
    public function postNienKhoa(Request $request){
        $khoahoc = new NienKhoaModel();
        $khoahoc->id_khoa_hoc = $request->input('id_khoa_hoc');
        $khoahoc->ma_khoa_hoc = $request->input('ma_khoa_hoc');
        $khoahoc->nam_nhap_hoc = $request->input('nam_nhap_hoc');
        $khoahoc->nien_khoa = $request->input('nien_khoa');
        $khoahoc->nam_het_han = $request->input('nam_het_han');

        if ($khoahoc->capNhat())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }
}
