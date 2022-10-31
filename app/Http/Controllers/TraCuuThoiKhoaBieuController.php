<?php

namespace App\Http\Controllers;


use App\Models\BangDiemSinhVienModel;
use App\Models\ToolsModel;
use App\Models\TraCuuHocPhiModel;
use App\Models\TraCuuTkbSinhVienModel;
use Illuminate\Http\Request;

class TraCuuThoiKhoaBieuController extends Controller
{
    public function getThoiKhoaBieu(Request $request){
        $tkb=new TraCuuTkbSinhVienModel();
        $id_hoc_ky="";
        $tkb->id_hoc_vien = $request->input('id_hoc_vien');
        return view('auth.giao-dien-sv.tra-cuu-tkb.tra-cuu-tkb',[
            'data'=>$tkb->dsTKBSv1(session()->get('id')),
            'ngayhoc'=>$tkb ->dsngayhoc1(session()->get('id')),
            'id_hoc_vien'=>session()->get('id'),
            'id_hoc_ky'=>$id_hoc_ky,
            'ngayhocTheoBang'=>$tkb->ngayHocTheoBang(session()->get('id')),
            'c'=>"",
        ]);
    }
    public function getThoiKhoaBieu1(Request $request ,$id_hoc_vien){
        $tkb=new TraCuuTkbSinhVienModel();
        $tkb->id_hoc_vien =$id_hoc_vien;
        $id_hoc_ky="";
        return view('auth.giao-dien-sv.tra-cuu-tkb.tra-cuu-tkb',[
            'data'=>$tkb->dsTKBSv(),
            'ngayhoc'=>$tkb->dsngayhoc(),
            'id_hoc_vien'=>$id_hoc_vien,
            'id_hoc_ky'=>$id_hoc_ky,
            'ngayhocTheoBang'=>$tkb->ngayHocTheoBang($id_hoc_vien),
            'c'=>"",
        ]);
    }
    public function getThoiKhoaBieuTheoHK(Request $request ,$id_hoc_vien,$id_hoc_ky){
        $tkb=new TraCuuTkbSinhVienModel();
        $tkb->id_hoc_vien =$id_hoc_vien;
        $tkb->id_hoc_ky =$id_hoc_ky;
        $id_hoc_ky="";
        return view('auth.giao-dien-sv.tra-cuu-tkb.tra-cuu-tkb',[
            'data'=>$tkb->dsTKBSvTheoHK(),
            'ngayhoc'=>$tkb->dsngayhocTheoHK(),
            'id_hoc_vien'=>$id_hoc_vien,
            'id_hoc_ky'=>$id_hoc_ky,
            'ngayhocTheoBang'=>$tkb->ngayHocTheoBang1($id_hoc_vien,$id_hoc_ky),
            'c'=>"",
        ]);
    }
}
