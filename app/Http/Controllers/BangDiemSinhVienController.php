<?php

namespace App\Http\Controllers;


use App\Models\BangDiemSinhVienModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class BangDiemSinhVienController extends Controller
{

    public function getSinhVien(){
        return view('auth.giao-dien-sv.blank-sv');
    }

    public function gdBangDiem(){
    // Giao diện bảng điểm cá nhân
    $i=0;
        return view('auth.giao-dien-sv.tracuu.xemdiem', [
            'bangdiem'=>(new BangDiemSinhVienModel()) ->bangDiemSV(-1),
            'hocky'=>(new BangDiemSinhVienModel()) ->dsHocKy(-1),'i'=>$i
        ]);
    }
    // Lấy bảng điểm của học viên theo id đăng nhập
    public function bangDiem(){
        $i=0;
        return view('auth.giao-dien-sv.tracuu.xemdiem', [
            'bangdiem'=>(new BangDiemSinhVienModel()) ->bangDiemSV(session()->get('id')),
            'hocky'=>(new BangDiemSinhVienModel()) ->dsHocKy(session()->get('id')),'i'=>$i
        ]);
    }

    // Bảng điểm của sinh viên theo từng học kỳ
    public function bangDiemTheoHk(Request $request, $id_hoc_vien, $id_hoc_ky){
        $i=0;
        return view('auth.giao-dien-sv.tracuu.xemdiem', [
            'bangdiem'=>(new BangDiemSinhVienModel()) ->bangDiemSV($id_hoc_vien),
            'hocky'=>(new BangDiemSinhVienModel()) ->dsDiemHocKy($id_hoc_vien,$id_hoc_ky),'i'=>$i
        ]);
    }
    public function getAllbangDiem(Request $request, $id_hoc_vien){
        $i=0;
        return view('auth.giao-dien-sv.tracuu.xemdiem', [
            'bangdiem'=>(new BangDiemSinhVienModel()) ->bangDiemSV($id_hoc_vien),
            'hocky'=>(new BangDiemSinhVienModel()) ->dsAllDiem($id_hoc_vien),'i'=>$i
        ]);
    }
}
