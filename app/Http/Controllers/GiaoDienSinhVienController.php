<?php

namespace App\Http\Controllers;


use App\Models\ToolsModel;
use Illuminate\Http\Request;

class GiaoDienSinhVienController extends Controller
{
    public function giaoDien(){
        return view('auth.giao-dien-sv.blank-sv');
    }
}
