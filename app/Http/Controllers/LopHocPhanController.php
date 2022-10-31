<?php

namespace App\Http\Controllers;

use App\Models\LopHocModel;
use App\Models\LopHocPhanModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;

class LopHocPhanController extends Controller
{
    public function getLopHocPhan($id_don_vi)
    {
        $lophocphan = new LopHocModel();
        $lophocphan->id_don_vi = $id_don_vi;

        return view('auth.lop-hoc-phan.lop-hoc-phan', ['ds' => (new LopHocPhanModel())->danhSach(),
            'dsHocPhan' => (new LopHocPhanModel())->dsHocPhan(),
            'dsHocKy' => (new LopHocPhanModel())->dsHocKy(),
            'id_don_vi' => $id_don_vi,
            'ten_don_vi' => $lophocphan->getTenDonVi(),
        ]);
    }

    public function putLopHocPhan(Request $request)
    {

        $success = 0;
        $soluong = $request->input('so_luong_lop');

        for ($i = 1; $i <= $soluong; $i++) {
            $lophocphan = new LopHocPhanModel();
            $lophocphan->id_hoc_phan = $request->input('id_hoc_phan');
            $lophocphan->ma_lop_hoc_phan = $request->input('ma_lop_hoc_phan') . '_' . $i;
            $lophocphan->loai_lop_hoc_phan = $request->input('loai_lop_hoc_phan');
            $lophocphan->so_luong = $request->input('so_luong');
            $lophocphan->nhap_diem = $request->input('nhap_diem');
            $lophocphan->id_hoc_ky = $request->input('id_hoc_ky');

            if ($lophocphan->tonTaiMaLopHocPhan()) {
                continue;
            }

            if ($lophocphan->them()) {
                $success++;
            }
        }

        if ($success < $soluong and $success != 0) {
            return ToolsModel::status('Đã thêm thành công ' . $success . ' trên tổng số ' . $soluong, 333);
        } elseif ($success == $soluong) {
            return ToolsModel::status('Thêm thông tin thành công', 200);
        }

        return ToolsModel::status('Thêm thông tin thất bại', 500);

//        if($lophocphan->tonTaiMaLopHocPhan())
//            return ToolsModel::status('Mã lớp học đã tồn tại', 500);
//
//        if($lophocphan->them())
//            return ToolsModel::status('Thêm thông tin thành công', 200);
//        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }

    public function postLopHocPhan(Request $request)
    {
        $lophocphan = new LopHocPhanModel();
        $lophocphan->id_hoc_phan = $request->input('id_hoc_phan');
        $lophocphan->ma_lop_hoc_phan = $request->input('ma_lop_hoc_phan');
        $lophocphan->loai_lop_hoc_phan = $request->input('loai_lop_hoc_phan');
        $lophocphan->nhap_diem = $request->input('nhap_diem');
        $lophocphan->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        $lophocphan->so_luong = $request->input('so_luong');


        if ($lophocphan->tonTaiMaLopHocPhan_capNhat())
            return ToolsModel::status('Mã lớp học đã tồn tại', 500);


        if ($lophocphan->capNhat())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteLopHocPhan(Request $request)
    {
        $lophocphan = new LopHocPhanModel();
        $lophocphan->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        if ($lophocphan->xoa())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }

    //Danh sách học phần
    public function getLopHocPhanChiTiet($id_don_vi, $id_lop_hoc_phan)
    {
        $lophocphan = new LopHocPhanModel();
        $lophocphan->id_lop_hoc_phan = $id_lop_hoc_phan;

        $lophoc = new LopHocModel();
        $lophoc->id_don_vi = $id_don_vi;

        return view('auth.lop-hoc-phan.chi-tiet',
            [
                'dsChiTiet' => $lophocphan->danhSachChiTiet(),
                'dsHocVien' => $lophocphan->dsHocVien(),
                'id_don_vi' => $id_don_vi,
                'ten_don_vi' => $lophoc->getTenDonVi(),
                'chiTiet' => $lophocphan->chiTiet(),
            ]);
    }

    public function getDataTable($id_lop_hoc_phan)
    {
        $lophocphan = new LopHocPhanModel();
        $lophocphan->id_lop_hoc_phan = $id_lop_hoc_phan;

        return json_encode($lophocphan->danhSachChiTiet());
    }

    public function putLopHocPhanChiTiet(Request $request)
    {
        $lophocphan = new LopHocPhanModel();
        $lophocphan->id_hoc_vien = $request->input('id_hoc_vien');
        $lophocphan->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        $lophocphan->diem_10 = $request->input('diem_10');
        $lophocphan->diem_40 = $request->input('diem_40');
        $lophocphan->diem_50 = $request->input('diem_50');

        if ($lophocphan->tonTaiHocVien())
            return ToolsModel::status('Học viên đã tồn tại', 500);

        if ($lophocphan->themChiTiet())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }

    public function postLopHocPhanChiTiet(Request $request)
    {
        $lophocphan = new LopHocPhanModel();
        $lophocphan->diem_10 = $request->input('diem_10');
        $lophocphan->diem_40 = $request->input('diem_40');
        $lophocphan->diem_50 = $request->input('diem_50');
        $lophocphan->id_hoc_vien = $request->input('id_hoc_vien');
        $lophocphan->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');


        if ($lophocphan->capNhatChiTiet())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }

    public function deleteLopHocPhanChiTiet(Request $request)
    {
        $lophocphan = new LopHocPhanModel();
        $lophocphan->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        $lophocphan->id_hoc_vien = $request->input('id_hoc_vien');
        if ($lophocphan->xoaChiTiet())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }

    public function exportExcel($id_lop_hoc_phan)
    {
        $excel = new PHPExcel();

        $lophocphan = new LopHocPhanModel();
        $lophocphan->id_lop_hoc_phan = $id_lop_hoc_phan;

        $bangdiem = $lophocphan->danhSachChiTiet();

        # File này ở MyLearning/public/excel-mau/bang-diem-hoc-phan.xlsx
        $inputFileName = public_path('excel-mau/bang-diem-hoc-phan.xlsx');
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $excel = $objReader->load($inputFileName);
        $excel->setActiveSheetIndex(0);
        $cell = $excel->getActiveSheet();
        $stt = 1;
        $num_row = 7;
        $ma_lop_hoc_phan = "";
        $ten_hoc_phan = "";

        foreach ($bangdiem as $diem) {
            if ($ma_lop_hoc_phan == "") $ma_lop_hoc_phan = $diem->ma_lop_hoc_phan;
            if ($ten_hoc_phan == "") $ten_hoc_phan = $diem->ten_hoc_phan;

            $cell->setCellValue('A' . $num_row, '' . $stt++);
            $cell->setCellValue('B' . $num_row, "");
            $cell->setCellValue('C' . $num_row, $diem->ho . ' ' . $diem->ten);
            $cell->setCellValue('D' . $num_row, $diem->ma_lop_hoc . '');
            $cell->setCellValue('E' . $num_row, $diem->diem_10 . '');
            $cell->setCellValue('F' . $num_row, $diem->diem_40 . '');
            $cell->setCellValue('G' . $num_row, $diem->diem_50 . '');

            $diemhocphan = ($diem->diem_10 + $diem->diem_40 * 4 + $diem->diem_50 * 5) / 10.0;
            $cell->setCellValue('H' . $num_row, $diemhocphan . '');
            $cell->setCellValue('K' . $num_row, '');


            $excel->getActiveSheet()->getStyle("A" . $num_row . ":K" . $num_row)->applyFromArray(
                array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                )
            );
            if (count($bangdiem) >= $stt)
                $cell->insertNewRowBefore($num_row + 1, 1);
            $num_row++;
        }

        $cell->setCellValue('C3', 'Tên học phần: ' . $ma_lop_hoc_phan);
        $cell->setCellValue('F2', 'Mã lớp học phần: ' . $ma_lop_hoc_phan);
        $cell->setCellValue('F3', '');
        $cell->setCellValue('A2', '');

        $file_name = $ma_lop_hoc_phan;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $file_name . '.xlsx"');
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
    }
    public function exportCSV(Request $request, $id_hoc_ky)
    {
        $ma_hoc_ky = (new LopHocPhanModel())->getMaHocKy($id_hoc_ky);
        $fileName = 'lop_hoc_phan_'.$ma_hoc_ky.'.csv';
        $lophocphan = (new LopHocPhanModel())->dsExportCSV($id_hoc_ky);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Subject', 'Comments');

        $callback = function() use($lophocphan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($lophocphan as $item) {
                $row['Subject']  = $item->ma_lop_hoc_phan;
                $row['Comments']    = $item->ten_hoc_phan;

                fputcsv($file, array($row['Subject'], $row['Comments']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
