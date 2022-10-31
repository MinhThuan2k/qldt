<?php

namespace App\Http\Controllers;

use App\Models\BangDiemModel;
use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;

class BangDiemController extends Controller
{
    public function hoc_vien(Request $r, $id_hoc_vien, $id_hoc_ky)
    {
        $diems = BangDiemModel::get_bang_diem($id_hoc_vien, $id_hoc_ky);
        $excel = new PHPExcel();
        # File này ở MyLearning/public/excel-mau/phieu-cham-ca-nhan.xlsx
        $inputFileName = public_path('excel-mau/bang-diem-hoc-vien-hoc-ky.xlsx');
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $excel = $objReader->load($inputFileName);
        $excel->setActiveSheetIndex(0);
        $cell = $excel->getActiveSheet();
        $stt = 1;
        $num_row = 8;
        foreach ($diems as $diem) {
            $cell->setCellValue('A' . $num_row, $stt++);
            $cell->setCellValue('B' . $num_row, $diem->ma_hoc_phan);
            $cell->setCellValue('C' . $num_row, $diem->ten_hoc_phan);
            $cell->setCellValue('D' . $num_row, $diem->ma_lop_hoc_phan);
            $cell->setCellValue('E' . $num_row, $diem->diem_10);
            $cell->setCellValue('F' . $num_row, $diem->diem_40);
            $cell->setCellValue('G' . $num_row, $diem->diem_50);
            $diem_tb = $this::tinh_diem_tb($diem->diem_50, $diem->diem_40, $diem->diem_10);
            $diem_he_4 = $this::chuyen_he_4($diem_tb);
            $diem_chu = $this::chuyen_he_chu($diem_he_4);
            $cell->setCellValue('H' . $num_row, $diem_tb);
            $cell->setCellValue('I' . $num_row, $diem_he_4);
            $cell->setCellValue('J' . $num_row, $diem_chu);
            $cell->setCellValue('K' . $num_row, "");
            //Vẽ border line
            $excel->getActiveSheet()->getStyle("A" . $num_row . ":K" . $num_row)->applyFromArray(
                array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                )
            );
            $num_row++;
        }
        $mssv = explode('@', $diems[0]->email)[0];
        $cell->setCellValue('A2', $diems[0]->ten_hoc_ky . " - " . $diems[0]->ten_nam_hoc);
        $cell->setCellValue('B3', $diems[0]->ho . " " . $diems[0]->ten);
        $cell->setCellValue('B4', $mssv);
        $cell->setCellValue('H2', $diems[0]->ten_lop_hoc);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . 'test' . '.xlsx"');
        PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');;
    }
    public static function tinh_diem_tb($diem_50, $diem_40, $diem_10)
    {
        return $diem_50*0.5 + $diem_40*0.4 + $diem_10*0.1;
    }
    public static function chuyen_he_4($diem)
    {
        if($diem<4)
            return 'F';
        else if($diem<4.8)
            return 'D';
        else if($diem<5.5)
            return 'D+';
        else if($diem<6.3)
            return 'C';
        else if($diem<7.0)
            return 'C+';
        else if($diem<7.8)
            return 'B';
        else if($diem<8.5)
            return 'B+';
        else
            return 'A';
    }
    public static function chuyen_he_chu($diem)
    {
        switch($diem)
        {
            case 'A':
                return 4.0;
            case 'B+':
                return 3.5;
            case 'B':
                return 3.0;
            case 'C+':
                return 2.5;
            case 'C':
                return 2.0;
            case 'D+':
                return 1.5;
            case 'D':
                return 1.0;
            case 'F':
                return 0.0;

        }
    }

//    Tính điểm của học kì cuối cùng được tạo (không phụ thuộc học kì phụ)
    public static function getDiemHocKi($id_hoc_vien){
        $diemhocky = new BangDiemModel();
        $diemhocky->id_hoc_vien = $id_hoc_vien;
        $danhsach = $diemhocky->get_diem_hoc_ky();
        $diemtong = 0;
        $tinchi = 0;
        foreach ($danhsach as $item){
            $diemtong += self::chuyen_he_chu(self::chuyen_he_4(self::tinh_diem_tb($item->diem_50,$item->diem_40,$item->diem_10)))*($item->tin_chi_lt + $item->tin_chi_th);
            $tinchi += ($item->tin_chi_lt + $item->tin_chi_th);
        }
        return ($tinchi > 0) ? $diemtong/$tinchi : 0;
    }
}
