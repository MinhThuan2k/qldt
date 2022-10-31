<?php

namespace App\Http\Controllers;


use App\Models\BangDiemSinhVienModel;
use App\Models\ToolsModel;
use App\Models\TraCuuHocPhiModel;
use Illuminate\Http\Request;

class TraCuuHocPhiController extends Controller
{

    public function getHocPhi(){
        return view('auth.giao-dien-sv.tra-cuu-hoc-phi.tra-cuu-hoc-phi', [
            'hocphi'=>(new TraCuuHocPhiModel()) ->hocPhiSV(-1,-1),
            'chitiet'=>(new TraCuuHocPhiModel()) ->chitietSV(-1,-1),
            'tinchi'=>(new TraCuuHocPhiModel()) ->tongtcSV(-1,-1),
        ]);
    }
    // Bảng điểm của sinh viên theo từng học kỳ
    public function hocPhi(Request $request, $id_hoc_ky){
        return view('auth.giao-dien-sv.tra-cuu-hoc-phi.tra-cuu-hoc-phi', [
            'hocphi'=>(new TraCuuHocPhiModel()) ->hocPhiSV(session()->get('id'), $id_hoc_ky),
            'chitiet'=>(new TraCuuHocPhiModel()) ->chitietSV(session()->get('id'),$id_hoc_ky),
            'tinchi'=>(new TraCuuHocPhiModel()) ->tongtcSV(session()->get('id'),$id_hoc_ky),
        ]);
    }
    public static function tinhToan($id_hoc_vien, $id_hoc_ky){
        $tongHocPhi = new TraCuuHocPhiModel();
        $tongHocPhi->id_hoc_vien = $id_hoc_vien;
        $tongHocPhi->$id_hoc_ky = $id_hoc_ky;
        $danhsach = $tongHocPhi->hocPhiSV();
        $tongtien = 0;
        $tinchi = 0;
        foreach ($danhsach as $item){
            $tinchi += ($item->tin_chi_lt + $item->tin_chi_th);
        }
        return $tinchi;
    }
}
