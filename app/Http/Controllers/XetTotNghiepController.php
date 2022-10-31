<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XetTotNghiepModel;
use App\Models\VanBangModel;
use App\Models\HocVienModel;     
use Barryvdh\DomPDF\Facade\Pdf;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
class XetTotNghiepController extends Controller
{
    public function getTotNghiep($id_hoc_vien){
        $vanbang=new VanBangModel();
        $hocvien= new HocVienModel();
        $dsdiem=new XetTotNghiepModel();
        $diem=0;
        $diemtb=0;
        $tongtinchi=0;
        $diemHe4=0;
        $diemTichLuyCanHoc=0;
        $selectdiem=$dsdiem->dsdiem($id_hoc_vien);
        $TongTinChiTheoCTDT=$dsdiem->TongTinChiTheoCTDT($id_hoc_vien);
        $getDiemHPTheoHocVien=$dsdiem->getDiemHPTheoHocVien($id_hoc_vien);
        $dsHP=$dsdiem->dsHocPhanTheoCTDT($id_hoc_vien);
        $a=0;
        foreach($selectdiem as $row)
        {
            if($row->diemhocphan>=8.5){
                $diemHe4=4; 
            }elseif($row->diemhocphan>=7.8 && $row->diemhocphan<=8.4 )
                $diemHe4=3.5;
                elseif($row->diemhocphan>=7 && $row->diemhocphan<=7.7 )
                    $diemHe4=3;
                    elseif($row->diemhocphan>=6.3 && $row->diemhocphan<=6.9 )
                        $diemHe4=2.5;
                        elseif($row->diemhocphan>=5.5 && $row->diemhocphan<=6.2 )
                            $diemHe4=2;
                            elseif($row->diemhocphan>=4.8 && $row->diemhocphan<=5.4 )
                                $diemHe4=1.5;
                                elseif($row->diemhocphan>=4 && $row->diemhocphan<=4.7 )
                                    $diemHe4=1;
                                    else
                                        $diemHe4=0;
            $tongtinchi+=$row->tinchiLT+$row->tinchiTH;
            $diem+=$diemHe4*($row->tinchiLT+$row->tinchiTH);
        }
        $diemtb=round($diem/$tongtinchi,2);

        foreach( $TongTinChiTheoCTDT as $row)
        {   
            $diemTichLuyCanHoc=round($diem/$row->TongTinChi,2);
            $a=$row->TongTinChi;
        }
        $dem=0;
        foreach($getDiemHPTheoHocVien as $item1){
            foreach($dsHP as $i){
                if($item1->diem10 < 4.0 && $item1->id_hoc_phan==$i->id_hoc_phan){
                    $dem=1;
                    break;
                } 
            }
        }
        return view('auth.giao-dien-sv.tra-cuu-dk-tot-nghiep.dk-tot-nghiep',[
            'vanbang'=>$vanbang->timkiemvanbang($id_hoc_vien),
            'dsdiem'=>$dsdiem->dsdiem($id_hoc_vien),
            'diemtb'=>$diemtb,
            'dsHocPhanTheoCTDT'=>$dsdiem->dsHocPhanTheoCTDT($id_hoc_vien),
            'diemTichLuyCanHoc'=>$diemTichLuyCanHoc,
            'getDiemHPTheoHocVien'=>$dsdiem->getDiemHPTheoHocVien($id_hoc_vien),
            'selectdiem'=>$dsdiem->dsdiem($id_hoc_vien),
            'TongTinChiTheoCTDT'=>$dsdiem->TongTinChiTheoCTDT($id_hoc_vien),
            'tongtinchi'=>$tongtinchi,
            'a'=>$a,
            'dem'=>$dem
        ]);
    }
    public function exportdiemtotnghiep(Request $r, $id_hoc_vien)
    {      $vanbang=new VanBangModel();
        $hocvien= new HocVienModel();
        $dsdiem=new XetTotNghiepModel();
        $diem=0;
        $diemtb=0;
        $tongtinchi=0;
        $diemHe4=0;
        $diemTichLuyCanHoc=0;
        $selectdiem=$dsdiem->dsdiem($id_hoc_vien);
        $TongTinChiTheoCTDT=$dsdiem->TongTinChiTheoCTDT($id_hoc_vien);
        $a=0;
        foreach($selectdiem as $row)
        {
            if($row->diemhocphan>=8.5){
                $diemHe4=4; 
            }elseif($row->diemhocphan>=7.8 && $row->diemhocphan<=8.4 )
                $diemHe4=3.5;
                elseif($row->diemhocphan>=7 && $row->diemhocphan<=7.7 )
                    $diemHe4=3;
                    elseif($row->diemhocphan>=6.3 && $row->diemhocphan<=6.9 )
                        $diemHe4=2.5;
                        elseif($row->diemhocphan>=5.5 && $row->diemhocphan<=6.2 )
                            $diemHe4=2;
                            elseif($row->diemhocphan>=4.8 && $row->diemhocphan<=5.4 )
                                $diemHe4=1.5;
                                elseif($row->diemhocphan>=4 && $row->diemhocphan<=4.7 )
                                    $diemHe4=1;
                                    else
                                        $diemHe4=0;
            $tongtinchi+=$row->tinchiLT+$row->tinchiTH;
            $diem+=$diemHe4*($row->tinchiLT+$row->tinchiTH);
        }

        foreach( $TongTinChiTheoCTDT as $row)
        {   
            $diemTichLuyCanHoc=round($diem/$row->TongTinChi,2);
        }
        $hocluc="";
        if($diemTichLuyCanHoc>=3.6)
            $hocluc="Xuất sắc";
            elseif($diemTichLuyCanHoc>=3.2)
            $hocluc="Giỏi";
            elseif($diemTichLuyCanHoc>=2.5)
            $hocluc="Khá";
            elseif($diemTichLuyCanHoc>=2)
            $hocluc="Trung bình";
            else
            $hocluc="Yếu";
        $dsdiem=new XetTotNghiepModel();
        $i=0;
    	$data = ['data'=>$dsdiem->exportDiemXetTotNghiep($id_hoc_vien),'i'=>$i,'diemTichLuyCanHoc'=>$diemTichLuyCanHoc,'hocluc'=>$hocluc];	
    	$pdf = PDF::loadView('auth.giao-dien-sv.tra-cuu-dk-tot-nghiep.export-diem', $data);
        return  $pdf->stream();
        //return  $pdf->download('donxettotnghiep.pdf');
    }
    public function exportFile($id_hoc_vien)
    {
 

        $getSinhVien=new XetTotNghiepModel();
    	$data = ['data'=>$getSinhVien->getHocVienFile($id_hoc_vien),];	
    	$pdf = PDF::loadView('auth.giao-dien-sv.tra-cuu-dk-tot-nghiep.exportfile', $data);
        //return  $pdf->stream();
        return  $pdf->download('donxettotnghiep.pdf');
            
    }
}

