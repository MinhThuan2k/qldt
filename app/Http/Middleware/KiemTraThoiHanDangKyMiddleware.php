<?php

namespace App\Http\Middleware;

use App\Models\DangKyHocPhanModel;
use App\Models\ToolsModel;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class KiemTraThoiHanDangKyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id_dot_dang_ky = $request->request->get('id_dot_dang_ky');
        $thoiHan = DangKyHocPhanModel::getThoiHanDangKy($id_dot_dang_ky);
        $hienTai = Carbon::now();
        if($hienTai>= $thoiHan->thoi_gian_mo && $hienTai <= $thoiHan->thoi_gian_dong)
            return $next($request);
        return response(ToolsModel::status('Chưa đến thời hạn đăng ký học phần!', 403));
    }
}
