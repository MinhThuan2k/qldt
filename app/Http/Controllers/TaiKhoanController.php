<?php

namespace App\Http\Controllers;

use App\Models\TaiKhoanModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;

class TaiKhoanController extends Controller
{
    public function getViewTaiKhoan(){
        $tk = new TaiKhoanModel();
        return view('auth.tai-khoan', ['data' => $tk->dsTaiKhoan()]);
    }

    public function putThem(Request $request){
        $tk = new TaiKhoanModel();
        $tk->ho_ten = $request->input('hoten');
        $tk->email = $request->input('email');
        if($tk->them())
            return ToolsModel::status('Thêm thông tin thành công', 200);
        return ToolsModel::status('Thêm thông tin thất bại', 500);
    }
}
