<?php

namespace App\Http\Controllers;

use App\Models\GiangVienModel;
use App\Models\PhongModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
class PhongController extends Controller
{
    public  function getPhong(){
        $p = new PhongModel();
        return view('auth.phong.phong',['data' => $p->dsPhong()]);

    }
    public function putPhong(Request $request){
        $p = new PhongModel();
        $p->ma_phong = $request->input('ma_phong');
        $p->ten_phong = $request->input('ten_phong');
        $p->vi_tri = $request->input('vi_tri');
        $p->trang_thai = $request->input('trang_thai');
        $p->suc_chua = $request->input('suc_chua');
        if($p->them())
            return ToolsModel::status('Thêm thành công', 200);
        return ToolsModel::status('Thêm thất bại', 500);
    }
    public function deletePhong(Request $request)
    {
        $p = new PhongModel();
        $p->id_phong = $request->input('id_phong');
        if ($p->xoa())
            return ToolsModel::status('Xóa thành công', 200);
        return ToolsModel::status('Xóa thất bại', 500);
    }
    public function updatePhong(Request $request){
        $p = new PhongModel();
        $p->ma_phong = $request->input('ma_phong');
        $p->ten_phong = $request->input('ten_phong');
        $p->vi_tri = $request->input('vi_tri');
        $p->trang_thai = $request->input('trang_thai');
        $p->id_phong = $request->input('id_phong');
        $p->suc_chua= $request->input('suc_chua');
        if ($p->capNhat())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }
    public function exportPhong(){
        $fileName = 'danh-sach-phong-hoc.csv';
        $p = new PhongModel();
        $ds_phong = $p->dsPhong();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('RoomName', 'Room Capacity', 'Building', 'Comments');

        $callback = function() use($ds_phong, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($ds_phong as $item) {
                $row['RoomName']  = $item->id_phong;
                $row['Room Capacity']    = $item->suc_chua;
                $row['Building']    = $item->ma_phong;
                $row['Comments']  = '';


                fputcsv($file, array($row['RoomName'], $row['Room Capacity'], $row['Building'], $row['Comments']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
