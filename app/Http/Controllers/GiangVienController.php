<?php

namespace App\Http\Controllers;

use App\Models\GiaoĐienGiangVienModel;
use App\Models\PhongModel;
use App\Models\ToolsModel;
use App\Models\GiangVienModel;
use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
class GiangVienController extends Controller
{

    public  function getGiangVienTheoDonVi($id_don_vi){
        $gv = new GiangVienModel();
        $gv->id_don_vi = $id_don_vi;
        $ten_don_vi = $gv->getTenDonVi($id_don_vi)[0]->ten_don_vi;
        $ts = $gv->CountTS();
        $ths = $gv->CountThS();
        $dh = $gv->CountDh();
        $ncs = $gv->CountNCS();
        return view('auth.giang-vien.giang-vien-theo-don-vi_excel', [
            'gv' => $gv->dsGiangVienTheoDonVi(),'cv'=>$gv->dsChucVu(),'hv'=>$gv->dsHocVi(),
            'id_don_vi'=>$id_don_vi,'ten_don_vi'=>$ten_don_vi, 'ts'=>$ts, 'ths'=>$ths, 'dh'=>$dh, 'ncs'=>$ncs
        ]);
    }
    public function putGiangVien(Request $request){
        $gv = new GiangVienModel();
        $gv->id_don_vi = $request->input('id_don_vi');
        $gv->ho = $request->input('ho');
        $gv->ten = $request->input('ten');
        $gv->email = $request->input('email');
        $gv->sdt = $request->input('sdt');
        $gv->dia_chi = $request->input('dia_chi');
        $gv->cmnd = $request->input('cmnd');
        $gv->anh = $request->input('anh');
        $gv->trang_thai = $request->input('trang_thai');
        $gv->id_hoc_vi = $request->input('id_hoc_vi');
        $gv->id_chuc_vu = $request->input('id_chuc_vu');

        if($gv->them())
            return ToolsModel::status('Thêm thành công', 200);

        return ToolsModel::status('Thêm thất bại', 500);
    }

    public function deleteGiangVien(Request $request)
    {
        $gv = new GiangVienModel();
        $gv->id_giang_vien = $request->input('id_giang_vien');
        if ($gv->xoa())
            return ToolsModel::status('Xóa thành công', 200);
        return ToolsModel::status('Xóa thất bại', 500);
    }

    public function updateGiangVien(Request $request){
        $gv = new GiangVienModel();
        $gv->id_don_vi = $request->input('id_don_vi');
        $gv->ho = $request->input('ho');
        $gv->ten = $request->input('ten');
        $gv->email = $request->input('email');
        $gv->sdt = $request->input('sdt');
        $gv->dia_chi = $request->input('dia_chi');
        $gv->cmnd = $request->input('cmnd');
        $gv->anh = $request->input('anh');
        $gv->trang_thai = $request->input('trang_thai');
        $gv->id_giang_vien = $request->input('id_giang_vien');
        $gv->id_hoc_vi = $request->input('id_hoc_vi');
        $gv->id_chuc_vu = $request->input('id_chuc_vu');
        if ($gv->capNhat())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }
    public function importGiangVien(Request $request, $id_don_vi)
    {
        $arrayLoi = [];
        $tong = 0;
        $gv = new GiangVienModel();
        $gv->id_don_vi = $id_don_vi;
        $gv->xoaDuLieuGiangVien($id_don_vi);
        $dataExcel = ToolsModel::readExcel($request->file('file-excel'), 'A2');


        foreach ($dataExcel['data'] as $item) {

            $gv->ho = trim($item[ToolsModel::chartNumber('B')]);
            $gv->ten = trim($item[ToolsModel::chartNumber('C')]);
            $gv->email = trim($item[ToolsModel::chartNumber('D')]);
            $gv->sdt = trim($item[ToolsModel::chartNumber('E')]);
            $gv->dia_chi = trim($item[ToolsModel::chartNumber('F')]);
            $gv->cmnd = trim($item[ToolsModel::chartNumber('G')]);
            $gv->anh = "";
            $gv->trang_thai = $item[ToolsModel::chartNumber('I')];
            $gv->id_chuc_vu = $item[ToolsModel::chartNumber('J')];
            $gv->id_hoc_vi = $item[ToolsModel::chartNumber('K')];

                $gv->them();
                $tong++;

        }
        if (count($arrayLoi) > 0) {
            return redirect()
                ->action('App\Http\Controllers\GiangVienController@getGiangVienTheoDonVi', $id_don_vi)
                ->with('error', $arrayLoi);
        }
        return redirect()
            ->action('App\Http\Controllers\GiangVienController@getGiangVienTheoDonVi', $id_don_vi)
            ->with('msg', 'Import dữ liệu thành công ' . $tong . ' mẫu tin');
    }

    public function exportGiangVien($id_don_vi)
    {

        $gv = new GiangVienModel();
        $gv->id_don_vi = $id_don_vi;
        $ds_gv = $gv->dsGiangVienTheoDonVi();
        $ten_don_vi = $gv->getTenDonVi($id_don_vi)[0]->ten_don_vi;
        $fileName = 'danh-sach-giang-vien.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Teachers', 'Comment');

        $callback = function () use ($ds_gv, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($ds_gv as $item) {
                $row['Teachers'] = $item->id_giang_vien;
                $row['Comment'] = $item->ho .' '. $item->ten;
                fputcsv($file, array($row['Teachers'], $row['Comment']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function timGiangVien(Request $r)
    {
        return response()->json(GiangVienModel::danhSachAjax($r->q));
    }
}
