<?php

namespace App\Http\Controllers;
use App\Models\ToolsModel;
use App\Models\GiaoĐienGiangVienModel;
use Illuminate\Http\Request;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;

class GiaoDienGiangVienController extends Controller
{
    public function giaoDienGiangVien($id_giang_vien){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien = $id_giang_vien;

        //lấy dữ liệu lớp học phần theo giảng viên giảng dạy
        //return view('auth.giao-dien-gv.giao-dien-chung',['gv'=>$gv->getGiangVien(),'id_giang_vien'=>$id_giang_vien]);
        return view('auth.giao-dien-gv.blank-gv',['gv'=>$gv->getGiangVien(),'id_giang_vien'=>$id_giang_vien]);

    }
    public function giaoCoVanHocTap($id_giang_vien){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien = $id_giang_vien;
        return view('auth.giao-dien-gv.giao-dien-chung',['id_giang_vien'=>$id_giang_vien]);
    }
    public function getDanhSachLop($id_giang_vien){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien = $id_giang_vien;
        $id_lop_hoc_phan = $gv->chiTiet();
        $i=0;
        $check=[];
        $id_hoc_ky="";
        return view('auth.giao-dien-gv.nhap-diem.giao-dien-nhap-diem',['id_hoc_ky'=>$id_hoc_ky,'gv'=>$gv->dsLopHocPhanTheoIDGiangVien(),'check'=>$check,'ct'=>$id_lop_hoc_phan,'i'=>$i]);
    }
    public function getDanhSachLopTheoIDHocKy($id_giang_vien,$id_hoc_ky){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien = $id_giang_vien;
        $gv->id_hoc_ky = $id_hoc_ky;
        $id_lop_hoc_phan = $gv->chiTiet();
        $i=0;
        $check=[];
        return view('auth.giao-dien-gv.nhap-diem.giao-dien-nhap-diem',['check'=>$check,'id_hoc_ky'=>$id_hoc_ky,'gv'=>$gv->dsLopHocPhanTheoIDGiangVienTheoIDHocKy(),'ct'=>$id_lop_hoc_phan,'i'=>$i]);
    }
    public function getDanhSachSV($id_giang_vien){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien = $id_giang_vien;
        return view('auth.giao-dien-gv.giao-dien-cvht',['gv'=>$gv->dsSinhVien(),'gv2'=>$gv->getDotDangKy(),'id'=>session()->get('id')]);
    }
public function getDSSV($id_dot_dang_ky, $id_giang_vien){
    $gv = new GiaoĐienGiangVienModel();
    $gv->id_dot_dang_ky = $id_dot_dang_ky;
    $gv->id_giang_vien = $id_giang_vien;
    return view('auth.giao-dien-gv.giao-dien-cvht-v2',['gv'=>$gv->dsSinhVienTheoDotDangKy(),'id'=>$id_giang_vien]);
}

    public function nhapDiem($id_lop_hoc_phan){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_lop_hoc_phan = $id_lop_hoc_phan;
        $ct= $gv->chiTiet();
        $i=0;
        return view('auth.nhap-diem-sv.giao-dien-nhap-diem',['gv'=>$gv->dsHocVienTheoLopHocPhan(),'id_lop_hoc_phan'=>$id_lop_hoc_phan,'ct'=>$ct,'i'=>$i]);
    }

    public function putDanhSachLopHocPhan(Request $request){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_hoc_vien = $request->input('id_hoc_vien');
        $gv->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        if ($gv->them())
            return ToolsModel::status('Duyệt thành công', 200);
        return ToolsModel::status('Duyệt thất bại', 500);
    }
    public function updateDotDangKyChiTiet(Request $request){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_hoc_vien = $request->input('id_hoc_vien');
        $gv->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        $gv->id_dot_dang_ky = $request->input('id_dot_dang_ky');
        $gv->updateDotDangKyChiTiet();
    }
    public function updateDiemHocVien(Request $request){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_hoc_vien = $request->input('id_hoc_vien');
        $gv->id_lop_hoc_phan = $request->input('id_lop_hoc_phan');
        $gv->diem_10 = $request->input('diem_10');
        $gv->diem_40 = $request->input('diem_40');
        $gv->diem_50 = $request->input('diem_50');
        if ($gv->capNhat())
            return ToolsModel::status('Cập nhật thành công', 200);
        return ToolsModel::status('Cập nhật thất bại', 500);
    }
    

    public function getDSLop($id_giang_vien){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien = $id_giang_vien;
        return view('auth.giao-dien-gv.lop-chuyen-nganh',['gv'=>$gv->getLopChuyenNganh(),'id_giang_vien'=>$id_giang_vien]);
    }
    public function getDSLop2($id_giang_vien){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien = $id_giang_vien;
        return view('auth.giao-dien-gv.lop-chuyen-nganh-v2',['gv'=>$gv->getLopChuyenNganh(),'id_giang_vien'=>$id_giang_vien]);
    }

public function getSV($id_lop_hoc){
    $gv = new GiaoĐienGiangVienModel();
    $gv->id_lop_hoc = $id_lop_hoc;
    return view('auth.giao-dien-gv.danh-sach-sv',['gv'=>$gv->getDSSV(),'id_lop_hoc'=>$id_lop_hoc]);
}
public function updateMoTa(Request $request){
    $gv = new GiaoĐienGiangVienModel();
    $gv->id_hoc_vien = $request->input('id_hoc_vien');
    $gv->ghi_chu = $request->input('ghi_chu');
    if ($gv->capNhatMoTa())
        return ToolsModel::status('Cập nhật thành công', 200);
    return ToolsModel::status('Cập nhật thất bại', 500);
}
public function getDiem($id_hoc_vien){
    $gv = new GiaoĐienGiangVienModel();
    $gv->id_hoc_vien = $id_hoc_vien;
    $ho = $gv->getThongTinHocVien($id_hoc_vien)[0]->ho;
    $ten = $gv->getThongTinHocVien($id_hoc_vien)[0]->ten;
    return view('auth.giao-dien-gv.bang-diem-sv',['gv'=>$gv->getDiemCaNhan(),'ho'=>$ho,'ten'=>$ten]);
}



public function getLopHoc($id_lop_hoc){
    $gv = new GiaoĐienGiangVienModel();
    $gv->id_lop_hoc = $id_lop_hoc;
    $ten = $gv->getLopHoc($id_lop_hoc)[0]->ma_lop_hoc;
    return view('auth.giao-dien-gv.lop-chuyen-nganh-kqht',['id_lop_hoc'=>$id_lop_hoc,'ten'=>$ten,'gv'=>$gv->getHocKy()]);
}

public function getKetQuaHocTap($id_lop_hoc, $id_hoc_ky){
    $gv = new GiaoĐienGiangVienModel();
    $gv->id_lop_hoc = $id_lop_hoc;
    $gv->id_hoc_ky = $id_hoc_ky;
    return view('auth.giao-dien-gv.ket-qua-hoc-tap',['gv'=>$gv->getKqht()]);

}
public function exportBangDiem($id_lop_hoc_phan){
    $excel = new PHPExcel();
    $gv = new GiaoĐienGiangVienModel();
    $gv->id_lop_hoc_phan = $id_lop_hoc_phan;
    $ds_diem = $gv->dsHocVienTheoLopHocPhan();
    $inputFileName = public_path('excel-mau/BangDiem.xlsx');
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $excel = $objReader->load($inputFileName);
    $excel->setActiveSheetIndex(0);
    $cell = $excel->getActiveSheet();
    $stt = 1;
    $num_row = 7;
    $ma_lop_hoc_phan = "";
    $ma_hoc_phan = "";
    $ten_hoc_phan = "";
    $diem_chu = "";
    $hoc_ky = "";
    $tc_lt = "";
    $tc_th = "";
    foreach ($ds_diem as $diem) {
        if ($ma_lop_hoc_phan == "") $ma_lop_hoc_phan = $diem->ma_lop_hoc_phan;
        if ($ten_hoc_phan == "") $ten_hoc_phan = $diem->ten_hoc_phan;
        if ($ma_hoc_phan == "") $ma_hoc_phan = $diem->ma_hoc_phan;
        if ($tc_lt == "") $tc_lt = $diem->tin_chi_lt;
        if ($tc_th == "") $tc_th = $diem->tin_chi_th;
        if ($hoc_ky == "") $hoc_ky = $diem->ten_hoc_ky;
        $cell->setCellValue('A' . $num_row, ''.$stt++);
        $cell->setCellValue('B' . $num_row, "");
        $cell->setCellValue('C' . $num_row, $diem->ho.' '.$diem->ten);
        $cell->setCellValue('D' . $num_row, $diem->ma_lop_hoc.'');
        $cell->setCellValue('E' . $num_row, $diem->diem_10.'');
        $cell->setCellValue('F' . $num_row, $diem->diem_40.'');
        $cell->setCellValue('G' . $num_row, $diem->diem_50.'');
        $diemhocphan = ($diem->diem_10 + $diem->diem_40*4 + $diem->diem_50*5)/10.0 ;
        if($diemhocphan>=8.5)
            $diem_chu = "A";
        elseif ($diemhocphan>=7.8)
            $diem_chu = "B+";
        elseif ($diemhocphan>=7.0)
            $diem_chu = "B";
        elseif ($diemhocphan>=6.3)
            $diem_chu = "C+";
        elseif ($diemhocphan>=5.5)
            $diem_chu = "C";
        elseif ($diem_chu>=4.8)
            $diem_chu = "D+";
        elseif ($diemhocphan>=4.0)
            $diem_chu = "D";
        else
            $diem_chu = "F";
        $cell->setCellValue('H' . $num_row, $diemhocphan);
        $cell->setCellValue('I' . $num_row, $diem_chu);
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
        if (count($ds_diem) >= $stt)
            $cell->insertNewRowBefore($num_row + 1, 1);
        $num_row++;
    }
    $cell->setCellValue('C3', $ten_hoc_phan);
    $cell->setCellValue('F2', 'Mã lớp học phần: '.$ma_lop_hoc_phan);
    $cell->setCellValue('F3', 'Mã học phần: '.$ma_hoc_phan);
    $cell->setCellValue('A2', $hoc_ky);
    $cell->setCellValue('K3', '('.$tc_lt.'/'.$tc_th.')');

    $file_name = $ma_lop_hoc_phan;

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $file_name . '.xlsx"');
    PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
}
public function importDiem(Request $request, $id_lop_hoc_phan)
        {
            $arrayLoi = [];
            $tong = 0;
            $diem = new GiaoĐienGiangVienModel();
           // $diem->id_lop_hoc_phan = $id_lop_hoc_phan;
           //$gv->xoaDuLieuGiangVien($id_lop_hoc_phan);
           //$getHocPhan=$diem->dsHocVienTheoLopHocPhan();
           $diem->xoa($id_lop_hoc_phan);
            $dataExcel = ToolsModel::readExcel($request->file('file-excel'), 'A7');
            
            foreach ($dataExcel['data'] as $item) {
                $diem->id_hoc_vien = trim($item[ToolsModel::chartNumber('B')]);
                $diem->id_lop_hoc_phan =$id_lop_hoc_phan;
                $diem->diem_10 = trim($item[ToolsModel::chartNumber('E')]);
                $diem->diem_40 = trim($item[ToolsModel::chartNumber('F')]);
                $diem->diem_50 = trim($item[ToolsModel::chartNumber('G')]);
                if($diem->id_hoc_vien==null){
                    break;
                }else{
                   $diem->themImport();
                    $tong++;
                }
                    // foreach($getHocPhan as $i){
                    //     if($i->id_lop_hoc_phan==$id_lop_hoc_phan && $i->id_hoc_vien==$diem->id_hoc_vien){
                    //             $diem->capNhat();
                    //     }
                    //     }
                }       
            
            if (count($arrayLoi) > 0) {
                return redirect()
                    ->action('App\Http\Controllers\GiaoDienGiangVienController@nhapDiem', $id_lop_hoc_phan)
                    ->with('error', $arrayLoi);
            }
            return redirect()
                ->action('App\Http\Controllers\GiaoDienGiangVienController@nhapDiem', $id_lop_hoc_phan)
                ->with('msg', 'Import dữ liệu thành công ' . $tong . ' mẫu tin');
        }
    public function lichday($id_giang_vien){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien=$id_giang_vien;
        $check="";
        $demtuan=0;
        $id_hoc_ky="";
        return view('auth.giao-dien-gv.lich-day.tra-cuu-tkb',['demtuan'=> $demtuan,
                    'check'=>$check, 
                    'demthoikhoabieu'=>$gv->demthoikhoabieu(),
                    'lichday'=>$gv->lichdayGiangVien(),
                    'hocky'=>$gv->getHocKy(),'id'=>$id_giang_vien,
                    'id_hoc_ky'=>$id_hoc_ky
                ]);
    }
    public function lichdayTheoHK($id_giang_vien,$id_hoc_ky){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien=$id_giang_vien;
        $gv->id_hoc_ky=$id_hoc_ky;
        $check="";
        $demtuan=0;
        return view('auth.giao-dien-gv.lich-day.tra-cuu-tkb',['demtuan'=> $demtuan,
                    'check'=>$check, 
                    'demthoikhoabieu'=>$gv->demthoikhoabieu(),
                    'lichday'=>$gv->lichdayGiangVienTheoHK(),
                    'hocky'=>$gv->getHocKy(),'id'=>$id_giang_vien,
                'id_hoc_ky'=>$id_hoc_ky]);
    }
    public function SVTraCuulichday($id_giang_vien){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien=$id_giang_vien;
        $check="";
        $demtuan=0;
        $id_hoc_ky="";
        return view('auth.giao-dien-sv.tra-cuu-tkb.tra-cuu-lich-day-gv',['demtuan'=> $demtuan,
                    'check'=>$check, 
                    'demthoikhoabieu'=>$gv->demthoikhoabieu(),
                    'lichday'=>$gv->lichdayGiangVien(),
                    'hocky'=>$gv->getHocKy(),'id'=>$id_giang_vien,
                    'id_hoc_ky'=>$id_hoc_ky
                ]);
    }
    public function SVTraCuulichdayTheoHK($id_giang_vien,$id_hoc_ky){
        $gv = new GiaoĐienGiangVienModel();
        $gv->id_giang_vien=$id_giang_vien;
        $gv->id_hoc_ky=$id_hoc_ky;
        $check="";
        $demtuan=0;
        return view('auth.giao-dien-sv.tra-cuu-tkb.tra-cuu-lich-day-gv',['demtuan'=> $demtuan,
                    'check'=>$check, 
                    'demthoikhoabieu'=>$gv->demthoikhoabieu(),
                    'lichday'=>$gv->lichdayGiangVienTheoHK(),
                    'hocky'=>$gv->getHocKy(),'id'=>$id_giang_vien,
                'id_hoc_ky'=>$id_hoc_ky]);
    }
}
