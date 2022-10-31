<?php

namespace App\Http\Controllers;

use App\Models\HocKyModel;
use App\Models\KhaoSatDangKyHocPhanModel;
use App\Models\LopHocPhanModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RdKafkaCaster;

class KhaoSatDangKyHocPhanController extends Controller
{
    public function get()
    {
        $khaoSat = new KhaoSatDangKyHocPhanModel();
        return view('auth.dang-ky-khao-sat.cai-dat-dang-ky-khao-sat')->with([
            'ds'=>$khaoSat->get(),
            'hoc_ky'=>(new HocKyModel())->dsHocKy(),
        ]);
    }
    public function them(Request $r)
    {
        $khaoSat = new KhaoSatDangKyHocPhanModel();
        if($khaoSat->them($r->id_hoc_ky, $r->ngay_mo, $r->ngay_dong))
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }
    public function xoa(Request $r)
    {
        $khaoSat = new KhaoSatDangKyHocPhanModel();
        if($khaoSat->xoa($r->id_dang_ky_khao_sat))
            return ToolsModel::status('Thao tác thành công', 200);
        return ToolsModel::status('Thao tác thất bại', 500);
    }
    public function sua(Request $r)
    {
        $khaoSat = new KhaoSatDangKyHocPhanModel();
        if($khaoSat->sua($r->id_dang_ky_khao_sat,$r->id_hoc_ky, $r->ngay_mo, $r->ngay_dong))
            return ToolsModel::status('Thao tác thành công', 200);
        return ToolsModel::status('Thao tác thất bại', 500);
    }

    public function chiTiet(Request $r, $id_dang_ky_khao_sat)
    {
        $khaoSat = new KhaoSatDangKyHocPhanModel();

        return view('auth.dang-ky-khao-sat.chi-tiet-dang-ky-khao-sat')->with(
            [
                'id_dang_ky_khao_sat' => $id_dang_ky_khao_sat,
                'ds'=>$khaoSat->chiTietTachLopHocPhan($id_dang_ky_khao_sat),
            ]
        );
    }
    public function sinhVien()
    {
        return view('auth.dang-ky-khao-sat.sv-dang-ky-khao-sat', [
            'ds'=>(new KhaoSatDangKyHocPhanModel())->get()
        ]);
    }
    public function get_DotKhaoSat(Request $r)
    {
        return json_encode((new KhaoSatDangKyHocPhanModel())->getDotKhaoSat($r->id_dang_ky_khao_sat));
    }
    public function dangKyMonHoc(Request $r)
    {
        $khaoSat = new KhaoSatDangKyHocPhanModel();
        $khaoSat->xoaChiTietKhaoSat($r->id_dang_ky_khao_sat, session()->get('id'));
        $flag = true;
        foreach($r->id_hoc_phan as $item)
        {
            $khaoSat->insertChiTietKhaoSat($r->id_dang_ky_khao_sat, session()->get('id'), $item);
        }
        if($flag)
            return ToolsModel::status('Thao tác thành công', 200);
        return ToolsModel::status('Thao tác thất bại', 500);
    }
    public function getKhaoSat(Request $r)
    {
        $khaoSat = new KhaoSatDangKyHocPhanModel();
        return json_encode($khaoSat->getKhaoSat($r->id_hoc_vien, $r->id_dang_ky_khao_sat));
    }





//    Tạo lớp đề xuất
    public function getCaiDatLopHocPhan(){
        $khaosat = new KhaoSatDangKyHocPhanModel();

        return json_encode((object)[
            "lopLT" => $khaosat->getCaiDatLopLyThuyet(),
            "lopTH" => $khaosat->getCaiDatLopThucHanh(),
        ]);

    }

    public function updateCaiDatLopHocPhan(Request $request){
        $caidat = new KhaoSatDangKyHocPhanModel();

        $caidat->so_luong_toi_thieu_lt = $request->input('so_luong_toi_thieu_lt');
        $caidat->so_luong_mac_dinh_lt = $request->input('so_luong_mac_dinh_lt');
        $caidat->so_luong_toi_da_lt = $request->input('so_luong_toi_da_lt');
        $caidat->so_luong_lop_toi_da_lt = $request->input('so_luong_lop_toi_da_lt');
        $caidat->so_luong_du_phong_lt = $request->input('so_luong_du_phong_lt');

        $caidat->so_luong_toi_thieu_th = $request->input('so_luong_toi_thieu_th');
        $caidat->so_luong_mac_dinh_th = $request->input('so_luong_mac_dinh_th');
        $caidat->so_luong_toi_da_th = $request->input('so_luong_toi_da_th');
        $caidat->so_luong_lop_toi_da_th = $request->input('so_luong_lop_toi_da_th');
        $caidat->so_luong_du_phong_th = $request->input('so_luong_du_phong_th');

        if($caidat->capNhatCaiDatLopHocPhan())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }


    public function taoLopDeXuat(Request $request, $id_dang_ky_khao_sat){

        $data = (new KhaoSatDangKyHocPhanModel())->chiTietKhaoSatDangKyHocPhan($id_dang_ky_khao_sat);

        foreach ($data as $item){

            $so_luong = 110;
//            $so_luong = $item->so_luong;

            if ($item->tin_chi_lt){
                $value = (new KhaoSatDangKyHocPhanModel())->getCaiDatLopLyThuyet();
                $result = $this->taoTungLop(
                    $so_luong,
                    $value->so_luong_toi_thieu,
                    $value->so_luong_mac_dinh,
                    $value->so_luong_toi_da,
                    $value->so_luong_lop_toi_da);

                for ($i = 0; $i < count($result); $i++){
                    $this->putLopHocPhanDeXuat(
                        $item->ma_hoc_phan,
                        0,
                        $result[$i],
                        $request->input('id_hoc_ky'),
                        $item->id_hoc_phan,
                        $id_dang_ky_khao_sat
                    );
                }
            }

            if ($item->tin_chi_th){
                $value = (new KhaoSatDangKyHocPhanModel())->getCaiDatLopThucHanh();
                $result = $this->taoTungLop(
                    $so_luong,
                    $value->so_luong_toi_thieu,
                    $value->so_luong_mac_dinh,
                    $value->so_luong_toi_da,
                    $value->so_luong_lop_toi_da);

                for ($i = 0; $i < count($result); $i++){
                    $this->putLopHocPhanDeXuat(
                        $item->ma_hoc_phan.'_BT',
                        1,
                        $result[$i],
                        $request->input('id_hoc_ky'),
                        $item->id_hoc_phan,
                        $id_dang_ky_khao_sat
                    );
                }
            }

        }



        return ToolsModel::status('Đã tạo các lớp học phần đề xuất', 200);
    }


    public function putLopHocPhanDeXuat($ma_lop_hoc_phan_de_xuat, $loai_lop_hoc_phan_de_xuat, $so_luong ,$id_hoc_ky, $id_hoc_phan, $id_dang_ky_khao_sat){
        $lopdexuat = new KhaoSatDangKyHocPhanModel();
        $lopdexuat->ma_lop_hoc_phan_de_xuat = $ma_lop_hoc_phan_de_xuat;
        $lopdexuat->loai_lop_hoc_phan_de_xuat = $loai_lop_hoc_phan_de_xuat;
        $lopdexuat->so_luong = $so_luong;
        $lopdexuat->id_hoc_ky = $id_hoc_ky;
        $lopdexuat->id_hoc_phan = $id_hoc_phan;

        $lopdexuat->themLopDeXuat($id_dang_ky_khao_sat);
    }




    public function getDataTable(Request $request, $id_dang_ky_khao_sat)
    {
        $lopdexuat = new KhaoSatDangKyHocPhanModel();
        $lopdexuat->id_hoc_phan = $request->input('id_hoc_phan');

        return json_encode($lopdexuat->getDanhSachLopDeXuat($id_dang_ky_khao_sat));
    }




    public function themLopDeXuat(Request $request, $id_dang_ky_khao_sat)
    {
        $lopdexuat = new KhaoSatDangKyHocPhanModel();

        $ma_lop = (new KhaoSatDangKyHocPhanModel())->getMaHocPhan($request->input('id_hoc_phan'))->ma_hoc_phan;
        $so_luong = 0;

        if ($request->input('loai_lop_hoc_phan_de_xuat') == 1) {
            $lopdexuat->ma_lop_hoc_phan_de_xuat = $ma_lop.'_BT';
            $so_luong = (new KhaoSatDangKyHocPhanModel())->getCaiDatLopThucHanh()->so_luong_mac_dinh;
        } else {
            $lopdexuat->ma_lop_hoc_phan_de_xuat = $ma_lop;
            $so_luong = (new KhaoSatDangKyHocPhanModel())->getCaiDatLopLyThuyet()->so_luong_mac_dinh;
        }

        $lopdexuat->loai_lop_hoc_phan_de_xuat = $request->input('loai_lop_hoc_phan_de_xuat');
        $lopdexuat->so_luong = $so_luong;
        $lopdexuat->id_hoc_ky = $request->input('id_hoc_ky');
        $lopdexuat->id_hoc_phan = $request->input('id_hoc_phan');


        if($lopdexuat->themLopDeXuat($id_dang_ky_khao_sat))
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }
    public function xoaLopDeXuat(Request $request)
    {
        $lopdexuat = new KhaoSatDangKyHocPhanModel();
        $lopdexuat->id_lop_hoc_phan_de_xuat = $request->input('id_lop_hoc_phan_de_xuat');
        if($lopdexuat->xoaLopDeXuat())
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }

    public function suaLopDeXuat(Request $request)
    {
        $lopdexuat = new KhaoSatDangKyHocPhanModel();

        $ma_lop = (new KhaoSatDangKyHocPhanModel())->getMaHocPhan($request->input('id_hoc_phan'))->ma_hoc_phan;

        if ($request->input('loai_lop_hoc_phan_de_xuat') == 1) {
            $lopdexuat->ma_lop_hoc_phan_de_xuat = $ma_lop.'_BT';
            $so_luong = (new KhaoSatDangKyHocPhanModel())->getCaiDatLopThucHanh()->so_luong_mac_dinh;
        } else {
            $lopdexuat->ma_lop_hoc_phan_de_xuat = $ma_lop;
            $so_luong = (new KhaoSatDangKyHocPhanModel())->getCaiDatLopLyThuyet()->so_luong_mac_dinh;
        }

        $lopdexuat->loai_lop_hoc_phan_de_xuat = $request->input('loai_lop_hoc_phan_de_xuat');
        $lopdexuat->so_luong = $request->input('so_luong');
        $lopdexuat->id_lop_hoc_phan_de_xuat = $request->input('id_lop_hoc_phan_de_xuat');


        if($lopdexuat->capNhatLopDeXuat())
            return ToolsModel::status('Cập nhật thông tin thành công', 200);
        return ToolsModel::status('Cập nhật thông tin thất bại', 500);
    }



    public function taoTungLop($so_luong,$sv_toi_thieu,$sv_mac_dinh,$sv_toi_da,$so_lop_toi_da){
        $lop_de_xuat = [];

        $so_lop_du_kien = floor($so_luong/$sv_mac_dinh);
        $sv_con_lai = $so_luong - $so_lop_du_kien*$sv_mac_dinh;

        if ($sv_con_lai >= $sv_toi_thieu)
        {
            $so_lop_du_kien++;
        }else{
            $so_luong = $so_lop_du_kien*$sv_mac_dinh;
        }

        if ($so_lop_du_kien == 0)
            return $lop_de_xuat;

        $temp = ceil($so_luong/$so_lop_du_kien)%10;

        if ($temp > 0 && $temp <5) $temp = 5;
        elseif ($temp != 0 && $temp != 5) $temp = 10;

        $sv_tb = ((int)(($so_luong/$so_lop_du_kien)/10))*10 + $temp;


        if ($sv_tb <= $sv_toi_thieu) {
            $lop_de_xuat[] = $sv_mac_dinh;
            return $lop_de_xuat;
        }

        if ($so_lop_du_kien > $so_lop_toi_da){
            for ($i=1; $i<=$so_lop_toi_da; $i++) {
                $lop_de_xuat[] = $sv_toi_da;
            }
        }else{
            for ($i=1; $i<=$so_lop_du_kien; $i++) {
                $lop_de_xuat[] = (int)$sv_tb;
            }
        }

        return $lop_de_xuat;
    }


    public function duyetLopDeXuat(Request $request, $id_dang_ky_khao_sat){
        $mang_id_hoc_phan = $request->input('mang_id_hoc_phan');

        for ($i =0; $i<count($mang_id_hoc_phan); $i++){
            $lopdexuat = new KhaoSatDangKyHocPhanModel();
            $lopdexuat->id_hoc_phan = $mang_id_hoc_phan[$i];
            $danhsachlop = $lopdexuat->getDanhSachLopDeXuat($id_dang_ky_khao_sat);
            foreach ($danhsachlop as $item){
                $mahocphan = (new KhaoSatDangKyHocPhanModel())->getMaHocKy($item->id_hoc_ky)->ma_hoc_ky.'_'.$item->ma_lop_hoc_phan_de_xuat.'_'.
                    (((new KhaoSatDangKyHocPhanModel())->getThuTuLopHocPhan($item->id_hoc_phan,$item->id_hoc_ky,$item->loai_lop_hoc_phan_de_xuat))->thu_tu+1);

                $lophocphan = new LopHocPhanModel();
                $lophocphan->id_hoc_phan = $item->id_hoc_phan;
                $lophocphan->ma_lop_hoc_phan = $mahocphan;
                $lophocphan->loai_lop_hoc_phan = $item->loai_lop_hoc_phan_de_xuat;
                $lophocphan->so_luong = $item->so_luong;
                $lophocphan->nhap_diem = 0;
                $lophocphan->id_hoc_ky = $item->id_hoc_ky;
                $lophocphan->them();
            }

        }

        if ($this->xoaMangIDHocPhan($mang_id_hoc_phan,$id_dang_ky_khao_sat))
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);

    }

    public function xoaDuyetLopDeXuat(Request $request,$id_dang_ky_khao_sat){
        $mang_id_hoc_phan = $request->input('mang_id_hoc_phan');

        if ($this->xoaMangIDHocPhan($mang_id_hoc_phan,$id_dang_ky_khao_sat))
            return ToolsModel::status('Xóa thông tin thành công', 200);
        return ToolsModel::status('Xóa thông tin thất bại', 500);
    }

    public function xoaMangIDHocPhan($mang_id_hoc_phan, $id_dang_ky_khao_sat){
        for ($i =0; $i<count($mang_id_hoc_phan); $i++){
            $lopdexuat = new KhaoSatDangKyHocPhanModel();
            $lopdexuat->id_hoc_phan = $mang_id_hoc_phan[$i];
            $lopdexuat->xoaDuyetLopDeXuat($id_dang_ky_khao_sat);
        }
        return true;
    }

}
